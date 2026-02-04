<header class="sticky top-0 z-50 bg-primary transition-all duration-300" id="header">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a class="no-underline" href="#">
            <span class="text-white font-black tracking-wide text-lg mr-2">CENTRAL</span>
            <div class="text-second-500 text-xs tracking-widest uppercase">Executive Transfers</div>
        </a>
        <nav class="hidden md:flex gap-2" id="nav">

            <a href="#booking"
                class="nav_link group">
                Book
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

            <a href="#why"
                class="nav_link group">
                Why us
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

            <a href="#prices"
                class="nav_link group">
                Prices
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

            <a href="#fleet"
                class="nav_link group">
                Fleet
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

            <a href="#reviews"
                class="nav_link group">
                Reviews
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

            <a href="#faq"
                class="nav_link group">
                FAQs
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

            <a href="#contact"
                class="nav_link group">
                Contact
                <span
                    class="nav_style group-hover:w-full!"></span>
            </a>

        </nav>

        <button id="menuBtn" aria-label="Menu"
            class="md:hidden bg-transparent text-white border border-gray-600 rounded-lg px-3 py-2 text-lg cursor-pointer">☰</button>
    </div>
    <nav class="hidden md:hidden absolute top-[58px] left-0 right-0 bg-gray-900 p-2 border-b border-gray-800"
        id="mobileNav">
        <a href="#booking" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">Book</a>
        <a href="#why" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">Why us</a>
        <a href="#prices" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">Prices</a>
        <a href="#fleet" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">Fleet</a>
        <a href="#reviews" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">Reviews</a>
        <a href="#faq" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">FAQs</a>
        <a href="#contact" class="block text-white no-underline font-semibold my-2 hover:text-second-500 hover:bg-white/10 p-2">Contact</a>
    </nav>
</header>

<script>
    // Mobile nav toggle
    document.getElementById('menuBtn')?.addEventListener('click', function() {
        const nav = document.getElementById('mobileNav');
        if (!nav) return;
        nav.classList.toggle('hidden');
    });

    // Smooth anchor scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const id = a.getAttribute('href');
            if (id && id.length > 1) {
                e.preventDefault();
                document.getElementById('mobileNav')?.classList.add('hidden');
                document.querySelector(id)?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Header shrink
    (function() {
        const h = document.getElementById('header');
        if (!h) return;
        const onScroll = () => {
            if (window.scrollY > 40) {
                h.querySelector('.max-w-\\[1120px\\]').classList.add('py-1');
                h.querySelector('.max-w-\\[1120px\\]').classList.remove('py-3');
            } else {
                h.querySelector('.max-w-\\[1120px\\]').classList.remove('py-1');
                h.querySelector('.max-w-\\[1120px\\]').classList.add('py-3');
            }
        };
        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        onScroll();
    })();

    // dataLayer events
    window.dataLayer = window.dataLayer || [];

    function pushEvt(name, params) {
        try {
            dataLayer.push(Object.assign({
                event: name
            }, params || {}));
        } catch (e) {}
    }

    document.querySelectorAll('a[href^="tel:"]').forEach(a => a.addEventListener('click', () => pushEvt(
        'phone_click')));
    document.querySelectorAll('a[href^="https://wa.me"]').forEach(a => a.addEventListener('click', () => pushEvt(
        'whatsapp_click')));
    document.querySelectorAll('.js-quote, a[href="#booking"]').forEach(a => a.addEventListener('click', () => pushEvt(
        'start_booking')));
    document.querySelectorAll('#nav a[href^="#"], #mobileNav a[href^="#"]').forEach(a => a.addEventListener('click',
        () => pushEvt('nav_click', {
            target: a.getAttribute('href')
        })));
</script>
