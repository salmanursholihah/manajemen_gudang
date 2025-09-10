<?php
namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Http\Controllers\Traits\ReportActions;

class SupplierReportController extends Controller
{
    use ReportActions;

    public function index()
    {
        $reports = Report::whereIn('type', ['purchase','suppliers'])
                         ->latest()
                         ->paginate(10);

        return view('backend.supplier.reports.index', compact('reports'));
    }

    public function download(Report $report)
    {
        if (in_array($report->type, ['purchase','suppliers'])) {
            return $this->downloadReport($report);
        }
        abort(403, 'Tidak diizinkan mengunduh report ini.');
    }
}