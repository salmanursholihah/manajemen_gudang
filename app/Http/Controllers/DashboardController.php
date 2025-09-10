<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Report;
use App\Models\Product;
use App\Models\StockMovement; 
use App\Models\Transaction;
use App\Models\Customer;

class DashboardController extends Controller
{
       public function index()
{
    $user = Auth::user();
    ///manager
    $stockLevels = Product::sum('stock'); // total stok semua produk
      // Data Statistik
        $reportCount = Report::count();
        $stockLevels = Product::sum('stock'); // total stok semua produk
        // Performance bisa dihitung misal: persentase produk dengan stock > 0
        $totalProducts = Product::count();
        $inStockProducts = Product::where('stock', '>', 0)->count();
        $performance = $totalProducts ? round(($inStockProducts / $totalProducts) * 100) : 0;
                // Latest Reports
        $latestReports = Report::latest()->take(5)->get();

        ///admin dashboard
    $userCount = User::count();
    $reportCount = Report::count();
    $productCount = Product::count();

    $categories = Product::select('category')
        ->groupBy('category')
        ->pluck('category')
        ->toArray();

    $productData = Product::selectRaw('count(*) as total')
        ->groupBy('category')
        ->pluck('total')
        ->toArray();

    $recentUsers = User::latest()->take(5)->get();

    ///data untuk operator dashboard 

    // Total inbound dan outbound hari ini
    $today = now()->toDateString();
    $inboundToday = StockMovement::where('type', 'inbound')
        ->whereDate('created_at', $today)
        ->sum('quantity'); // jumlah barang masuk

    $outboundToday = StockMovement::where('type', 'outbound')
        ->whereDate('created_at', $today)
        ->sum('quantity'); // jumlah barang keluar

    // Total stock saat ini
    $currentStock = Product::sum('stock'); // misal kolom 'stock' di tabel products

        ////data untuk supplier dashoard

        // Total sales (misal sum dari total di table transactions milik user)
        $totalSales = Transaction::where('supplier_id', $user->id) // sesuaikan kolom
            ->where('status', 'completed') // hanya transaksi selesai
            ->sum('total');

        // Jumlah customer milik user
        $customerCount = Customer::where('supplier_id', $user->id)->count();

        // Pending orders milik user
        $pendingOrders = Transaction::where('supplier_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Recent Orders (ambil 5 terbaru)
        $recentOrders = Transaction::where('supplier_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        ///viewer dashboard
            // Total stock items
        $totalStockItems = Product::sum('stock');

        // Total transactions
        $totalTransactions = Transaction::count();

        // Total reports available
        $totalReports = Report::count();

        // Stock overview (ambil semua produk terbaru)
        $stockOverview = Product::latest()->get();

    
    



    // data yang dipakai di semua dashboard
    $data = compact('user', 'userCount', 'reportCount', 'productCount', 'categories', 'productData', 'recentUsers','stockLevels','reportCount','performance', 'latestReports',  'user', 'inboundToday', 'outboundToday', 'currentStock','user', 'totalSales', 'customerCount', 'pendingOrders', 'recentOrders', 'totalStockItems', 'totalTransactions', 'totalReports', 'stockOverview');

    switch ($user->role) {
        case 'admin':
            return view('dashboard.admin', $data);
        case 'manager':
            return view('dashboard.manager', $data);
        case 'supplier':
            return view('dashboard.supplier', $data);
        case 'operator':
            return view('dashboard.operator', $data);
        default:
            return view('dashboard.viewer', $data);
    }
}

}