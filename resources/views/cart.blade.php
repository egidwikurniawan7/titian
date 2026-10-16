@extends('layouts.app')

@section('title', 'Keranjang — Titian')

@section('content')
    <section class="container page-head">
        <h1>Keranjang</h1>
        <ol class="steps" aria-label="Langkah pemesanan">
            <li>Cek pesanan</li>
            <li>Isi data</li>
            <li>Kirim ke WhatsApp</li>
        </ol>
    </section>

    <div class="container cart">
        <div class="cart__empty" id="cart-empty" hidden>
            <h2>Keranjangmu masih kosong</h2>
            <p>Pilih kue dulu, yuk.</p>
            <a class="btn btn--primary btn--lg" href="{{ route('menu') }}">Lihat menu</a>
        </div>

        <div class="cart__grid" id="cart-grid" hidden>
            <section aria-labelledby="h-items">
                <h2 id="h-items" class="sr-only">Pesananmu</h2>
                <ul class="cart-list" id="cart-list"></ul>
            </section>

            <aside class="checkout">
                <form class="form" id="checkout-form" novalidate>
                    <h2>Data pemesan</h2>

                    <div class="field">
                        <label for="k-name">Nama</label>
                        <input id="k-name" name="name" type="text" autocomplete="name" aria-describedby="k-name-err">
                        <p class="field__error" id="k-name-err"></p>
                    </div>

                    <div class="field">
                        <label for="k-wa">Nomor WhatsApp</label>
                        <input id="k-wa" name="wa" type="tel" inputmode="tel" autocomplete="tel" placeholder="0812 3456 7890" aria-describedby="k-wa-err">
                        <p class="field__error" id="k-wa-err"></p>
                    </div>

                    <div class="field">
                        <label for="k-address">Alamat pengantaran (ojol)</label>
                        <textarea id="k-address" name="address" rows="2" autocomplete="street-address" aria-describedby="k-address-err"></textarea>
                        <p class="field__error" id="k-address-err"></p>
                    </div>

                    <fieldset class="pills">
                        <legend>Pembayaran</legend>
                        <label class="pill">
                            <input type="radio" name="payment" value="Transfer" checked>
                            <span class="pill__box"><strong>Transfer</strong></span>
                        </label>
                        <label class="pill">
                            <input type="radio" name="payment" value="Bayar di tempat (COD)">
                            <span class="pill__box"><strong>COD</strong></span>
                        </label>
                    </fieldset>

                    <div class="field">
                        <label for="k-note">Catatan <span class="hint">(opsional)</span></label>
                        <input id="k-note" name="note" type="text">
                    </div>

                    <div class="total">
                        <span>Total</span>
                        <span id="cart-total">Rp0</span>
                    </div>
                    <p class="note">Ongkir ojol dibayar sesuai tarif saat pengantaran.</p>

                    <button type="submit" class="btn btn--primary btn--lg btn--block">Kirim ke WhatsApp</button>
                    <p class="status" id="form-status" role="status" aria-live="polite" hidden></p>
                </form>
            </aside>
        </div>
    </div>
@endsection
