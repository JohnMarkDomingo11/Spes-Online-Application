<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMasterListRequest;
use App\Models\Application;
use App\Models\MasterList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterListController extends Controller
{
    /**
     * Display the master list filtering and results
     */
    public function index(Request $request)
    {
        $query = Application::where('status', 'approved');

        // Filter by barangay
        if ($request->filled('barangay')) {
            $query->where('barangay', $request->input('barangay'));
        }

        // Filter by SPES status
        if ($request->filled('spes_status')) {
            $query->where('spes_status', $request->input('spes_status'));
        }

        // Sort
        $sort = $request->input('sort', 'name_asc');
        if ($sort === 'name_desc') {
            $query->orderBy('full_name', 'desc');
        } else {
            $query->orderBy('full_name', 'asc');
        }

        $applications = $query->paginate(25);

        // Get unique barangays for filter dropdown
        $barangays = Application::distinct()
            ->orderBy('barangay')
            ->pluck('barangay')
            ->filter();

        return view('admin.master-list', compact('applications', 'barangays'));
    }

    /**
     * Save the finalized Master List
     */
    public function store(StoreMasterListRequest $request)
    {
        $validated = $request->validated();

        // Create the master list record
        $masterList = MasterList::create([
            'name' => $validated['name'],
            'filters_json' => [
                'barangay' => $request->input('barangay'),
                'spes_status' => $request->input('spes_status'),
                'sort' => $request->input('sort', 'name_asc'),
            ],
            'generated_by' => Auth::id(),
        ]);

        // Get the filtered applications
        $query = Application::where('status', 'approved');

        if ($request->filled('barangay')) {
            $query->where('barangay', $request->input('barangay'));
        }

        if ($request->filled('spes_status')) {
            $query->where('spes_status', $request->input('spes_status'));
        }

        $applicationIds = $query->pluck('id')->toArray();

        // Attach applications to master list
        $masterList->applications()->attach($applicationIds);

        return redirect()->route('admin.masterlist.index')
            ->with('success', "Master List '{$masterList->name}' created successfully with " . count($applicationIds) . ' approved applicants.');
    }
}
