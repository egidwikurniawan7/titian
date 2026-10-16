<footer class="footer">
    <div class="footer__wave" aria-hidden="true"></div>

    <svg class="footer__bridge" viewBox="0 0 800 300" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round" aria-hidden="true">
        <path d="M0 230H800"/>
        <path d="M40 230C120 20 680 20 760 230"/>
        <path d="M150 230V105M250 230V68M350 230V50M450 230V50M550 230V68M650 230V105" stroke-width="3"/>
        <path d="M0 262c40-14 80 14 120 0s80-14 120 0 80 14 120 0 80-14 120 0 80 14 120 0 80-14 120 0" stroke-width="3"/>
    </svg>

    <div class="container footer__grid">
        <div class="footer__col footer__brand">
            <x-logo variant="light" />
            <p class="footer__tagline">{{ config('titian.tagline') }}</p>
            <ul class="social">
                <li>
                    <a href="https://instagram.com/{{ config('titian.instagram') }}" target="_blank" rel="noopener" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg>
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/{{ config('titian.whatsapp') }}" target="_blank" rel="noopener" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" aria-hidden="true"><path d="M4 20l1.3-4.2A8 8 0 1 1 8.4 18.8L4 20Z"/><path d="M9 9.5c.4 2.3 2.200 4.100 4.500 4.500l1.200-1.200-1.800-1-.8.7c-.8-.3-1.600-1.100-1.900-1.900l.7-.8-1-1.800L9 9.500Z" fill="currentColor" stroke="none"/></svg>
                    </a>
                </li>
            </ul>
        </div>

        <nav class="footer__col" aria-label="Jelajahi">
            <h3>Jelajahi</h3>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('custom') }}">Kue Custom</a></li>
                <li><a href="{{ route('cart') }}">Keranjang</a></li>
            </ul>
        </nav>

        <div class="footer__col">
            <h3>Kunjungi kami</h3>
            <address>{{ config('titian.address') }}</address>
            <p>{{ config('titian.hours') }}</p>
            <p class="badge badge--dark"><span aria-hidden="true">🛵</span> Diantar ojol, area Pontianak</p>
        </div>

        <div class="footer__col">
            <h3>Pesan cepat</h3>
            <p class="footer__phone">{{ config('titian.whatsapp_display') }}</p>
            <a class="btn btn--light" href="https://wa.me/{{ config('titian.whatsapp') }}" target="_blank" rel="noopener">Chat sekarang</a>
        </div>
    </div>

    <div class="container footer__legal">
        <p>© {{ date('Y') }} Titian. Dibuat untuk tugas kuliah.</p>
        <p>{{ '@'.config('titian.instagram') }}</p>
    </div>

    <p class="footer__giant" aria-hidden="true">Titian</p>
</footer>
