<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ReportActions;

class ManagerReportController extends Controller
{
    use ReportActions;

    public function index(Request $request)
    {
        $reports = $this->filterReports($request);
        return view('backend.manager.reports.index', compact('reports'));
    }

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

        return redirect()->route('backend.manager.reports.index')->with('success', 'Report berhasil dibuat!');
    }

    public function download(Report $report)
    {
        return $this->downloadReport($report);
    }
}
