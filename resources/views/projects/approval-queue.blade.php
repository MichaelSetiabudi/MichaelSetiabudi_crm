<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #000000 !important;">
                {{ __('Project Approval Queue') }}
            </h2>
            <div class="text-sm text-gray-600" style="color: #000000 !important;">
                {{ $pendingProjects->count() }} projects pending approval
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($pendingProjects->count() > 0)
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">
                            🎯 Projects Waiting for Your Approval
                        </h3>
                        <p class="text-sm text-gray-600 mt-1" style="color: #000000 !important;">
                            Review and approve or reject pending project proposals
                        </p>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @foreach($pendingProjects as $project)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                            <span class="text-white font-bold text-sm">{{ substr($project->project_code, -2) }}</span>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900" style="color: #000000 !important;">
                                                {{ $project->project_code }}
                                            </h4>
                                            <p class="text-sm text-gray-600" style="color: #000000 !important;">
                                                Submitted by: {{ $project->assignedSales->name ?? 'Unknown' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700" style="color: #000000 !important;">Description:</p>
                                            <p class="text-sm text-gray-600" style="color: #000000 !important;">{{ $project->description }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700" style="color: #000000 !important;">Project Value:</p>
                                            <p class="text-lg font-bold text-green-600" style="color: #000000 !important;">
                                                Rp {{ number_format($project->project_value, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                        @if($project->lead)
                                        <div>
                                            <p class="text-sm font-medium text-gray-700" style="color: #000000 !important;">Lead:</p>
                                            <p class="text-sm text-gray-600" style="color: #000000 !important;">{{ $project->lead->name }}</p>
                                            <p class="text-xs text-gray-500" style="color: #000000 !important;">{{ $project->lead->email }}</p>
                                        </div>
                                        @endif
                                        
                                        @if($project->customer)
                                        <div>
                                            <p class="text-sm font-medium text-gray-700" style="color: #000000 !important;">Customer:</p>
                                            <p class="text-sm text-gray-600" style="color: #000000 !important;">{{ $project->customer->company_name }}</p>
                                            <p class="text-xs text-gray-500" style="color: #000000 !important;">{{ $project->customer->email }}</p>
                                        </div>
                                        @endif
                                        
                                        <div>
                                            <p class="text-sm font-medium text-gray-700" style="color: #000000 !important;">Expected Close:</p>
                                            <p class="text-sm text-gray-600" style="color: #000000 !important;">
                                                {{ $project->expected_close_date ? \Carbon\Carbon::parse($project->expected_close_date)->format('M d, Y') : 'Not set' }}
                                            </p>
                                            <p class="text-xs text-gray-500" style="color: #000000 !important;">
                                                Submitted {{ $project->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col space-y-2 ml-4">
                                    <!-- Approve Button -->
                                    <form method="POST" action="{{ route('projects.approve', $project) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center transition-colors"
                                                style="background-color: #10b981 !important; color: #ffffff !important;"
                                                onclick="return confirm('Are you sure you want to approve this project?')">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span style="color: #ffffff !important;">Approve</span>
                                        </button>
                                    </form>

                                    <!-- Reject Button -->
                                    <button type="button" 
                                            class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center transition-colors"
                                            style="background-color: #ef4444 !important; color: #ffffff !important;"
                                            onclick="openRejectModal('{{ $project->id }}', '{{ $project->project_code }}')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span style="color: #ffffff !important;">Reject</span>
                                    </button>

                                    <!-- View Details Button -->
                                    <a href="{{ route('projects.show', $project) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center transition-colors text-center"
                                       style="background-color: #3b82f6 !important; color: #ffffff !important; text-decoration: none !important;">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span style="color: #ffffff !important;">View</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2" style="color: #000000 !important;">
                            No Projects Pending Approval
                        </h3>
                        <p class="text-gray-600" style="color: #000000 !important;">
                            All projects have been reviewed. New submissions will appear here.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('dashboard') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center transition-colors"
                               style="background-color: #3b82f6 !important; color: white !important; text-decoration: none !important;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span style="color: white !important;">Back to Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4" style="color: #000000 !important;">
                    Reject Project
                </h3>
                <p class="text-sm text-gray-600 mb-4" style="color: #000000 !important;">
                    Please provide a reason for rejecting this project:
                </p>
                
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="rejection_reason" 
                              rows="4" 
                              class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm mb-4"
                              style="color: #000000 !important;"
                              placeholder="Enter rejection reason..." 
                              required></textarea>
                    
                    <div class="flex justify-center space-x-4">
                        <button type="button" 
                                onclick="closeRejectModal()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium"
                                style="background-color: #ef4444 !important; color: white !important;">
                            <span style="color: white !important;">Reject Project</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(projectId, projectCode) {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectForm').action = `/projects/${projectId}/reject`;
            document.querySelector('#rejectModal h3').textContent = `Reject Project: ${projectCode}`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectForm').reset();
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</x-app-layout>
