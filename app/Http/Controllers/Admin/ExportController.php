<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ApplicationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export applications to Excel with filters
     */
    public function masterList(Request $request)
    {
        $filters = $request->only(['status', 'barangay', 'spes_status', 'search']);
        
        return Excel::download(
            new ApplicationsExport($filters),
            'spes-applications-' . now()->format('Y-m-d-His') . '.xlsx'
        );
    }
}
