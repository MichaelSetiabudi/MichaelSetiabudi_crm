<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #000000 !important;">
                {{ __('Add New Lead - PT Smart ISP CRM') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('leads.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg" style="color: #000000 !important;">
                    Back to Leads
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        /* Make placeholder text darker and more visible */
        input::placeholder,
        textarea::placeholder {
            color: #374151 !important;
            opacity: 0.8 !important;
        }
        
        /* Ensure all form text is black */
        .form-input,
        .form-select,
        .form-textarea {
            color: #000000 !important;
        }
        
        /* Make sure input text is always black */
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select,
        textarea {
            color: #000000 !important;
        }
    </style>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-black">Lead Information</h3>
                    <p class="text-sm text-black">Fill in the details of the potential customer</p>
                </div>

                <form method="POST" action="{{ route('leads.store') }}" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Lead Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-black mb-2">
                                Lead Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   style="color: #000000 !important;"
                                   required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-black mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   style="color: #000000 !important;"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-black mb-2">
                                Phone Number
                            </label>
                            <input type="text" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   style="color: #000000 !important;" 
                                   placeholder="e.g., 021-12345678">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div>
                            <label for="company" class="block text-sm font-medium text-black mb-2">
                                Company Name
                            </label>
                            <input type="text" 
                                   id="company" 
                                   name="company" 
                                   value="{{ old('company') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   style="color: #000000 !important;" 
                                   placeholder="e.g., PT. Technology Solutions">
                            @error('company')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-black mb-2">
                                Status
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    style="color: #000000 !important;">
                                <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ old('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="qualified" {{ old('status') == 'qualified' ? 'selected' : '' }}>Qualified</option>
                                <option value="proposal" {{ old('status') == 'proposal' ? 'selected' : '' }}>Proposal</option>
                                <option value="negotiation" {{ old('status') == 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                                <option value="closed_won" {{ old('status') == 'closed_won' ? 'selected' : '' }}>Closed Won</option>
                                <option value="closed_lost" {{ old('status') == 'closed_lost' ? 'selected' : '' }}>Closed Lost</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priority -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-black mb-2">
                                Priority
                            </label>
                            <select id="priority" 
                                    name="priority" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    style="color: #000000 !important;">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : 'selected' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-sm font-medium text-black mb-2">
                                Lead Source
                            </label>
                            <select id="source" 
                                    name="source" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    style="color: #000000 !important;">
                                <option value="website" {{ old('source') == 'website' ? 'selected' : 'selected' }}>Website</option>
                                <option value="referral" {{ old('source') == 'referral' ? 'selected' : '' }}>Referral</option>
                                <option value="social_media" {{ old('source') == 'social_media' ? 'selected' : '' }}>Social Media</option>
                                <option value="advertisement" {{ old('source') == 'advertisement' ? 'selected' : '' }}>Advertisement</option>
                                <option value="cold_call" {{ old('source') == 'cold_call' ? 'selected' : '' }}>Cold Call</option>
                                <option value="trade_show" {{ old('source') == 'trade_show' ? 'selected' : '' }}>Trade Show</option>
                                <option value="other" {{ old('source') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('source')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estimated Value -->
                        <div>
                            <label for="estimated_value" class="block text-sm font-medium text-black mb-2">
                                Estimated Value (Rp)
                            </label>
                            <input type="number" 
                                   id="estimated_value" 
                                   name="estimated_value" 
                                   value="{{ old('estimated_value') }}"
                                   min="0"
                                   step="1000"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   style="color: #000000 !important;" 
                                   placeholder="e.g., 5000000">
                            @error('estimated_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-black mb-2">
                            Address
                        </label>
                        <textarea id="address" 
                                  name="address" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  style="color: #000000 !important;" 
                                  placeholder="Complete address of the lead">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-black mb-2">
                            Notes
                        </label>
                        <textarea id="notes" 
                                  name="notes" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  style="color: #000000 !important;" 
                                  placeholder="Additional notes about this lead, conversation details, requirements, etc.">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assign To (for managers/admins) -->
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                    <div class="mt-6">
                        <label for="assigned_to" class="block text-sm font-medium text-black mb-2">
                            Assign to Sales
                        </label>
                        <select id="assigned_to" 
                                name="assigned_to" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                style="color: #000000 !important;">
                            <option value="">Select Sales Person</option>
                            @foreach($users as $salesUser)
                                <option value="{{ $salesUser->id }}" {{ old('assigned_to') == $salesUser->id ? 'selected' : '' }}>
                                    {{ $salesUser->name }} ({{ $salesUser->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('leads.index') }}" 
                           class="px-6 py-2 bg-gray-200 border border-gray-400 rounded-md text-gray-800 hover:bg-gray-300 transition-colors font-medium">
                            ← Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors shadow-lg font-semibold border-2 border-green-600 hover:border-green-700"
                                style="color: #ffffff !important;">
                            💾 Create Lead
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
