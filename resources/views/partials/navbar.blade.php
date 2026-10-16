<header class="nav">
    <div class="container nav__inner">
        <a class="nav__brand" href="{{ route('home') }}" aria-label="Titian, ke beranda">
            <x-logo />
        </a>

        <nav class="nav__links" aria-label="Menu utama">
            <a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Beranda</a>
            <a href="{{ route('menu') }}" @if (request()->routeIs('menu', 'menu.show')) aria-current="page" @endif>Menu</a>
            <a href="{{ route('custom') }}" @if (request()->routeIs('custom')) aria-current="page" @endif>Kue Custom</a>
        </nav>

        <div class="nav__actions">
            <a class="cart-link" href="{{ route('cart') }}" aria-label="Keranjang">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 8h14l-1.2 11a2 2 0 0 1-2 1.8H8.2a2 2 0 0 1-2-1.8L5 8Z"/>
                    <path d="M9 8V7a3 3 0 0 1 6 0v1"/>
                </svg>
                <span class="cart-link__badge" data-cart-count hidden>0</span>
            </a>
            <a class="btn btn--primary" href="{{ route('menu') }}">Pesan</a>
        </div>
    </div>
</header>
