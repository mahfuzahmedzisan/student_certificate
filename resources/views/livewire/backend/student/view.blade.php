<div>
    {{-- Page Header --}}

    <div class="bg-bg-secondary w-full rounded">
        <div class="mx-auto">
            <div class="glass-card rounded-2xl p-4 lg:p-6 mb-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <h2 class="text-xl lg:text-2xl font-bold text-text-black dark:text-text-white">
                        {{ __('Student Details') }}
                    </h2>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <x-ui.button href="{{ route('student.index') }}" class="w-auto py-2!">
                            <flux:icon name="arrow-left"
                                class="w-4 h-4 stroke-text-btn-primary group-hover:stroke-text-btn-secondary" />
                            {{ __('Back') }}
                        </x-ui.button>
                    </div>
                </div>
            </div>
            <!-- Main Card -->
            <div class="bg-bg-primary rounded-2xl shadow-lg overflow-hidden border border-gray-500/20">

                <div class="grid lg:grid-cols-3 gap-6">

                    {{-- Left Column --}}
                    <div class="flex flex-col h-auto p-4   ">
                        <div class="w-32 h-32 rounded-full mx-auto mb-6 border-4 border-pink-100 overflow-hidden">
                            @if($model->image)
                            <img src="{{storage_url($model->image)}}"
                                alt="Profile Image" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 font-semibold">{{strtoupper(substr($model->name, 0, 2))}}</div>
                            @endif
                        </div>

                        <div class="flex flex-col items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-center mb-1 text-text-primary">{{ $model->name }}</h3>
                            <p class="text-text-secondary">{{ $model->phone }}</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card shadow-glass-card rounded-xl p-6 min-h-[500px]">
                <!-- Product Data Section -->
                <div class="px-8 py-8">
                    <div class="mb-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Name') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->name }}</p>
                            </div>

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Email') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->phone }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">
                                    {{ __('Passport Id') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">
                                    {{ $model->passport_id ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Status') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->status }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Reference By') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->reference_by }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Reference Contact') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->reference_contact }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Payment') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->payment }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Nominee Name') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->nominee_name ?? "N/A" }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Nominee Number') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->nominee_number ?? "N/A" }}</p>
                            </div>
                             <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Created At') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->created_at_formatted ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200 md:col-span-2 lg:col-span-4">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">
                                    {{ __('Address') }}</p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->address ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Updated At') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->updated_at_formatted ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Deleted At') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">{{ $model->deleted_at_formatted ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Restored At') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">
                                    {{ $model->restored_at_formatted ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Created By') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">
                                    {{ $model->creater_admin->name ?? 'N/A' }}</p>
                            </div>

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Updated By') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">
                                    {{ $model->updater_admin->name ?? 'N/A' }}</p>
                            </div>

                            <div class="bg-slate-50 dark:bg-gray-700 rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Deleted By') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">
                                    {{ $model->deleter_admin->name ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-gray-700  rounded-lg p-4 border border-slate-200">
                                <p class="text-text-white text-xs font-semibold mb-2 uppercase">{{ __('Restored By') }}
                                </p>
                                <p class="text-slate-400 text-lg font-bold">
                                    {{ $model->restorer_admin->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
