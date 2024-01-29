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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/parkFilter.js') }}" defer></script>
</head>
