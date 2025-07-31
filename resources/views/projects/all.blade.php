<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #000000 !important;">
                {{ __('All Projects - PT Smart ISP CRM') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('projects.pdf') }}" 
                   class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg flex items-center" 
                   style="background-color: #dc2626 !important; color: #ffffff !important; text-decoration: none !important;">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" style="color: #ffffff !important;">
                        <path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"/>
                    </svg>
                    <span style="color: #ffffff !important;">Download PDF</span>
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg"
                   style="background-color: #4b5563 !important; color: #ffffff !important; text-decoration: none !important;">
                    <span style="color: #ffffff !important;">Back to Dashboard</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Projects Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 16a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium" style="color: #000000 !important;">Total Projects</p>
                    <p class="text-2xl font-bold" style="color: #000000 !important;">{{ $projects->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium" style="color: #000000 !important;">Approved</p>
                    <p class="text-2xl font-bold" style="color: #000000 !important;">{{ $projects->where('status', 'approved')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Approval</p>
                    <p class="text-2xl font-bold text-black">{{ $projects->where('status', 'pending_approval')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Value</p>
                    <p class="text-2xl font-bold text-black">Rp {{ number_format($projects->sum('project_value'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Project Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Lead/Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Sales Person</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #000000 !important;">Approval Info</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($projects as $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-sm font-medium" style="color: #000000 !important;">{{ $project->project_code }}</div>
                                <div class="text-sm" style="color: #000000 !important;">{{ $project->contract_duration_months }} months</div>
                                @if($project->expected_close_date)
                                <div class="text-xs" style="color: #000000 !important;">Expected: {{ $project->expected_close_date->format('d M Y') }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                @if($project->lead)
                                <div class="text-sm font-medium" style="color: #000000 !important;">{{ $project->lead->name }}</div>
                                <div class="text-sm" style="color: #000000 !important;">{{ $project->lead->email }}</div>
                                <div class="text-xs" style="color: #000000 !important;">{{ $project->lead->company }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($project->product)
                            <div class="text-sm font-medium text-black">{{ $project->product->name }}</div>
                            <div class="text-sm text-gray-500">{{ $project->product->type }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($project->assignedSales)
                            <div class="text-sm font-medium text-black">{{ $project->assignedSales->name }}</div>
                            <div class="text-sm text-gray-500">{{ $project->assignedSales->email }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-black">Rp {{ number_format($project->project_value, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($project->status === 'approved') bg-green-100 text-green-800
                                @elseif($project->status === 'rejected') bg-red-100 text-red-800
                                @elseif($project->status === 'pending_approval') bg-yellow-100 text-yellow-800
                                @elseif($project->status === 'completed') bg-blue-100 text-blue-800
                                @elseif($project->status === 'in_progress') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($project->status === 'approved' && $project->approvedBy)
                                <div class="text-green-600">
                                    <div class="font-medium">Approved by {{ $project->approvedBy->name }}</div>
                                    <div class="text-xs">{{ $project->approved_at->format('d M Y H:i') }}</div>
                                </div>
                            @elseif($project->status === 'rejected' && $project->rejectedBy)
                                <div class="text-red-600">
                                    <div class="font-medium">Rejected by {{ $project->rejectedBy->name }}</div>
                                    <div class="text-xs">{{ $project->rejected_at->format('d M Y H:i') }}</div>
                                    @if($project->rejection_reason)
                                    <div class="text-xs text-gray-500 mt-1">{{ $project->rejection_reason }}</div>
                                    @endif
                                </div>
                            @elseif($project->status === 'pending_approval')
                                <span class="text-yellow-600">Awaiting approval</span>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No projects found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>
</x-app-layout>