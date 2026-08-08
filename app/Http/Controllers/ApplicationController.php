<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only([
            'index', 'show', 'approve', 'deny', 'addComment', 'users', 'showApplicationForms'
        ]);
    }

    // -------------------------------------------------------
    // USER SIDE
    // -------------------------------------------------------

    /**
     * Show the application creation form.
     * Redirect to My Application if already submitted.
     */
    public function create()
    {
        $existing = Application::where('user_id', Auth::id())->latest('created_at')->first();
        if ($existing) {
            if ($existing->status === 'denied') {
                return redirect()->route('applications.edit')
                    ->with('info', 'Your previous application was denied. Update your details and submit again to reapply.');
            }

            return redirect()->route('applications.myApplication')
                ->with('info', 'You have already submitted an application.');
        }

        $user = Auth::user();
        $profile = $user->profile;

        $defaults = [
            'full_name' => $profile
                ? trim(sprintf('%s %s %s', $profile->last_name, $profile->first_name, $profile->middle_name))
                : $user->name,
            'sex' => optional($profile)->sex ?? $user->sex,
            'birthday' => optional($profile?->date_of_birth)->format('Y-m-d'),
            'age' => $profile && $profile->date_of_birth ? $profile->date_of_birth->age : null,
            'civil_status' => optional($profile)->status,
            'mother_name' => optional($profile)->mother_name,
            'father_guardian_name' => optional($profile)->father_name,
            'contact_no' => optional($profile)->contact_number,
            'messenger' => optional($profile)->social_media,
        ];

        return view('application.applications.create', ['application' => null, 'defaults' => $defaults]);
    }

    public function edit()
    {
        $application = Application::where('user_id', Auth::id())->latest('created_at')->firstOrFail();
        return view('application.applications.create', compact('application'));
    }

    /**
     * Store a new application with file uploads.
     */
    public function store(Request $request)
    {
        // Prevent duplicate applications
        $existing = Application::where('user_id', Auth::id())->latest('created_at')->first();
        if ($existing) {
            if ($existing->status === 'denied') {
                return redirect()->route('applications.edit')
                    ->with('info', 'Your previous application was denied. Update your details and submit again to reapply.');
            }

            return redirect()->route('applications.myApplication')
                ->with('error', 'You have already submitted an application.');
        }

        $validated = $request->validate([
            'full_name'           => 'required|string|max:255',
            'sex'                 => 'required|in:Male,Female',
            'birthday'            => 'required|date|before:today',
            'age'                 => 'required|integer|min:15|max:30',
            'barangay'            => 'required|string|max:100',
            'civil_status'        => 'required|in:Single,Married,Widowed,Separated',
            'parent_status'       => 'required|in:Both Parents,Single Parent,Orphan,Guardian',
            'education'           => 'required|string|max:100',
            'spes_status'         => 'required|in:new,baby',
            'mother_name'         => 'required|string|max:255',
            'father_guardian_name'=> 'required|string|max:255',
            'contact_no'          => 'required|string|max:20',
            'messenger'           => 'nullable|string|max:255',
            'resume'              => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'application_letter'  => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'indigency'           => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        // Handle file uploads
        $resumePath  = null;
        $letterPath  = null;
        $indigencyPath = null;

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('applications/resumes', 'public');
        }
        if ($request->hasFile('application_letter')) {
            $letterPath = $request->file('application_letter')->store('applications/letters', 'public');
        }
        if ($request->hasFile('indigency')) {
            $indigencyPath = $request->file('indigency')->store('applications/indigency', 'public');
        }

        Application::create([
            'user_id'              => Auth::id(),
            'full_name'            => $validated['full_name'],
            'sex'                  => $validated['sex'],
            'birthday'             => $validated['birthday'],
            'age'                  => $validated['age'],
            'barangay'             => $validated['barangay'],
            'civil_status'         => $validated['civil_status'],
            'parent_status'        => $validated['parent_status'],
            'education'            => $validated['education'],
            'spes_status'          => $validated['spes_status'],
            'mother_name'          => $validated['mother_name'],
            'father_guardian_name' => $validated['father_guardian_name'],
            'contact_no'           => $validated['contact_no'],
            'messenger'            => $validated['messenger'] ?? null,
            'resume'               => $resumePath,
            'application_letter'   => $letterPath,
            'indigency'            => $indigencyPath,
            'status'               => 'pending',
        ]);

        return redirect()->route('applications.myApplication')
            ->with('success', 'Your application has been submitted successfully!');
    }

    public function update(Request $request)
    {
        $application = Application::where('user_id', Auth::id())->latest('created_at')->firstOrFail();

        $validated = $request->validate([
            'full_name'           => 'required|string|max:255',
            'sex'                 => 'required|in:Male,Female',
            'birthday'            => 'required|date|before:today',
            'age'                 => 'required|integer|min:15|max:30',
            'barangay'            => 'required|string|max:100',
            'civil_status'        => 'required|in:Single,Married,Widowed,Separated',
            'parent_status'       => 'required|in:Both Parents,Single Parent,Orphan,Guardian',
            'education'           => 'required|string|max:100',
            'spes_status'         => 'required|in:new,baby',
            'mother_name'         => 'required|string|max:255',
            'father_guardian_name'=> 'required|string|max:255',
            'contact_no'          => 'required|string|max:20',
            'messenger'           => 'nullable|string|max:255',
            'resume'              => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'application_letter'  => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'indigency'           => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('resume')) {
            if ($application->resume) {
                Storage::disk('public')->delete($application->resume);
            }
            $application->resume = $request->file('resume')->store('applications/resumes', 'public');
        }
        if ($request->hasFile('application_letter')) {
            if ($application->application_letter) {
                Storage::disk('public')->delete($application->application_letter);
            }
            $application->application_letter = $request->file('application_letter')->store('applications/letters', 'public');
        }
        if ($request->hasFile('indigency')) {
            if ($application->indigency) {
                Storage::disk('public')->delete($application->indigency);
            }
            $application->indigency = $request->file('indigency')->store('applications/indigency', 'public');
        }

        $updates = array_merge($validated, [
            'resume'             => $application->resume,
            'application_letter' => $application->application_letter,
            'indigency'          => $application->indigency,
        ]);

        if ($application->status === 'denied') {
            $updates['status'] = 'pending';
            $updates['admin_comment'] = null;
            $updates['forms_step'] = 0;
        }

        $application->update($updates);

        $message = $application->wasChanged('status')
            ? 'Your application has been resubmitted and is now pending admin review.'
            : 'Your application has been updated successfully!';

        return redirect()->route('applications.myApplication')
            ->with('success', $message);
    }

    /**
     * User: show "My Application" page.
     */
    public function myApplication()
    {
        $application = Application::where('user_id', Auth::id())->latest('created_at')->first();
        return view('application.applications.my-application', compact('application'));
    }

    // -------------------------------------------------------
    // ADMIN SIDE
    // -------------------------------------------------------

    /**
     * Admin: list all applications.
     */
    public function index(Request $request)
    {
        $query = Application::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $applications = $query->paginate(15);

        // Stats for the top cards
        $stats = [
            'total'    => Application::count(),
            'pending'  => Application::where('status', 'pending')->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'denied'   => Application::where('status', 'denied')->count(),
        ];

        return view('admin.applications', compact('applications', 'stats'));
    }

    /**
     * View a submitted application document.
     */
    public function viewDocument(Application $application, string $document)
    {
        if (!in_array($document, ['resume', 'application_letter', 'indigency'])) {
            abort(404);
        }

        $user = auth()->user();
        if ($user->role !== 'admin' && $application->user_id !== $user->id) {
            abort(403);
        }

        $path = $application->{$document};
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($path));
    }

    /**
     * Admin: view a single application's full details.
     */
    public function show(Application $application)
    {
        return view('admin.application-detail', compact('application'));
    }

    /**
     * Admin: approve an application.
     */
    public function approve(Application $application)
    {
        $application->update(['status' => 'approved']);
        // notify the user
        try {
            $application->user->notify(new \App\Notifications\ApplicationStatusUpdated($application, 'approved', auth()->user()));
        } catch (\Throwable $e) {
            // ignore notification errors
        }
        return back()->with('success', "Application for {$application->full_name} has been approved.");
    }

    /**
     * Admin: deny an application.
     */
    public function deny(Application $application)
    {
        $application->update(['status' => 'denied']);
        // notify the user
        try {
            $application->user->notify(new \App\Notifications\ApplicationStatusUpdated($application, 'denied', auth()->user()));
        } catch (\Throwable $e) {
            // ignore notification errors
        }
        return back()->with('success', "Application for {$application->full_name} has been denied.");
    }

    /**
     * Admin: save a comment/feedback on an application.
     */
    public function addComment(Request $request, Application $application)
    {
        $request->validate([
            'admin_comment' => 'required|string|max:2000',
        ]);

        $application->update(['admin_comment' => $request->admin_comment]);
        return back()->with('success', 'Comment saved successfully.');
    }

    /**
     * Admin: view all registered users.
     */
    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(20);
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.users', compact('users', 'totalUsers'));
    }

    /**
     * Admin: view all forms submitted by a user for their approved application.
     */
    public function showApplicationForms(Application $application)
    {
        if ($application->status !== 'approved') {
            return back()->with('error', 'This application must be approved to view forms.');
        }
        return view('admin.application-forms', compact('application'));
    }
}
