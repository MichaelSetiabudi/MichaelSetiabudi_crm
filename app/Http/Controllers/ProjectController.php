<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['lead', 'customer', 'assignedSales'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('projects.index', compact('projects'));
    }

    /**
     * Display pending approval projects for managers.
     */
    public function approvalQueue()
    {
        // Only managers can access this
        if (Auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized access.');
        }

        $pendingProjects = Project::with(['lead', 'customer', 'assignedSales'])
            ->where('status', 'pending_approval')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('projects.approval-queue', compact('pendingProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::where('status', 'qualified')->get();
        $customers = Customer::where('status', 'active')->get();
        
        return view('projects.create', compact('leads', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'customer_id' => 'nullable|exists:customers,id',
            'project_code' => 'required|string|unique:projects',
            'description' => 'required|string',
            'project_value' => 'required|numeric|min:0',
            'expected_close_date' => 'required|date|after:today',
        ]);

        $validated['assigned_sales_id'] = Auth::id();
        $validated['status'] = 'pending_approval';

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created and submitted for approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['lead', 'customer', 'assignedSales']);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $leads = Lead::where('status', 'qualified')->get();
        $customers = Customer::where('status', 'active')->get();
        
        return view('projects.edit', compact('project', 'leads', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'customer_id' => 'nullable|exists:customers,id',
            'project_code' => 'required|string|unique:projects,project_code,' . $project->id,
            'description' => 'required|string',
            'project_value' => 'required|numeric|min:0',
            'expected_close_date' => 'required|date|after:today',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Approve a project (Manager only).
     */
    public function approve(Project $project)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403, 'Only managers can approve projects.');
        }

        $project->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Project approved successfully.');
    }

    /**
     * Reject a project (Manager only).
     */
    public function reject(Request $request, Project $project)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403, 'Only managers can reject projects.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $project->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('success', 'Project rejected.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Display all projects with detailed information
     */
    public function allProjects()
    {
        $user = Auth::user();
        
        // Get projects based on user role
        if ($user->role === 'admin' || $user->role === 'manager') {
            $projects = Project::with(['lead', 'customer', 'assignedSales', 'product', 'approvedBy', 'rejectedBy'])
                ->orderByRaw('COALESCE(approved_at, rejected_at, updated_at) DESC')
                ->get();
        } else {
            $projects = Project::where('assigned_sales_id', $user->id)
                ->with(['lead', 'customer', 'assignedSales', 'product', 'approvedBy', 'rejectedBy'])
                ->orderByRaw('COALESCE(approved_at, rejected_at, updated_at) DESC')
                ->get();
        }
        
        return view('projects.all', compact('projects'));
    }

    /**
     * Download all projects as PDF
     */
    public function downloadPDF()
    {
        $user = Auth::user();
        
        // Get projects based on user role
        if ($user->role === 'admin' || $user->role === 'manager') {
            $projects = Project::with(['lead', 'customer', 'assignedSales', 'product', 'approvedBy', 'rejectedBy'])
                ->orderByRaw('COALESCE(approved_at, rejected_at, updated_at) DESC')
                ->get();
        } else {
            $projects = Project::where('assigned_sales_id', $user->id)
                ->with(['lead', 'customer', 'assignedSales', 'product', 'approvedBy', 'rejectedBy'])
                ->orderByRaw('COALESCE(approved_at, rejected_at, updated_at) DESC')
                ->get();
        }
        
        $pdf = Pdf::loadView('projects.pdf', compact('projects', 'user'));
        
        return $pdf->download('projects-report-' . date('Y-m-d') . '.pdf');
    }
}
