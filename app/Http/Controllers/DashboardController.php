<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Project;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get basic statistics based on user role
        $stats = [];
        
        if ($user->role === 'admin' || $user->role === 'manager') {
            // Admin and Manager get full overview
            $stats['total_leads'] = Lead::count() ?? 0;
            $stats['total_projects'] = Project::count() ?? 0;
            $stats['total_customers'] = Customer::count() ?? 0;
            $stats['total_users'] = User::count() ?? 0;
            $stats['pending_approvals'] = Project::where('status', 'pending_approval')->count() ?? 0;
            $stats['approved_projects'] = Project::where('status', 'approved')->count() ?? 0;
            $stats['rejected_projects'] = Project::where('status', 'rejected')->count() ?? 0;
        } elseif ($user->role === 'sales') {
            // Sales get their own data only
            $stats['my_leads'] = Lead::where('assigned_to', $user->id)->count() ?? 0;
            $stats['my_projects'] = Project::where('assigned_sales_id', $user->id)->count() ?? 0;
            $stats['my_customers'] = Customer::whereHas('project', function($query) use ($user) {
                $query->where('assigned_sales_id', $user->id);
            })->count() ?? 0;
            $stats['pending_approvals'] = Project::where('assigned_sales_id', $user->id)->where('status', 'pending_approval')->count() ?? 0;
            
            // Additional stats for sales
            $stats['total_leads'] = 0; // Hide from sales
            $stats['total_projects'] = 0; // Hide from sales  
            $stats['total_customers'] = 0; // Hide from sales
            $stats['total_products'] = 0; // Hide from sales
        }
        
        // Recent activities based on role - safe queries
        $recentLeads = collect();
        $recentProjects = collect();
        $recentCustomers = collect();
        
        if ($user->role === 'admin' || $user->role === 'manager') {
            $recentLeads = Lead::with('assignedUser')->latest()->take(5)->get() ?? collect();
            $recentProjects = Project::with(['lead', 'product', 'assignedSales'])
                ->orderByRaw('COALESCE(approved_at, rejected_at, updated_at) DESC')
                ->take(5)->get() ?? collect();
            $recentCustomers = Customer::with(['project'])->latest()->take(5)->get() ?? collect();
        } elseif ($user->role === 'sales') {
            $recentLeads = Lead::where('assigned_to', $user->id)->with('assignedUser')->latest()->take(5)->get() ?? collect();
            $recentProjects = Project::where('assigned_sales_id', $user->id)
                ->with(['lead', 'product', 'assignedSales'])
                ->orderByRaw('COALESCE(approved_at, rejected_at, updated_at) DESC')
                ->take(5)->get() ?? collect();
            $recentCustomers = Customer::whereHas('project', function($query) use ($user) {
                $query->where('assigned_sales_id', $user->id);
            })->with(['project'])->latest()->take(5)->get() ?? collect();
        }
        
        // Notifications and chart data
        $notifications = collect();
        $chartData = [];
        
        return view('dashboard', compact(
            'stats',
            'recentLeads',
            'recentProjects', 
            'recentCustomers',
            'notifications',
            'chartData'
        ));
    }
}
