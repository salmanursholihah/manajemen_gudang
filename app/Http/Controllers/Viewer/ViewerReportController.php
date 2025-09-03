<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ViewerReportController extends Controller
{
      public function index() {
        $reports = Report::paginate(10);
        return view('backend.viewer.reports.index', compact('reports'));
    }
}
