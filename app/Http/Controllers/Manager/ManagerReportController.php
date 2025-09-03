<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class ManagerReportController extends Controller
{
    public function index(Request $request) {
        $query = Report::query();

        // Filter by type kalau ada
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        // Filter periode
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('periode_awal', [$request->start_date, $request->end_date]);
        }

        $reports = $query->latest()->paginate(10);

        return view('backend.manager.reports.index', compact('reports'));
    }
}
