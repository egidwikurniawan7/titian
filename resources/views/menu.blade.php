@extends('layouts.app')

@section('title', 'Menu — Titian')

@section('content')
    <section class="container page-head">
        <h1>Menu</h1>
        <p>Pilih kue favoritmu.</p>

        <div class="filters" role="group" aria-label="Filter rasa">
            <button type="button" class="filter" data-filter="semua" aria-pressed="true">Semua</button>
            @foreach ($flavors as $key => $flavor)
                <button type="button" class="filter" data-filter="{{ $key }}" aria-pressed="false">{{ $flavor['label'] }}</button>
            @endforeach
        </div>
        <p class="note" id="filter-status" role="status" aria-live="polite"></p>
    </section>

    <section class="container menu-grid" aria-label="Daftar kue">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </section>
@endsection
