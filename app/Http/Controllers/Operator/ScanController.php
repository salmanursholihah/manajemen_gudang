<?php
namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class ScanController extends Controller
{
    // Tampilkan halaman scan
    public function index()
    {
        return view('backend.operator.scan');
    }

    // Proses QR code setelah di-scan
    public function process(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
            'operation' => 'required|in:inbound,outbound',
        ]);

        $qrCode = $request->qr_code;
        $operation = $request->operation;

        // Cari item berdasarkan QR code
        $item = Stock::where('qr_code', $qrCode)->first();

        if (!$item) {
            return back()->with('error', 'Item tidak ditemukan!');
        }

        // Simpan transaksi inbound/outbound
        $stock = Stock::create([
            'name' => $item->name,
            'stock' => 1, // default 1, bisa ubah sesuai input
            'type' => $operation,
            'qr_code' => $item->qr_code,
        ]);

        return redirect()
            ->route($operation == 'inbound' ? 'operator.inbound' : 'operator.outbound')
            ->with('success', ucfirst($operation) . ' berhasil untuk item: ' . $item->name);
    }
}
