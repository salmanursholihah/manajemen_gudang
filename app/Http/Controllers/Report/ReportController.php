<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class ReportController extends Controller
{
    /**
     * Halaman untuk pilih jenis report
     */
//   public function index()
// {
//     $role = Auth::user()->role;

//     $reportTypes = [
//         'products' => 'Data Produk',
//         'products_by_category' => 'Produk per Kategori',
//         'transactions' => 'Semua Transaksi',
//         'transactions_monthly' => 'Transaksi per Bulan',
//         'transactions_daily' => 'Transaksi per Hari',
//         'transactions_user' => 'Transaksi per User',
//         'transactions_compare' => 'Compare Transaksi Operator vs Supplier',
//         'suppliers' => 'Data Supplier',
//         'customers' => 'Data Customer',
//         'users' => 'Data User',
//     ];

//     // ➕ Tambahan untuk role tertentu
//     if ($role === 'manager') {
//         $reportTypes['transactions_manager_approved'] = 'Transaksi Disetujui';
//         $reportTypes['transactions_manager_rejected'] = 'Transaksi Ditolak';
//     }

//     if ($role === 'supplier') {
//         $reportTypes['supplier_products'] = 'Produk Saya';
//         $reportTypes['supplier_transactions'] = 'Transaksi Supplier';
//     }

//     if ($role === 'operator') {
//         $reportTypes['operator_products'] = 'Produk Operator';
//         $reportTypes['operator_stock_in_out'] = 'Barang Masuk & Keluar';
//     }

//     return view('reports.index', compact('reportTypes'));
// }


public function index()
{
    $role = Auth::user()->role;
    $reportTypes = [];

    if ($role === 'admin') {
        $reportTypes = [
            'products' => 'Data Produk',
            'products_by_category' => 'Produk per Kategori',
            'transactions' => 'Semua Transaksi',
            'transactions_monthly' => 'Transaksi per Bulan',
            'transactions_daily' => 'Transaksi per Hari',
            'transactions_user' => 'Transaksi per User',
            'transactions_compare' => 'Compare Transaksi Operator vs Supplier',
            'suppliers' => 'Data Supplier',
            'customers' => 'Data Customer',
            'users' => 'Data User',
        ];
    }

    if ($role === 'manager') {
        $reportTypes = [
            'transactions_manager_approved' => 'Transaksi Disetujui',
            'transactions_manager_rejected' => 'Transaksi Ditolak',
        ];
    }

    if ($role === 'supplier') {
        $reportTypes = [
            'supplier_products' => 'Produk Saya',
            'supplier_transactions' => 'Transaksi Supplier',
        ];
    }

    if ($role === 'operator') {
        $reportTypes = [
            'operator_products' => 'Produk Operator',
            'operator_stock_in_out' => 'Barang Masuk & Keluar',
        ];
    }

    return view('reports.index', compact('reportTypes'));
}


    /**
     * Generate PDF berdasarkan tipe report
     */
    public function export(Request $request)
    {
        $type = $request->input('type');
        $data = [];
        $role = Auth::user()->role;
        $user = Auth::user();
        $view = 'null';

        switch ($type) {
            case 'products':
                $data = Product::all();
                $view = 'reports.pdf.products';
                break;

            case 'products_by_category':
                $data = Product::with('category')->get()->groupBy('category.name');
                $view = 'reports.pdf.products_by_category';
                break;

            case 'transactions':
                $data = Transaction::with(['customer', 'supplier', 'user'])->get();
                $view = 'reports.pdf.transactions';
                break;

            case 'transactions_monthly':
                $data = Transaction::selectRaw('YEAR(date) as year, MONTH(date) as month, COUNT(*) as total')
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'desc')
                    ->get();
                $view = 'reports.pdf.transactions_monthly';
                break;

            case 'transactions_daily':
                $data = Transaction::selectRaw('DATE(date) as day, COUNT(*) as total')
                    ->groupBy('day')
                    ->orderBy('day', 'desc')
                    ->get();
                $view = 'reports.pdf.transactions_daily';
                break;

            case 'transactions_user':
                $data = Transaction::with('user')->get()->groupBy('user.name');
                $view = 'reports.pdf.transactions_user';
                break;

            case 'transactions_compare':
                $data = Transaction::with(['operator', 'supplier'])->get();
                $view = 'reports.pdf.transactions_compare';
                break;

            case 'suppliers':
                $data = Supplier::all();
                $view = 'reports.pdf.suppliers';
                break;

            case 'customers':
                $data = Customer::all();
                $view = 'reports.pdf.customers';
                break;

            case 'users':
                $data = User::all();
                $view = 'reports.pdf.users';
                break;
                
        // Manager: transaksi approved
        case 'transactions_manager_approved':
            if ($role === 'manager') {
                $data = Transaction::with(['customer','supplier','user'])
                                   ->where('status', 'approved')
                                   ->get();
                $view = 'reports.pdf.transactions_manager_approved';
            } else {
                abort(403, 'Unauthorized');
            }
            break;

        // Manager: transaksi rejected
        case 'transactions_manager_rejected':
            if ($role === 'manager') {
                $data = Transaction::with(['customer','supplier','user'])
                                   ->where('status', 'rejected')
                                   ->get();
                $view = 'reports.pdf.transactions_manager_rejected';
            } else {
                abort(403, 'Unauthorized');
            }
            break;

        // Supplier: produk miliknya sendiri
        case 'supplier_products':
            if ($role === 'supplier') {
                $data = Product::where('supplier_id', $user->supplier_id)
                               ->with('category')
                               ->get();
                $view = 'reports.pdf.supplier_products';
            } else {
                abort(403, 'Unauthorized');
            }
            break;

        // Supplier: transaksi miliknya sendiri
        case 'supplier_transactions':
            if ($role === 'supplier') {
                $data = Transaction::with(['customer','supplier','user'])
                                   ->where('supplier_id', $user->supplier_id)
                                   ->get();
                $view = 'reports.pdf.supplier_transactions';
            } else {
                abort(403, 'Unauthorized');
            }
            break;

        // Operator: produk yang dibuat oleh operator
        // case 'operator_products':
        //     if ($role === 'operator') {
        //         $data = Product::where('created_by', $user->id)
        //                        ->with('category')
        //                        ->get();
        //         $view = 'reports.pdf.operator_products';
        //     } else {
        //         abort(403, 'Unauthorized');
        //     }
        //     break;

        // Operator: barang masuk & keluar
        case 'operator_stock_in_out':
            if ($role === 'operator') {
                $data = Transaction::with(['customer','supplier','user'])
                                   ->where('user_id', $user->id)
                                   ->whereIn('type', ['barang_masuk','barang_keluar'])
                                   ->get();
                $view = 'reports.pdf.operator_stock_in_out';
            } else {
                abort(403, 'Unauthorized');
            }
            break;

        default:
            return back()->with('error', 'Tipe report tidak valid.');
    }

    $pdf = PDF::loadView($view, compact('data'))
        ->setPaper('a4', 'portrait');

    return $pdf->download("report-{$type}.pdf");
}
}
