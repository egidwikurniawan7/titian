@extends('layouts.app')

@section('title', 'Titian — Cake & kue, diantar ojol di Pontianak')

@section('content')
    {{-- HERO: slider layar penuh, 5 menu andalan. Foto, teks, warna latar, dan hiasan berganti bersama. --}}
    @php
        $total = $featured->count();
        $firstBg = $featured->first()['hero']['bg'] ?? '#F9C9A0';
    @endphp
    <section class="hero" id="hero" data-dir="next" style="--hero-bg: {{ $firstBg }}"
             aria-roledescription="carousel" aria-label="Menu andalan Titian">
        <div class="container hero__inner">
            <div class="hero__top">
                <h1 class="hero__kicker">Kue lembut, hari jadi lebih manis.</h1>
                <p class="badge"><span aria-hidden="true">🛵</span> Diantar ojol, area Pontianak</p>
            </div>

            <div class="hero__slides" id="hero-slides" aria-live="off">
                @foreach ($featured as $i => $product)
                    @php
                        $hero = $product['hero'] ?? [];
                        $prices = ['slice' => $product['price'], 'utuh' => $product['whole']];
                    @endphp
                    <article class="slide{{ $i === 0 ? ' is-active' : '' }}"
                             data-bg="{{ $hero['bg'] ?? '#F9C9A0' }}"
                             style="--vt: cake-{{ $product['slug'] }}"
                             role="group" aria-roledescription="slide" aria-label="{{ $i + 1 }} dari {{ $total }}"
                             @if ($i !== 0) inert @endif>
                        <div class="slide__copy">
                            <p class="eyebrow">Menu andalan · {{ sprintf('%02d', $i + 1) }} / {{ sprintf('%02d', $total) }}</p>
                            <h2 class="slide__name">{{ $product['name'] }}</h2>
                            <p class="slide__rasa">{{ $product['rasa'] }}</p>
                            <p class="slide__price">Rp{{ number_format($product['price'], 0, ',', '.') }} <small>/ slice</small></p>

                            <div class="slide__actions">
                                <a class="btn btn--primary btn--lg" href="{{ route('menu.show', $product['slug']) }}">Lihat detail <span aria-hidden="true">→</span></a>
                                <button type="button" class="hero-add"
                                        data-add="card"
                                        data-id="{{ $product['slug'] }}"
                                        data-name="{{ $product['name'] }}"
                                        data-image="{{ asset($product['image']) }}"
                                        data-prices="{{ json_encode($prices) }}"
                                        aria-label="Tambah {{ $product['name'] }} ke keranjang">+</button>
                            </div>
                        </div>

                        <div class="stage">
                            <div class="stage__plate" aria-hidden="true"></div>
                            <div class="slide__cake">
                                <img src="{{ asset($product['hero_image'] ?? $product['image']) }}" alt="{{ $product['name'] }}" width="480" height="410" decoding="async">
                            </div>
                            @foreach ($hero['decor'] ?? [] as $d)
                                <span class="decor" aria-hidden="true"
                                      style="--x: {{ $d['x'] }}%; --y: {{ $d['y'] }}%; --w: {{ $d['w'] }}%; --r: {{ $d['r'] }}deg; --k: {{ $d['k'] }}; --d: {{ 140 + $loop->index * 70 }}ms">
                                    <img src="{{ asset('images/decor/'.$d['img'].'.svg') }}" alt="" width="100" height="100">
                                </span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="hero__controls">
                <div class="ctl-group">
                    <button type="button" class="ctl" data-hero="prev" aria-label="Kue sebelumnya">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 5l-7 7 7 7"/></svg>
                    </button>
                    <button type="button" class="ctl" data-hero="next" aria-label="Kue berikutnya">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>
                    </button>
                    <button type="button" class="ctl ctl--toggle" data-hero="toggle" aria-label="Jeda pergantian otomatis">
                        <svg class="i-pause" viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><rect x="6" y="5" width="4" height="14" rx="1.2"/><rect x="14" y="5" width="4" height="14" rx="1.2"/></svg>
                        <svg class="i-play" viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M8 5.5v13a1 1 0 0 0 1.5.86l10.5-6.5a1 1 0 0 0 0-1.72L9.5 4.64A1 1 0 0 0 8 5.5Z"/></svg>
                    </button>
                </div>

                <ul class="thumbs" aria-label="Pilih menu andalan">
                    @foreach ($featured as $i => $product)
                        <li>
                            <button type="button" class="thumb{{ $i === 0 ? ' is-active' : '' }}" data-hero-go="{{ $i }}"
                                    aria-label="{{ $product['name'] }}" @if ($i === 0) aria-current="true" @endif>
                                <img src="{{ asset($product['image']) }}" alt="" width="48" height="48">
                                <span class="thumb__name">{{ $product['name'] }}</span>
                                <span class="thumb__bar" aria-hidden="true"></span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="wave" aria-hidden="true"></div>
    </section>

    {{-- CARI RASAMU --}}
    <section class="section">
        <div class="container">
            <div class="section__head">
                <h2>Cari rasamu</h2>
                <a class="link" href="{{ route('menu') }}">Semua menu →</a>
            </div>

            <ul class="chips">
                @foreach ($flavors as $key => $flavor)
                    <li>
                        <a class="chip" href="{{ route('menu', ['rasa' => $key]) }}">
                            <span class="chip__icon" aria-hidden="true">{{ $flavor['icon'] }}</span>
                            <span>
                                <span class="chip__label">{{ $flavor['label'] }}</span>
                                <span class="chip__desc">{{ $flavor['desc'] }}</span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- BANNER KUE CUSTOM --}}
    <section class="section section--tight">
        <div class="container">
            <div class="banner">
                <div class="banner__text">
                    <h2>Mau kue sesuai maumu?</h2>
                    <p>Ulang tahun, hampers, atau hadiah.</p>
                    <a class="btn btn--primary btn--lg" href="{{ route('custom') }}">Pesan kue custom <span aria-hidden="true">→</span></a>
                </div>
                <div class="banner__media">
                    <img src="{{ asset('images/cakes/custom.svg') }}" alt="Kue ulang tahun dengan lilin" width="600" height="750" loading="lazy">
                </div>
            </div>
        </div>
    </section>
@endsection
