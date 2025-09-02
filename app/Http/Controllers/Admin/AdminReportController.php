<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class AdminReportController extends Controller
{
 
    // Tampilkan halaman report
    public function index(Request $request)
    {
        $query = Report::query();

        // Filter berdasarkan tanggal jika ada input
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Jika klik "All Reports", tampilkan semua
        if ($request->has('all')) {
            $reports = Report::all();
        } else {
            $reports = $query->latest()->get();
        }

        return view('backend.admin.reports.index', compact('reports'));
    }


}
