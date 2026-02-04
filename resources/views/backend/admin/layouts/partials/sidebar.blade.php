<aside class="transition-all duration-300 ease-in-out z-50 max-h-screen py-2 pl-2"
    :class="{
        'w-72': desktop && sidebar_expanded,
        'w-20': desktop && !sidebar_expanded,
        'fixed top-0 left-0 h-full': !desktop,
        'w-72 translate-x-0': !desktop && mobile_menu_open,
        'w-72 -translate-x-full': !desktop && !mobile_menu_open,
    }">

    <div class="sidebar-glass-card h-full rounded-xl overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="p-4 inline-block">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10  shadow inset-shadow-lg p-0 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                </div>
                <div x-show="(desktop && sidebar_expanded) || (!desktop && mobile_menu_open)"
                    x-transition:enter="transition-all duration-300 delay-75"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition-all duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-4">
                    <h1 class="text-xl font-bold text-accent-content">{{ "CTC BD" }}</h1>
                    <p class="text-text-secondary text-sm">{{ "Coffee Training Centerat BD" }}</p>
                </div>
            </div>
        </a>

        <flux:separator class="bg-accent!" />

        <nav class="p-2 space-y-2">
            <x-backend.navlink type="single" icon="layout-dashboard" name="Dashboard" :route="route('admin.dashboard')"
                active="dashboard" :page_slug="$active" />
            <x-backend.navlink type="single" icon="user-circle" name="Admins" :route="route('admin.index')"
                active="admin" :page_slug="$active" />
            <x-backend.navlink type="single" icon="user-circle" name="Students" :route="route('student.index')"
                active="student" :page_slug="$active" />

            <div class="space-y-2">
                <flux:separator class="bg-accent!" />
                <button wire:click="logout" class="w-full text-left">
                    <x-backend.navlink type="single" icon="power" name="Logout" />
                </button>
            </div>
        </nav>
    </div>
</aside>
