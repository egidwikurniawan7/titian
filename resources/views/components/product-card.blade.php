@props(['product'])

@php
    $p = $product;
    $prices = ['slice' => $p['price'], 'utuh' => $p['whole']];
@endphp

<article class="card" data-rasa="{{ implode(' ', $p['flavors']) }}">
    <a class="card__link" href="{{ route('menu.show', $p['slug']) }}">
        <div class="card__media" style="view-transition-name: cake-{{ $p['slug'] }}">
            <img src="{{ asset($p['image']) }}" alt="{{ $p['name'] }}" width="600" height="750" decoding="async">
        </div>
        <div class="card__body">
            <h3 class="card__name">{{ $p['name'] }}</h3>
            <p class="card__rasa">{{ $p['rasa'] }}</p>
            <p class="card__price">Rp{{ number_format($p['price'], 0, ',', '.') }}</p>
        </div>
    </a>
    <button type="button" class="card__add"
            data-add="card"
            data-id="{{ $p['slug'] }}"
            data-name="{{ $p['name'] }}"
            data-image="{{ asset($p['image']) }}"
            data-prices="{{ json_encode($prices) }}"
            aria-label="Tambah {{ $p['name'] }} ke keranjang">+</button>
</article>
