/* =========================================================
   Titian — keranjang, filter menu, validasi form, kirim ke WhatsApp
   ========================================================= */
(() => {
    'use strict';

    const KEY = 'titian_cart';
    const WA = document.body.dataset.wa || '';
    const SIZE = { slice: 'Slice', utuh: 'Utuh · 8 potong' };

    const $ = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
    const rupiah = (n) => 'Rp' + new Intl.NumberFormat('id-ID').format(n);
    const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    /* ---------- Penyimpanan keranjang ---------- */
    function readCart() {
        try {
            const data = JSON.parse(localStorage.getItem(KEY));
            if (!Array.isArray(data)) return [];
            return data.filter((i) => i && Number.isFinite(i.price) && Number.isInteger(i.qty) && i.qty > 0);
        } catch {
            return [];
        }
    }

    function writeCart(cart) {
        try { localStorage.setItem(KEY, JSON.stringify(cart)); } catch { /* abaikan */ }
        updateBadge();
    }

    const totalOf = (cart) => cart.reduce((sum, i) => sum + i.price * i.qty, 0);

    function updateBadge() {
        const count = readCart().reduce((sum, i) => sum + i.qty, 0);
        $$('[data-cart-count]').forEach((el) => {
            el.textContent = count;
            el.hidden = count === 0;
        });
    }

    /* ---------- Feedback: toast ---------- */
    const toastEl = $('#toast');
    let toastTimer;
    function toast(message) {
        if (!toastEl) return;
        toastEl.textContent = message;
        toastEl.classList.add('is-show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toastEl.classList.remove('is-show'), 2200);
    }

    /* ---------- Tambah ke keranjang ---------- */
    function addItem(item) {
        const cart = readCart();
        const found = cart.find((i) => i.id === item.id && i.size === item.size);
        if (found) found.qty += 1;
        else cart.push({ ...item, qty: 1 });
        writeCart(cart);
        toast(`${item.name} ditambahkan ✓`);
    }

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-add]');
        if (!btn) return;

        let prices;
        try { prices = JSON.parse(btn.dataset.prices); } catch { return; }

        let size = 'slice';
        if (btn.dataset.add === 'detail') {
            const checked = $('input[name="size"]:checked');
            if (checked) size = checked.value;
        }

        addItem({ id: btn.dataset.id, name: btn.dataset.name, image: btn.dataset.image, size, price: prices[size] });

        // Feedback pada tombol itu sendiri
        const original = btn.dataset.add === 'detail' ? btn.dataset.label : '+';
        btn.classList.add('is-done');
        btn.textContent = btn.dataset.add === 'detail' ? 'Ditambahkan ✓' : '✓';
        setTimeout(() => {
            btn.classList.remove('is-done');
            btn.textContent = original;
        }, 1200);
    });

    /* ---------- Detail: harga mengikuti ukuran ---------- */
    const priceEl = $('[data-detail-price]');
    if (priceEl) {
        $$('input[name="size"]').forEach((radio) => {
            radio.addEventListener('change', () => { priceEl.textContent = rupiah(Number(radio.dataset.price)); });
        });
    }

    /* ---------- Menu: filter rasa ---------- */
    const filters = $$('[data-filter]');
    if (filters.length) {
        const cards = $$('.menu-grid [data-rasa]');
        const status = $('#filter-status');

        const apply = (key) => {
            filters.forEach((f) => f.setAttribute('aria-pressed', String(f.dataset.filter === key)));
            let shown = 0;
            cards.forEach((card) => {
                const match = key === 'semua' || card.dataset.rasa.split(' ').includes(key);
                card.hidden = !match;
                if (match) shown += 1;
            });
            if (status) status.textContent = `Menampilkan ${shown} kue`;

            const url = new URL(window.location.href);
            if (key === 'semua') url.searchParams.delete('rasa');
            else url.searchParams.set('rasa', key);
            history.replaceState(null, '', url);
        };

        filters.forEach((f) => f.addEventListener('click', () => apply(f.dataset.filter)));
        const initial = new URLSearchParams(window.location.search).get('rasa');
        apply(filters.some((f) => f.dataset.filter === initial) ? initial : 'semua');
    }

    /* ---------- Validasi form ---------- */
    function setError(el, message) {
        const wrap = el.closest('.field');
        if (!wrap) return;
        const err = $('.field__error', wrap);
        if (err) err.textContent = message ? `⚠ ${message}` : '';
        wrap.classList.toggle('has-error', Boolean(message));
        el.setAttribute('aria-invalid', message ? 'true' : 'false');
    }

    function validate(form, rules) {
        let firstBad = null;
        Object.entries(rules).forEach(([name, rule]) => {
            const el = form.elements[name];
            if (!el) return;
            const message = rule(el.value.trim(), form) || '';
            setError(el, message);
            if (message && !firstBad) firstBad = el;
        });
        if (firstBad) firstBad.focus();
        return !firstBad;
    }

    function liveValidate(form, rules) {
        Object.keys(rules).forEach((name) => {
            const el = form.elements[name];
            if (!el) return;
            const check = () => setError(el, rules[name](el.value.trim(), form) || '');
            el.addEventListener('blur', check);
            el.addEventListener('input', () => { if (el.closest('.field').classList.contains('has-error')) check(); });
        });
    }

    const rules = {
        name: (v) => (v.length < 2 ? 'Isi nama kamu dulu ya.' : ''),
        wa: (v) => (/^(\+62|62|0)8\d{7,11}$/.test(v.replace(/[\s-]/g, '')) ? '' : 'Nomor WhatsApp belum benar. Contoh: 0812 3456 7890.'),
        address: (v) => (v.length < 10 ? 'Tulis alamat selengkap mungkin supaya ojol mudah menemukan.' : ''),
    };

    function openWhatsApp(text) {
        const url = `https://wa.me/${WA}?text=${encodeURIComponent(text)}`;
        const win = window.open(url, '_blank');
        if (win) win.opener = null;
        else window.location.href = url;
    }

    function showStatus(form, message) {
        const box = $('#form-status', form);
        if (!box) return;
        box.textContent = message;
        box.hidden = false;
    }

    function busy(button, text) {
        const label = button.textContent;
        button.disabled = true;
        button.textContent = text;
        setTimeout(() => { button.disabled = false; button.textContent = label; }, 2000);
    }

    /* ---------- Halaman keranjang ---------- */
    const cartGrid = $('#cart-grid');
    if (cartGrid) {
        const list = $('#cart-list');
        const empty = $('#cart-empty');
        const totalEl = $('#cart-total');
        const form = $('#checkout-form');

        const render = () => {
            const cart = readCart();
            empty.hidden = cart.length > 0;
            cartGrid.hidden = cart.length === 0;
            totalEl.textContent = rupiah(totalOf(cart));
            list.innerHTML = cart.map((i, idx) => `
                <li class="cart-item">
                    <img src="${esc(i.image)}" alt="" width="96" height="96">
                    <div class="cart-item__info">
                        <h3>${esc(i.name)}</h3>
                        <p>${esc(SIZE[i.size] || i.size)} · ${rupiah(i.price)}</p>
                        <button type="button" class="cart-item__remove" data-action="remove" data-index="${idx}">Hapus</button>
                    </div>
                    <div class="cart-item__side">
                        <div class="qty" role="group" aria-label="Jumlah ${esc(i.name)}">
                            <button type="button" data-action="dec" data-index="${idx}" aria-label="Kurangi jumlah">−</button>
                            <output>${i.qty}</output>
                            <button type="button" data-action="inc" data-index="${idx}" aria-label="Tambah jumlah">+</button>
                        </div>
                        <strong>${rupiah(i.price * i.qty)}</strong>
                    </div>
                </li>`).join('');
        };

        list.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-action]');
            if (!btn) return;
            const cart = readCart();
            const idx = Number(btn.dataset.index);
            const item = cart[idx];
            if (!item) return;

            if (btn.dataset.action === 'inc') item.qty += 1;
            if (btn.dataset.action === 'dec') item.qty -= 1;
            if (btn.dataset.action === 'remove' || item.qty < 1) cart.splice(idx, 1);

            writeCart(cart);
            render();
        });

        liveValidate(form, rules);
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const cart = readCart();
            if (cart.length === 0) return;
            if (!validate(form, rules)) return;

            const f = form.elements;
            const lines = cart.map((i, n) => `${n + 1}. ${i.name} (${SIZE[i.size] || i.size}) x${i.qty} — ${rupiah(i.price * i.qty)}`);
            const text = [
                'Halo Titian, saya mau pesan:',
                '',
                ...lines,
                '',
                `Total: ${rupiah(totalOf(cart))} (belum termasuk ongkir ojol)`,
                '',
                `Nama: ${f.name.value.trim()}`,
                `No. WhatsApp: ${f.wa.value.trim()}`,
                `Alamat: ${f.address.value.trim()}`,
                `Pembayaran: ${f.payment.value}`,
                f.note.value.trim() ? `Catatan: ${f.note.value.trim()}` : null,
            ].filter((line) => line !== null).join('\n');

            busy($('button[type="submit"]', form), 'Membuka WhatsApp…');
            openWhatsApp(text);
            showStatus(form, 'Pesanan sudah disiapkan di WhatsApp. Tinggal tekan kirim ya ✓');
        });

        render();
    }

    /* ---------- Halaman kue custom ---------- */
    const customForm = $('#custom-form');
    if (customForm) {
        const toISO = (d) => `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
        const min = new Date();
        min.setDate(min.getDate() + 2);
        const minISO = toISO(min);
        customForm.elements.date.min = minISO;

        const addressField = $('#c-address-field');
        const syncDelivery = () => { addressField.hidden = customForm.elements.delivery.value === 'ambil'; };
        $$('input[name="delivery"]', customForm).forEach((r) => r.addEventListener('change', syncDelivery));
        syncDelivery();

        const customRules = {
            name: rules.name,
            wa: rules.wa,
            jenis: (v) => (v ? '' : 'Pilih jenis kue dulu.'),
            porsi: (v) => (v ? '' : 'Pilih porsi yang kamu butuhkan.'),
            date: (v) => {
                if (!v) return 'Pilih tanggal.';
                if (v < minISO) return 'Kue custom perlu dipesan minimal 2 hari sebelumnya.';
                return '';
            },
            address: (v, form) => (form.elements.delivery.value === 'ambil' ? '' : rules.address(v)),
        };

        liveValidate(customForm, customRules);
        customForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (!validate(customForm, customRules)) return;

            const f = customForm.elements;
            const date = new Date(`${f.date.value}T00:00`).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            const ojol = f.delivery.value === 'ojol';
            const text = [
                'Halo Titian, saya mau pesan kue custom:',
                '',
                `Jenis: ${f.jenis.value}`,
                `Porsi: ${f.porsi.value}`,
                `Rasa: ${f.rasa.value}`,
                `Tanggal: ${date}`,
                f.tulisan.value.trim() ? `Tulisan di kue: ${f.tulisan.value.trim()}` : null,
                `Penerimaan: ${ojol ? 'Diantar ojol' : 'Ambil di toko'}`,
                ojol ? `Alamat: ${f.address.value.trim()}` : null,
                f.note.value.trim() ? `Catatan: ${f.note.value.trim()}` : null,
                '',
                `Nama: ${f.name.value.trim()}`,
                `No. WhatsApp: ${f.wa.value.trim()}`,
            ].filter((line) => line !== null).join('\n');

            busy($('button[type="submit"]', customForm), 'Membuka WhatsApp…');
            openWhatsApp(text);
            showStatus(customForm, 'Pesanan sudah disiapkan di WhatsApp. Tinggal tekan kirim ya ✓');
        });
    }

    /* ---------- Hero: slider menu andalan ---------- */
    const hero = $('#hero');
    if (hero && $$('.slide', hero).length > 1) {
        const slides = $$('.slide', hero);
        const thumbs = $$('[data-hero-go]', hero);
        const box = $('#hero-slides', hero);
        const toggleBtn = $('[data-hero="toggle"]', hero);

        const DURATION = 5500;   // lama tiap slide (ms), juga dipakai CSS untuk progress bar
        const LEAVE_MS = 1000;   // lama slide lama dipertahankan agar animasi keluarnya selesai
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        let current = 0;
        let userPaused = reduceMotion;   // gerak dikurangi: hanya manual
        let hovering = false;
        let focusing = false;
        const leaveTimers = new Map();

        hero.style.setProperty('--hero-dur', `${DURATION}ms`);

        function sync() {
            const paused = userPaused || hovering || focusing || document.hidden;
            hero.classList.toggle('is-paused', paused);
            hero.classList.toggle('is-user-paused', userPaused);
            box.setAttribute('aria-live', userPaused ? 'polite' : 'off');
            if (toggleBtn) toggleBtn.setAttribute('aria-label', userPaused ? 'Putar pergantian otomatis' : 'Jeda pergantian otomatis');
        }

        function go(target, dir) {
            const to = (target + slides.length) % slides.length;
            if (to === current) return;

            const from = slides[current];
            const next = slides[to];
            hero.dataset.dir = dir || (to > current ? 'next' : 'prev');

            // 1. letakkan slide tujuan di posisi awal (sesuai arah) tanpa animasi
            clearTimeout(leaveTimers.get(next));
            next.classList.remove('is-leaving');
            next.classList.add('is-prep');
            void next.offsetWidth;
            next.classList.remove('is-prep');

            // 2. slide lama keluar, slide baru masuk, warna latar ikut berganti
            from.classList.remove('is-active');
            from.classList.add('is-leaving');
            from.inert = true;
            leaveTimers.set(from, setTimeout(() => from.classList.remove('is-leaving'), LEAVE_MS));

            next.classList.add('is-active');
            next.inert = false;
            hero.style.setProperty('--hero-bg', next.dataset.bg);

            thumbs.forEach((thumb, i) => {
                thumb.classList.toggle('is-active', i === to);
                if (i === to) thumb.setAttribute('aria-current', 'true');
                else thumb.removeAttribute('aria-current');
            });

            current = to;
        }

        // Otomatis: progress bar thumbnail selesai = pindah ke kue berikutnya.
        // Saat di-pause, animasi bar ikut berhenti, jadi timer-nya ikut berhenti.
        hero.addEventListener('animationend', (e) => {
            if (e.animationName === 'hero-fill' && !userPaused) go(current + 1, 'next');
        });

        hero.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-hero], [data-hero-go]');
            if (!btn || !hero.contains(btn)) return;

            if (btn.dataset.heroGo !== undefined) go(Number(btn.dataset.heroGo));
            else if (btn.dataset.hero === 'next') go(current + 1, 'next');
            else if (btn.dataset.hero === 'prev') go(current - 1, 'prev');
            else if (btn.dataset.hero === 'toggle') { userPaused = !userPaused; sync(); }
        });

        hero.addEventListener('keydown', (e) => {
            if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return;
            if (e.key === 'ArrowRight') { go(current + 1, 'next'); e.preventDefault(); }
            if (e.key === 'ArrowLeft') { go(current - 1, 'prev'); e.preventDefault(); }
        });

        // Berhenti sementara saat kursor di atas hero atau fokus keyboard ada di dalamnya
        hero.addEventListener('pointerenter', (e) => { if (e.pointerType === 'mouse') { hovering = true; sync(); } });
        hero.addEventListener('pointerleave', () => { hovering = false; sync(); });
        hero.addEventListener('focusin', (e) => { focusing = e.target.matches(':focus-visible'); sync(); });
        hero.addEventListener('focusout', () => { focusing = false; sync(); });
        document.addEventListener('visibilitychange', sync);

        // Geser (swipe) di layar sentuh
        let startX = 0;
        let startY = 0;
        box.addEventListener('pointerdown', (e) => { startX = e.clientX; startY = e.clientY; });
        box.addEventListener('pointerup', (e) => {
            const dx = e.clientX - startX;
            const dy = e.clientY - startY;
            if (Math.abs(dx) > 60 && Math.abs(dx) > Math.abs(dy) * 1.5) {
                if (dx < 0) go(current + 1, 'next');
                else go(current - 1, 'prev');
            }
        });

        sync();
    }

    updateBadge();
    window.addEventListener('pageshow', updateBadge);
})();
