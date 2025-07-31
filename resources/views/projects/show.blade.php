<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #000000 !important;">
                {{ __('Project Details: ') . $project->project_code }}
            </h2>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $project->status === 'approved' ? 'bg-green-100 text-green-800' : 
                       ($project->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                       ($project->status === 'pending_approval' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}"
                       style="color: #000000 !important;">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">
                        📊 Project Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Project Code</h4>
                            <p class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">{{ $project->project_code }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Project Value</h4>
                            <p class="text-lg font-bold text-green-600" style="color: #000000 !important;">
                                Rp {{ number_format($project->project_value, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Expected Close Date</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">
                                {{ $project->expected_close_date ? \Carbon\Carbon::parse($project->expected_close_date)->format('F d, Y') : 'Not set' }}
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Assigned Sales</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">
                                {{ $project->assignedSales->name ?? 'Not assigned' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Description</h4>
                        <p class="text-gray-900" style="color: #000000 !important;">{{ $project->description }}</p>
                    </div>
                </div>
            </div>

            @if($project->lead)
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">
                        🎯 Lead Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Name</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->lead->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Email</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->lead->email }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Phone</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->lead->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Company</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->lead->company ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($project->customer)
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900" style="color: #000000 !important;">
                        👥 Customer Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Company Name</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->customer->company_name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Email</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->customer->email }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Phone</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->customer->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2" style="color: #000000 !important;">Address</h4>
                            <p class="text-gray-900" style="color: #000000 !important;">{{ $project->customer->address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($project->status === 'rejected' && $project->rejection_reason)
            <div class="bg-red-50 border border-red-200 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-red-200 bg-red-100">
                    <h3 class="text-lg font-semibold text-red-800" style="color: #000000 !important;">
                        ❌ Rejection Details
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-red-700" style="color: #000000 !important;">{{ $project->rejection_reason }}</p>
                    <p class="text-sm text-red-600 mt-2" style="color: #000000 !important;">
                        Rejected {{ $project->rejected_at ? \Carbon\Carbon::parse($project->rejected_at)->diffForHumans() : 'at unknown time' }}
                    </p>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-wrap gap-4">
                        @if(Auth::user()->role === 'manager' && $project->status === 'pending_approval')
                            <!-- Approve Button -->
                            <form method="POST" action="{{ route('projects.approve', $project) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-600 px-6 py-3 rounded-lg font-medium inline-flex items-center transition-colors"
                                        style="background-color: #10b981 !important; color: #ffffff !important;"
                                        onclick="return confirm('Are you sure you want to approve this project?')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span style="color: #ffffff !important;">Approve Project</span>
                                </button>
                            </form>

                            <!-- Reject Button -->
                            <button type="button" 
                                    class="bg-red-500 hover:bg-red-600 px-6 py-3 rounded-lg font-medium inline-flex items-center transition-colors"
                                    style="background-color: #ef4444 !important; color: #ffffff !important;"
                                    onclick="openRejectModal('{{ $project->id }}', '{{ $project->project_code }}')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span style="color: #ffffff !important;">Reject Project</span>
                            </button>
                        @endif

                        <!-- Back Button -->
                        <a href="{{ route('projects.approval-queue') }}" 
                           class="bg-gray-500 hover:bg-gray-600 px-6 py-3 rounded-lg font-medium inline-flex items-center transition-colors"
                           style="background-color: #6b7280 !important; color: #ffffff !important; text-decoration: none !important;">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span style="color: #ffffff !important;">Back to Approval Queue</span>
                        </a>

                        <!-- Edit Button (if allowed) -->
                        @if($project->status === 'pending_approval' && (Auth::user()->role === 'manager' || Auth::id() === $project->assigned_sales_id))
                            <a href="{{ route('projects.edit', $project) }}" 
                               class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg font-medium inline-flex items-center transition-colors"
                               style="background-color: #3b82f6 !important; color: #ffffff !important; text-decoration: none !important;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span style="color: #ffffff !important;">Edit Project</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
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
