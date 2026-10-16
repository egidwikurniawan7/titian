@extends('layouts.app')

@section('title', 'Kue Custom — Titian')

@section('content')
    <section class="container page-head">
        <h1>Kue custom</h1>
        <p>Ulang tahun, hampers, atau hadiah. Ceritakan maumu.</p>
    </section>

    <div class="container custom">
        <aside class="custom__media" aria-hidden="true">
            <img src="{{ asset('images/cakes/custom.svg') }}" alt="" width="600" height="750">
        </aside>

        <form class="form card-form" id="custom-form" novalidate>
            <div class="field">
                <label for="c-name">Nama</label>
                <input id="c-name" name="name" type="text" autocomplete="name" aria-describedby="c-name-err">
                <p class="field__error" id="c-name-err"></p>
            </div>

            <div class="field">
                <label for="c-wa">Nomor WhatsApp</label>
                <input id="c-wa" name="wa" type="tel" inputmode="tel" autocomplete="tel" placeholder="0812 3456 7890" aria-describedby="c-wa-err">
                <p class="field__error" id="c-wa-err"></p>
            </div>

            <div class="form__row">
                <div class="field">
                    <label for="c-jenis">Jenis kue</label>
                    <select id="c-jenis" name="jenis" aria-describedby="c-jenis-err">
                        <option value="">Pilih jenis</option>
                        <option>Kue ulang tahun</option>
                        <option>Hampers</option>
                        <option>Kue hadiah</option>
                        <option>Lainnya</option>
                    </select>
                    <p class="field__error" id="c-jenis-err"></p>
                </div>

                <div class="field">
                    <label for="c-porsi">Porsi</label>
                    <select id="c-porsi" name="porsi" aria-describedby="c-porsi-err">
                        <option value="">Pilih porsi</option>
                        <option>6–8 orang</option>
                        <option>10–12 orang</option>
                        <option>15–20 orang</option>
                        <option>Lebih dari 20 orang</option>
                    </select>
                    <p class="field__error" id="c-porsi-err"></p>
                </div>
            </div>

            <div class="form__row">
                <div class="field">
                    <label for="c-rasa">Rasa</label>
                    <select id="c-rasa" name="rasa">
                        <option>Bantu saya memilih</option>
                        @foreach ($products as $product)
                            <option>{{ $product['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="c-date">Tanggal diambil / diantar</label>
                    <input id="c-date" name="date" type="date" aria-describedby="c-date-hint c-date-err">
                    <p class="hint" id="c-date-hint">Pesan minimal 2 hari sebelumnya.</p>
                    <p class="field__error" id="c-date-err"></p>
                </div>
            </div>

            <div class="field">
                <label for="c-tulisan">Tulisan di kue <span class="hint">(opsional)</span></label>
                <input id="c-tulisan" name="tulisan" type="text" maxlength="40" placeholder="Selamat ulang tahun, Dina!">
            </div>

            <fieldset class="pills">
                <legend>Penerimaan</legend>
                <label class="pill">
                    <input type="radio" name="delivery" value="ojol" checked>
                    <span class="pill__box"><strong>Diantar ojol</strong><span>Area Pontianak</span></span>
                </label>
                <label class="pill">
                    <input type="radio" name="delivery" value="ambil">
                    <span class="pill__box"><strong>Ambil di toko</strong><span>{{ config('titian.address') }}</span></span>
                </label>
            </fieldset>

            <div class="field" id="c-address-field">
                <label for="c-address">Alamat pengantaran</label>
                <textarea id="c-address" name="address" rows="2" aria-describedby="c-address-err"></textarea>
                <p class="field__error" id="c-address-err"></p>
            </div>

            <div class="field">
                <label for="c-note">Catatan <span class="hint">(opsional)</span></label>
                <textarea id="c-note" name="note" rows="2" placeholder="Tema warna, alergi, dll."></textarea>
            </div>

            <button type="submit" class="btn btn--primary btn--lg btn--block">Kirim ke WhatsApp</button>
            <p class="status" id="form-status" role="status" aria-live="polite" hidden></p>
        </form>
    </div>
@endsection
