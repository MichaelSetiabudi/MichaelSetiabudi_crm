<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #000000 !important;">
                {{ __('Dashboard PT Smart ISP CRM') }}
            </h2>
            <div class="text-sm text-gray-600" style="color: #000000 !important;">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </x-slot>

    <style>
        /* Custom styles to ensur                            <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #10b981 !important; color: white !important; text-decoration: none !important; min-height: 60px;">
                                <svg class="w-5 h-5 mr-2" f                            <a href="{{ route('leads.index') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #10b981 !important; color: white !important; text-decoration: none !important; min-height: 60px;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span style="color: white !important;">Manage Team</span>
                            </a>one" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span style="color: white !important;">Manage Team</span>
                            </a>bility */
        .btn-solid {
            background-color: var(--bg-color) !important;
            color: white !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
        }
        .btn-solid:hover {
            filter: brightness(0.9) !important;
            transform: translateY(-1px) !important;
        }
        .stat-card {
            background: white !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }
        .action-card {
            background: white !important;
            border: 1px solid #e5e7eb !important;
            min-height: 120px !important;
        }
        .card-header {
            background: #f9fafb !important;
            border-bottom: 1px solid #e5e7eb !important;
        }
    </style>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6 border">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2" style="color: #000000 !important;">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mb-1" style="color: #000000 !important;">Role: {{ ucfirst(Auth::user()->role) }} • Today is {{ now()->format('l, F j, Y') }}</p>
                    @if(Auth::user()->role === 'manager')
                        <p class="mt-2" style="color: #000000 !important;">🎯 You have {{ $stats['pending_approvals'] ?? 0 }} projects waiting for your approval</p>
                    @endif
                </div>
            </div>

            @if(Auth::user()->role === 'sales')
                <!-- Sales Action Banner -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg mb-6">
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold ">Quick Actions</h3>
                                <p class="text-blue-100 text-sm">Start your sales activities</p>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('leads.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg font-medium hover:bg-blue-50 transition-colors shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Lead
                                </a>
                                <a href="{{ route('leads.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-500 rounded-lg font-medium hover:bg-blue-400 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    View My Leads
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            @if(Auth::user()->role === 'sales')
                <!-- Sales-specific stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    
                    <!-- My Leads -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-blue-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">My Leads</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['my_leads'] ?? 0 }}</p>
                                    <p class="text-xs text-blue-600 mt-1" style="color: #000000 !important;">🎯 Leads assigned to me</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Projects -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">My Projects</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['my_projects'] ?? 0 }}</p>
                                    <p class="text-xs text-green-600 mt-1" style="color: #000000 !important;">📊 Projects I'm handling</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Customers -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-purple-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">My Customers</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['my_customers'] ?? 0 }}</p>
                                    <p class="text-xs text-purple-600 mt-1" style="color: #000000 !important;">👥 Customers I serve</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Approvals -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-orange-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Pending Approval</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['pending_approvals'] ?? 0 }}</p>
                                    <p class="text-xs text-orange-600 mt-1" style="color: #000000 !important;">⏳ Awaiting manager review</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(Auth::user()->role === 'manager')
                <!-- Manager-specific stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    
                    <!-- Pending Approvals (Priority for Manager) -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-red-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Pending Approvals</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['pending_approvals'] ?? 0 }}</p>
                                    <p class="text-xs text-red-600 mt-1" style="color: #000000 !important;">⚡ Requires immediate attention</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenue -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Monthly Revenue</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">Rp {{ number_format($stats['monthly_revenue'] ?? 0, 0, ',', '.') }}</p>
                                    <p class="text-xs text-green-600 mt-1" style="color: #000000 !important;">💰 Active subscriptions</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Projects -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-blue-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Total Projects</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['total_projects'] ?? 0 }}</p>
                                    <p class="text-xs text-blue-600 mt-1" style="color: #000000 !important;">📊 All projects managed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Team Performance -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-purple-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Active Customers</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['total_customers'] ?? 0 }}</p>
                                    <p class="text-xs text-purple-600 mt-1" style="color: #000000 !important;">👥 Satisfied clients</p>
                                </div>
                            </div>
                        </div>
                    </div>                    <!-- Total Revenue -->
                    </div>

                </div>                    <!-- Total Projects -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-blue-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Projects</h4>
                                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_projects'] ?? 0 }}</p>
                                    <p class="text-xs text-blue-600 mt-1">📊 All projects managed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Team Performance -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-purple-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Active Customers</h4>
                                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_customers'] ?? 0 }}</p>
                                    <p class="text-xs text-purple-600 mt-1">👥 Satisfied clients</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Manager Action Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    
                    <!-- Approval Queue -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border">
                        <div class="card-header px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">⏳ Approval Queue</h3>
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full" style="color: #000000 !important;">
                                    {{ $stats['pending_approvals'] ?? 0 }} pending
                                </span>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-sm text-gray-600 mb-4" style="color: #000000 !important;">Projects waiting for your approval decision</p>
                            <a href="{{ route('projects.approval-queue') }}" class="btn-solid bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center" style="background-color: #ef4444 !important; color: white !important; text-decoration: none !important;">
                                <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span style="color: white !important;">Review Projects</span>
                            </a>
                        </div>
                    </div>

                    <!-- Team Performance -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border">
                        <div class="card-header px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">📈 Team Performance</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full" style="color: #000000 !important;">
                                    Active
                                </span>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-sm text-gray-600 mb-4" style="color: #000000 !important;">Monitor sales team progress and targets</p>
                            <a href="#" class="btn-solid bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center" style="background-color: #10b981 !important; color: white !important;">
                                <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span style="color: white !important;">View Reports</span>
                            </a>
                        </div>
                    </div>

                    <!-- Revenue Analysis -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border">
                        <div class="card-header px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">💰 Revenue Analysis</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full" style="color: #000000 !important;">
                                    Monthly
                                </span>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-sm text-gray-600 mb-4" style="color: #000000 !important;">Financial insights and revenue tracking</p>
                            <a href="#" class="btn-solid bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center" style="background-color: #3b82f6 !important; color: white !important;">
                                <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                <span style="color: white !important;">View Analytics</span>
                            </a>
                        </div>
                    </div>

                </div>
            @elseif(Auth::user()->role === 'admin')
                <!-- Admin-specific stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    
                    <!-- Total Leads -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-blue-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Total Leads</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['total_leads'] ?? 0 }}</p>
                                    <p class="text-xs text-blue-600 mt-1" style="color: #000000 !important;">🎯 All system leads</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Products -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Total Products</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['total_products'] ?? 0 }}</p>
                                    <p class="text-xs text-green-600 mt-1" style="color: #000000 !important;">📦 Available services</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Projects -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-yellow-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Total Projects</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['total_projects'] ?? 0 }}</p>
                                    <p class="text-xs text-yellow-600 mt-1" style="color: #000000 !important;">📊 All system projects</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Customers -->
                    <div class="stat-card bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-red-500">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide" style="color: #000000 !important;">Total Customers</h4>
                                    <p class="text-3xl font-bold text-gray-900" style="color: #000000 !important;">{{ $stats['total_customers'] ?? 0 }}</p>
                                    <p class="text-xs text-red-600 mt-1" style="color: #000000 !important;">👥 Active clients</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Admin Action Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    
                    <!-- Add New Lead -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border border-blue-200 hover:shadow-xl transition-shadow">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-black">📝 Add New Lead</h3>
                                </div>
                                <a href="{{ route('leads.create') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #2563eb !important; color: white !important; text-decoration: none !important;">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span>ADD</span>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-black mb-4">Record new potential customer information</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Quick form submission
                                </div>
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Auto-assignment to you
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View All Leads -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border border-green-200 hover:shadow-xl transition-shadow">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-black">👥 View My Leads</h3>
                                        <span class="bg-green-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                            {{ $stats['total_leads'] ?? 0 }} leads
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('leads.index') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #059669 !important; text-decoration: none !important;">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span style="color: black !important;">VIEW</span>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-black mb-4">Manage all leads assigned to you</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update lead status
                                </div>
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Download PDF reports
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Projects -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border border-purple-200 hover:shadow-xl transition-shadow">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-purple-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-black">📊 My Projects</h3>
                                        <span class="bg-purple-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                            {{ $stats['total_projects'] ?? 0 }} projects
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('projects.all') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #7c3aed !important; color: white !important; text-decoration: none !important;">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span style="color: white !important;">VIEW</span>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-black mb-4">Track projects and approvals</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    View project progress
                                </div>
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Monitor approval status
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            <!-- Sales Dashboard Content -->
            @if(Auth::user()->role === 'sales')
                <!-- Quick Actions for Sales -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    
                    <!-- Add New Lead -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border border-blue-200 hover:shadow-xl transition-shadow">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-black">📝 Add New Lead</h3>
                                </div>
                                <a href="{{ route('leads.create') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-black mb-4">Record new potential customer information</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Quick form submission
                                </div>
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Auto-assignment to you
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Lead List -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border border-green-200 hover:shadow-xl transition-shadow">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-black">👥 View My Leads</h3>
                                        <span class="bg-green-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                            {{ $stats['my_leads'] ?? 0 }} leads
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('leads.index') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-black mb-4">Manage all leads assigned to you</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update lead status
                                </div>
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Download PDF reports
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Projects -->
                    <div class="action-card bg-white overflow-hidden shadow-lg sm:rounded-lg border border-purple-200 hover:shadow-xl transition-shadow">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-purple-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-black">📊 My Projects</h3>
                                        @if(($stats['pending_approvals'] ?? 0) > 0)
                                            <span class="bg-orange-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                                {{ $stats['pending_approvals'] ?? 0 }} pending
                                            </span>
                                        @else
                                            <span class="bg-purple-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                                {{ $stats['my_projects'] ?? 0 }} projects
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('projects.all') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    View
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-black mb-4">Track projects and approvals</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    View project progress
                                </div>
                                <div class="flex items-center text-xs text-black">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Monitor approval status
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                
                <!-- Recent Leads -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">🎯 Recent Leads</h3>
                            <a href="{{ route('leads.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium" style="color: #000000 !important;">View All</a>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($recentLeads && $recentLeads->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentLeads as $lead)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">{{ substr($lead->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="font-medium text-gray-900" style="color: #000000 !important;">{{ $lead->name }}</p>
                                        <p class="text-sm text-gray-600" style="color: #000000 !important;">{{ $lead->email }}</p>
                                        <div class="flex items-center mt-1">
                                            @php
                                                $statusColors = [
                                                    'new' => 'bg-blue-100 text-blue-800',
                                                    'contacted' => 'bg-yellow-100 text-yellow-800',
                                                    'qualified' => 'bg-green-100 text-green-800',
                                                    'proposal' => 'bg-purple-100 text-purple-800',
                                                    'negotiation' => 'bg-orange-100 text-orange-800',
                                                    'closed_won' => 'bg-green-100 text-green-800',
                                                    'closed_lost' => 'bg-red-100 text-red-800'
                                                ];
                                                $priorityColors = [
                                                    'low' => 'bg-gray-100 text-gray-800',
                                                    'medium' => 'bg-blue-100 text-blue-800',
                                                    'high' => 'bg-orange-100 text-orange-800',
                                                    'urgent' => 'bg-red-100 text-red-800'
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$lead->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($lead->status) }}
                                            </span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $priorityColors[$lead->priority] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($lead->priority) }} Priority
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500" style="color: #000000 !important;">{{ $lead->created_at ? $lead->created_at->diffForHumans() : 'N/A' }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900" style="color: #000000 !important;">No recent leads</h3>
                                <p class="mt-1 text-sm text-gray-500" style="color: #000000 !important;">Get started by creating a new lead.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Projects -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">📊 Recent Projects</h3>
                            <a href="{{ route('projects.all') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium" style="color: #000000 !important;">View All</a>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($recentProjects && $recentProjects->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentProjects as $project)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">{{ substr($project->project_code, -2) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="font-medium text-gray-900" style="color: #000000 !important;">{{ $project->project_code }}</p>
                                        <p class="text-sm text-gray-600" style="color: #000000 !important;">Value: Rp {{ number_format($project->project_value, 0, ',', '.') }}</p>
                                        <div class="flex items-center mt-1">
                                            @php
                                                $projectStatusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                                    'pending_approval' => 'bg-orange-100 text-orange-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'completed' => 'bg-green-100 text-green-800'
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $projectStatusColors[$project->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500" style="color: #000000 !important;">{{ $project->created_at ? $project->created_at->diffForHumans() : 'N/A' }}</p>
                                        @if(Auth::user()->role === 'manager' && $project->status === 'pending_approval')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 mt-1">
                                                Needs Review
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900" style="color: #000000 !important;">No recent projects</h3>
                                <p class="mt-1 text-sm text-gray-500" style="color: #000000 !important;">Projects will appear here once created.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Manager Quick Actions / General Quick Actions -->
            @if(Auth::user()->role === 'manager')
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">⚡ Manager Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <a href="{{ route('projects.approval-queue') }}" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #ef4444 !important; color: white !important; text-decoration: none !important; min-height: 60px;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span style="color: white !important;">Approve Projects</span>
                            </a>
                            <a href="{{ route('projects.all') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #3b82f6 !important; color: white !important; text-decoration: none !important; min-height: 60px;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span style="color: white !important;">View Reports</span>
                            </a>
                            <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Manage Team
                            </a>
                            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #8b5cf6 !important; color: white !important; text-decoration: none !important; min-height: 60px;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span style="color: white !important;">Revenue Analysis</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">⚡ Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <a href="{{ route('leads.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #3b82f6 !important; color: white !important; text-decoration: none !important;">
                                <span style="color: white !important;">Add Lead</span>
                            </a>
                            <a href="{{ route('projects.all') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #10b981 !important; color: white !important; text-decoration: none !important;">
                                <span style="color: white !important;">Create Project</span>
                            </a>
                            <a href="{{ route('leads.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #eab308 !important; color: white !important; text-decoration: none !important;">
                                <span style="color: white !important;">View Reports</span>
                            </a>
                            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors duration-200 flex items-center justify-center" style="background-color: #8b5cf6 !important; color: white !important; text-decoration: none !important;">
                                <span style="color: white !important;">Manage Users</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
