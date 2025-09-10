<?php
namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ReportActions;

class OperatorReportController extends Controller
{
    use ReportActions;

    public function index()
    {
        $reports = Report::where('type', 'stock')
                         ->where('generate_by', Auth::id())
                         ->latest()
                         ->paginate(10);

        return view('backend.operator.reports.index', compact('reports'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'amount' => 'required|numeric'
        ]);

        $report = Report::create([
            'type' => 'stock',
            'periode_awal' => $request->periode_awal,
            'periode_akhir' => $request->periode_akhir,
            'amount' => $request->amount,
            'generate_by' => Auth::id(),
        ]);

        return redirect()->route('backend.operator.reports.index')->with('success', 'Report berhasil dibuat!');
    }

    public function download(Report $report)
    {
        if ($report->type === 'stock' && $report->generate_by === Auth::id()) {
            return $this->downloadReport($report);
        }
        abort(403, 'Tidak diizinkan mengunduh report ini.');
    }
}