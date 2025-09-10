<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ViewerReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(5);
        return view('backend.viewer.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('backend.viewer.reports.show', compact('report'));
    }
}