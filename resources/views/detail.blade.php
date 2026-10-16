@extends('layouts.app')

@section('title', $product['name'].' — Titian')

@section('content')
    @php
        $prices = ['slice' => $product['price'], 'utuh' => $product['whole']];
    @endphp

    <div class="container">
        <a class="back" href="{{ route('menu') }}">← Kembali ke menu</a>

        <article class="detail">
            {{-- Nama transisi sama dengan di kartu: foto "terbang" dari kartu ke sini (Smart Animate) --}}
            <div class="detail__media" style="view-transition-name: cake-{{ $product['slug'] }}">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" width="600" height="750">
            </div>

            <div class="detail__info">
                <h1>{{ $product['name'] }}</h1>
                <p class="detail__rasa">{{ $product['rasa'] }}</p>

                <ul class="tags" aria-label="Bahan utama">
                    @foreach ($product['tags'] as $tag)
                        <li class="tag">{{ $tag }}</li>
                    @endforeach
                </ul>

                <fieldset class="pills">
                    <legend>Pilih ukuran</legend>
                    <label class="pill">
                        <input type="radio" name="size" value="slice" data-price="{{ $product['price'] }}" checked>
                        <span class="pill__box"><strong>Slice</strong><span>Rp{{ number_format($product['price'], 0, ',', '.') }}</span></span>
                    </label>
                    <label class="pill">
                        <input type="radio" name="size" value="utuh" data-price="{{ $product['whole'] }}">
                        <span class="pill__box"><strong>Utuh · 8 potong</strong><span>Rp{{ number_format($product['whole'], 0, ',', '.') }}</span></span>
                    </label>
                </fieldset>

                <p class="detail__price" data-detail-price>Rp{{ number_format($product['price'], 0, ',', '.') }}</p>

                <div class="detail__actions">
                    <button type="button" class="btn btn--primary btn--lg"
                            data-add="detail"
                            data-label="Tambah ke keranjang"
                            data-id="{{ $product['slug'] }}"
                            data-name="{{ $product['name'] }}"
                            data-image="{{ asset($product['image']) }}"
                            data-prices="{{ json_encode($prices) }}">Tambah ke keranjang</button>
                    <a class="btn btn--ghost btn--lg" href="{{ route('cart') }}">Lihat keranjang</a>
                </div>
            </div>
        </article>
    </div>
@endsection
