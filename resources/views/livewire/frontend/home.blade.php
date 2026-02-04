<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
    <!-- Animated Background Pattern -->
    <div class="fixed inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M30 30m-20 0a20 20 0 1 0 40 0a20 20 0 1 0 -40 0\" fill=\"%238B4513\" fill-opacity=\"0.4\"/%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
    </div>

    <!-- Navbar -->
    <nav class="relative bg-white/80 backdrop-blur-xl shadow-lg border-b border-amber-100">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-full shadow-lg transform hover:scale-110 transition-transform duration-300">
                        <img class="w-full h-full object-contain" src="{{ asset('assets/images/logo.png') }}" alt="Espresso Express Café">
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-extrabold bg-gradient-to-r from-amber-700 via-orange-600 to-red-700 bg-clip-text text-transparent">
                            Espresso Express Café
                        </h1>
                        <p class="text-sm md:text-base text-gray-600 font-medium">Coffee Training Center • BD</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3 bg-green-50 px-4 py-2 rounded-full border border-green-200">
                    <div class="relative">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-ping absolute"></div>
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    </div>
                    <span class="text-green-700 font-semibold text-sm">System Active</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 md:py-20">
        
        <!-- Hero Section -->
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl md:text-6xl font-black text-gray-800 mb-4 tracking-tight">
                Verify Your <span class="bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 bg-clip-text text-transparent">Certificate</span>
            </h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto font-medium">
                Authenticate your coffee training credentials instantly with our secure verification system
            </p>
        </div>

        <!-- Search Card -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-amber-100 overflow-hidden">
                
                <!-- Decorative Header -->
                <div class="h-2 bg-gradient-to-r from-amber-500 via-orange-500 to-red-500"></div>
                
                <div class="p-8 md:p-12">
                    <!-- Passport Search Form -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold mb-3 text-base md:text-lg flex items-center justify-center md:justify-start">
                            <svg class="w-6 h-6 mr-2 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Enter Your Passport ID Number
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   wire:model="searchPassportId"
                                   wire:keydown.enter="searchCertificate"
                                   placeholder="e.g., BD123456789" 
                                   class="w-full pl-16 pr-6 py-5 rounded-2xl border-3 border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-200 outline-none text-gray-800 text-lg font-semibold placeholder-gray-400 transition-all duration-300 transform focus:scale-[1.02] bg-gradient-to-br from-white to-amber-50">
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 text-amber-600 opacity-0 group-focus-within:opacity-100 transition-opacity">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            
                        </div>
                        <x-ui.input-error :messages="$errors->get('searchPassportId')" />
                        <p class="mt-3 text-sm text-gray-500 text-center md:text-left flex items-center justify-center md:justify-start">
                            <svg class="w-4 h-4 mr-1.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Enter the passport ID you used during enrollment
                        </p>
                    </div>

                    <button wire:click="searchCertificate" 
                            wire:loading.attr="disabled"
                            class="w-full bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 hover:from-amber-600 hover:via-orange-600 hover:to-red-600 text-white py-5 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center space-x-3 group disabled:opacity-70 disabled:cursor-not-allowed">
                        <svg wire:loading.remove class="w-7 h-7 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <svg wire:loading class="animate-spin w-7 h-7" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove>Verify Certificate</span>
                        <span wire:loading>Searching...</span>
                    </button>

                </div>
            </div>
        </div>

        <!-- Result Section -->
        @if($showResult && $foundStudent)
        <div class="max-w-4xl mx-auto animate-slide-up">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200 overflow-hidden">
                
                <!-- Success Header -->
                {{-- <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-8 text-center">
                    <div class="inline-block mb-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/30 rounded-full animate-ping"></div>
                            <div class="relative w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-2xl">
                                <svg class="w-14 h-14 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-white mb-2">Certificate Found!</h3>
                    <p class="text-green-100 text-lg font-medium">Your training record has been successfully located</p>
                </div> --}}

                <div class="p-8 md:p-12">
                    
                    <!-- Student Information Card -->
                    {{-- <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 rounded-2xl p-8 mb-8 border-2 border-amber-200 shadow-lg">
                        <div class="flex items-center mb-6 pb-6 border-b-2 border-amber-200">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white font-black text-2xl shadow-lg mr-4">
                                {{ strtoupper(substr($foundStudent->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold mb-1">STUDENT NAME</p>
                                <p class="text-2xl font-black text-gray-800">{{ $foundStudent->name }}</p>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Passport ID</p>
                                <p class="text-xl font-bold text-gray-800">{{ $foundStudent->passport_id }}</p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Phone Number</p>
                                <p class="text-xl font-bold text-gray-800">{{ $foundStudent->phone }}</p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Enrollment Date</p>
                                <p class="text-xl font-bold text-gray-800">{{ $foundStudent->created_at->format('F d, Y') }}</p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Training Status</p>
                                <div class="flex items-center">
                                    <span class="px-4 py-2 text-sm rounded-full shadow-md flex items-center badge badge-soft {{ $foundStudent->status_color }}">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $foundStudent->status_label }}
                                    </span>
                                </div>
                            </div>
                            @if($foundStudent->address)
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow md:col-span-2">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Address</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $foundStudent->address }}</p>
                            </div>
                            @endif
                            @if($foundStudent->reference_by)
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Reference By</p>
                                <p class="text-xl font-bold text-gray-800">{{ $foundStudent->reference_by }}</p>
                            </div>
                            @endif
                            @if($foundStudent->reference_contact)
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Reference Contact</p>
                                <p class="text-xl font-bold text-gray-800">{{ $foundStudent->reference_contact }}</p>
                            </div>
                            @endif
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-2">Payment Amount</p>
                                <p class="text-xl font-bold text-gray-800">৳{{ number_format($foundStudent->payment, 2) }}</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Status Alert - Based on Student Status -->
                    @if($foundStudent->status->value === 'inactive')
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-500 p-6 mb-8 rounded-xl shadow-md">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-lg font-black text-yellow-900 mb-2">⚠️ Course Not Yet Completed</h4>
                                <p class="text-yellow-800 font-medium leading-relaxed">
                                    Your certificate is currently being prepared. Please complete all training modules and pass the final assessment to receive your official certificate.
                                </p>
                            </div>
                        </div>
                    </div>
                    @elseif($foundStudent->status->value === 'active')
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-6 mb-8 rounded-xl shadow-md">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-lg font-black text-green-900 mb-2">✅ Course Completed Successfully</h4>
                                <p class="text-green-800 font-medium leading-relaxed">
                                    Congratulations! You have successfully completed your training. Your certificate is ready for download.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col md:flex-row gap-4">
                        <button wire:click="resetSearch" 
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>New Search</span>
                        </button>
                        <button @if($foundStudent->status->value !== 'active') disabled @else wire:click="downloadCertificate()" @endif
                                class="flex-1 font-bold py-4 px-8 rounded-2xl flex items-center justify-center space-x-2 shadow-md relative overflow-hidden transition-all duration-300
                                    {{ $foundStudent->status->value === 'active' 
                                        ? 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white transform hover:scale-105 cursor-pointer' 
                                        : 'bg-gradient-to-r from-gray-300 to-gray-400 text-gray-600 cursor-not-allowed' }}">
                            @if($foundStudent->status->value !== 'active')
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-shimmer"></div>
                            @endif
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Download Certificate</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        @endif

        <!-- Not Found Message -->
        @if($notFound)
        <div class="max-w-4xl mx-auto animate-slide-up">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-red-200 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-rose-600 p-8 text-center">
                    <div class="inline-block mb-4">
                        <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-2xl">
                            <svg class="w-14 h-14 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-white mb-2">Certificate Not Found</h3>
                    <p class="text-red-100 text-lg font-medium">No record matches your passport ID</p>
                </div>
                <div class="p-8 md:p-12 text-center">
                    <p class="text-gray-600 mb-6 text-lg">
                        We couldn't find any certificate associated with the passport ID you entered. Please verify your passport ID and try again.
                    </p>
                    <button wire:click="resetSearch" 
                            class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 hover:from-amber-600 hover:via-orange-600 hover:to-red-600 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Try Another Search
                    </button>
                </div>
            </div>
        </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="relative mt-20 py-8 bg-gradient-to-r from-amber-900/10 via-orange-900/10 to-red-900/10 backdrop-blur-sm border-t border-amber-200">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="mb-4">
                    <div class="inline-flex items-center space-x-2 text-amber-700 font-bold text-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        <span>Espresso Express Café</span>
                    </div>
                </div>
                <p class="text-gray-600 font-medium mb-2">
                    &copy; {{ date('Y') }} Coffee Training Center Bangladesh. All rights reserved.
                </p>
                <p class="text-amber-700 text-sm font-semibold">
                    ☕ Powered by Excellence in Coffee Education
                </p>
            </div>
        </div>
    </footer>
</div>

@push('styles')
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }

    .animate-slide-up {
        animation: slide-up 0.6s ease-out;
    }

    .animate-shimmer {
        animation: shimmer 2s infinite;
    }

    .border-3 {
        border-width: 3px;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #fef3c7;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f59e0b, #ea580c);
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #d97706, #c2410c);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        // Listen for scroll-to-result event
        Livewire.on('scroll-to-result', () => {
            setTimeout(() => {
                const resultSection = document.querySelector('.animate-slide-up');
                if (resultSection) {
                    resultSection.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }, 100);
        });

        // Listen for scroll-to-top event
        Livewire.on('scroll-to-top', () => {
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });
    });

    document.addEventListener('livewire:init', () => {
        // Listen for scroll-to-result event
        Livewire.on('scroll-to-result', () => {
            setTimeout(() => {
                const resultSection = document.querySelector('.animate-slide-up');
                if (resultSection) {
                    resultSection.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }, 100);
        });

        // Listen for scroll-to-top event
        Livewire.on('scroll-to-top', () => {
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });
    });
</script>

@endpush