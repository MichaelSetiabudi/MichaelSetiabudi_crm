<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get leads based on user role
        if ($user->role === 'admin' || $user->role === 'manager') {
            $leads = Lead::with(['assignedUser'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $leads = Lead::where('assigned_to', $user->id)
                ->with(['assignedUser'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'sales')->get();
        return view('leads.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,closed_won,closed_lost',
            'priority' => 'required|in:low,medium,high',
            'source' => 'required|in:website,referral,social_media,advertisement,cold_call,trade_show,other',
            'estimated_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        $leadData = $request->all();
        
        // If sales user creates lead, auto-assign to themselves
        if (Auth::user()->role === 'sales' && !$request->assigned_to) {
            $leadData['assigned_to'] = Auth::id();
        }

        Lead::create($leadData);

        return redirect()->route('leads.index')->with('success', 'Lead created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Download leads as PDF
     */
    public function downloadPdf()
    {
        $user = Auth::user();
        
        // Get leads based on user role
        if ($user->role === 'admin' || $user->role === 'manager') {
            $leads = Lead::with(['assignedUser'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $leads = Lead::where('assigned_to', $user->id)
                ->with(['assignedUser'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $data = [
            'leads' => $leads,
            'user' => $user,
            'total_leads' => $leads->count(),
            'total_value' => $leads->sum('estimated_value'),
            'qualified_leads' => $leads->where('status', 'qualified')->count(),
            'new_leads' => $leads->where('status', 'new')->count(),
            'download_date' => now()->format('d F Y H:i:s')
        ];

        $pdf = Pdf::loadView('leads.pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('leads_report_' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }
}
