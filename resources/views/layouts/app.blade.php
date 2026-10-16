<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Titian — Cake & kue')</title>
    <meta name="description" content="Cake dan kue lembut, dipanggang segar setiap hari. Diantar ojol di area Pontianak.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/titian.css') }}">
</head>
<body data-wa="{{ config('titian.whatsapp') }}">
    <a class="skip-link" href="#konten">Lewati ke konten</a>

    @include('partials.navbar')

    <main id="konten">
        @yield('content')
    </main>

    @include('partials.footer')

    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <script src="{{ asset('js/titian.js') }}" defer></script>
</body>
</html>
