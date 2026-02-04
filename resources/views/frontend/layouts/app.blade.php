<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon" />
    <title>
        {{ isset($title) ? $title : site_name() }}
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance()
    <style>
        :root {
            --livewire-progress-bar-color: var(--color-secondary-500) !important;
        }

        @keyframes bounce-dot {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
    <script>
        document.addEventListener('livewire:initialized', function() {
            Livewire.on('notify', (event) => {
                showAlert(event.type, event.message);
            });
        });
    </script>
    @stack('styles')
    @stack('head_scripts')
</head>

<body class="min-h-screen scroll-smooth flex flex-col bg-white">

    <main class="flex-1">
        {{ $slot }}
    </main>

    <div id="navigation-loader" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-bg-primary/50 backdrop-blur-md">
        <div class="flex space-x-2">
            <div class="w-4 h-4 rounded-full bg-accent animate-[bounce-dot_1.2s_infinite]"
                style="animation-delay: -0.8s;"></div>
            <div class="w-4 h-4 rounded-full bg-accent-foreground animate-[bounce-dot_1.2s_infinite]"
                style="animation-delay: -0.4s;"></div>
            <div class="w-4 h-4 rounded-full bg-accent animate-[bounce-dot_1.2s_infinite]"></div>
        </div>
    </div>


    @fluxScripts()


    <script>
        document.addEventListener('livewire:navigate', (event) => {
            document.getElementById('navigation-loader').classList.remove('hidden');
        });
        document.addEventListener('livewire:navigating', () => {
            document.getElementById('navigation-loader').classList.remove('hidden');
        });
        document.addEventListener('livewire:navigated', () => {
            document.getElementById('navigation-loader').classList.add('hidden');
        });
    </script>
    @stack('scripts')
</body>

</html>
