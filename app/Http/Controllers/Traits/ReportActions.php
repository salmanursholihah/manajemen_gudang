<?php
namespace App\Http\Controllers\Traits;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;

trait ReportActions
{
    // Shared query dengan filter type & periode
    public function filterReports($request, $query = null)
    {
        $query = $query ?? Report::query();

        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('periode_awal', [$request->start_date, $request->end_date]);
        }

        return $query->latest()->paginate(10);
    }

    // Download PDF
    public function downloadReport(Report $report)
    {
        $pdf = Pdf::loadView('backend.reports.pdf', compact('report'));
        return $pdf->download('report-'.$report->id.'.pdf');
    }
}