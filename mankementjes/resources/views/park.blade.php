@php
    // Select mankementjes where park = $park
    $mankementjes = \App\Models\Mankementje::where('park', $park['identifier'])->get();

    // get locations where location is not Algemeen and park = $park
    $locations = \App\Models\Location::where('park', $park['identifier'])
        ->where('location', '!=', 'Algemeen')
        ->get();
@endphp
<x-head title="{{ $park['name'] }}" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-2">
            <img src="/assets/logos/{{ $park['identifier'] }}.jpg" class="img-fluid rounded" alt="Logo van park">
        </div>
        <div class="col-4">
            <h1>{{ $park['name'] }}</h1>
            <span class="text-muted fst-italic">{{ $park['city'] }}, {{ $park['country'] }}</span>
        </div>
        <div class="col-6">
            <div id="map">

            </div>
        </div>
    </div>
    <div class="row mt-5">
        <h2>Lopende mankementjes in {{ $park['name'] }}</h2>
        <span class="text-muted fst-italic">Deze mankementjes zijn nog niet opgelost.</span>
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>

<script>
    const map = L.map('map').setView([{{ $park['latitude'] }}, {{ $park['longitude'] }}], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    const locations = [
        @foreach ($locations as $location)
            {
                name: "{{ $location['location'] }}",
                coords: [{{ $location['latitude'] }}, {{ $location['longitude'] }}],
                description: "{{ $location['description'] }}"
            },
        @endforeach
    ];

    locations.forEach(location => {
        // Create marker with popup
        const marker = L.marker(location.coords).bindPopup(`<b>${location.name}</b><br>${location.description}`)
            .addTo(map);

    })
</script>

<x-footer />
