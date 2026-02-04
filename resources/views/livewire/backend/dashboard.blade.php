<main>
    <section>
        <div class="glass-card rounded-2xl p-6 mb-8">
            <div class="flex items-center justify-center">
                <h3 class="text-2xl font-bold text-text-primary">{{ __('Admin Dashboard') }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">

        
            <!-- Total Users -->
            <div class="glass-card rounded-2xl p-6 card-hover float" style="animation-delay: 0s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <flux:icon name="check-badge" class="w-6 h-6 text-yellow-400" />
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-1">
                    {{ number_format($stats['total_users']) }}
                </h3>
                <p class="text-text-secondary text-sm">{{ __('Total Users') }}</p>
                <div class="mt-4 h-1 bg-zinc-200 dark:bg-zinc-800 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full progress-bar"
                        style="width: 100%;"></div>
                </div>
            </div>
            <!-- Active Users -->
            <div class="glass-card rounded-2xl p-6 card-hover float" style="animation-delay: 0s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <flux:icon name="check-badge" class="w-6 h-6 text-yellow-400" />
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-1">
                    {{ number_format($stats['active_users']) }}
                </h3>
                <p class="text-text-secondary text-sm">{{ __('Active Users') }}</p>
                <div class="mt-4 h-1 bg-zinc-200 dark:bg-zinc-800 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full progress-bar"
                        style="width: 100%;"></div>
                </div>
            </div>

            <!-- Inactive Users -->
            <div class="glass-card rounded-2xl p-6 card-hover float" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                        <flux:icon name="archive-box" class="w-6 h-6 text-orange-400" />
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-1">
                    {{ number_format($stats['inactive_users']) }}
                </h3>
                <p class="text-text-secondary text-sm">{{ __('Inactive Users') }}</p>
                <div class="mt-4 h-1 bg-zinc-200 dark:bg-zinc-800 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-orange-400 to-orange-600 rounded-full progress-bar"
                        style="width: 100%;"></div>
                </div>
            </div>

        </div>


     

    </section>
</main>
