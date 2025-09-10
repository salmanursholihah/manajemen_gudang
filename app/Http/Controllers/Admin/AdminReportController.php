<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    // Menampilkan daftar report
    public function index()
    {
        $user = Auth::user();

        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            $reports = Report::latest()->paginate(10);
        } elseif ($user->role === 'manager') {
            $reports = Report::whereIn('type', ['sales', 'purchase', 'stock'])->latest()->paginate(10);
        } elseif ($user->role === 'supplier') {
            $reports = Report::whereIn('type', ['purchase', 'suppliers'])->latest()->paginate(10);
        } else { // viewer
            $reports = Report::latest()->paginate(10);
        }

        return view('backend.admin.reports.index', compact('reports'));
    }

    // Generate report baru
    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:sales,purchase,stock,customer,suppliers',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'amount' => 'required|numeric'
        ]);

        $report = Report::create([
            'type' => $request->type,
            'periode_awal' => $request->periode_awal,
            'periode_akhir' => $request->periode_akhir,
            'amount' => $request->amount,
            'generate_by' => Auth::id(),
        ]);

        return redirect()->route('backend.admin.reports.index')->with('success', 'Report berhasil dibuat!');
    }

    // Download report (misalnya PDF)
public function download(Report $report)
{
    $pdf = Pdf::loadView('backend.admin.reports.pdf', compact('report'));
    return $pdf->download('report-'.$report->id.'.pdf');
}
}
