<head>
    @php
        setlocale(LC_TIME, ['nl_NL.UTF-8', 'nl_NL@euro', 'nl_NL', 'dutch']);
    @endphp

    <meta charset="UTF-8">
    <title>{{ $title }} - Mankementjes</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colours.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/parkFilter.js') }}" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    {{-- TODO: Find out why bootstrap doesn't do this --}}
    <script src="{{ asset('js/navbar-button.js') }}" defer></script>
</head>
