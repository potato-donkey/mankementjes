@php
    // Select mankementjes where park = $park
    $mankementjes = \App\Models\Mankementje::where('park', $park['identifier'])->get();
@endphp
<x-head title="{{ $park['name'] }}" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-2">
            <img src="/assets/logos/{{ $park['identifier'] }}.jpg" class="img-fluid rounded" alt="Logo van park">
        </div>
        <div class="col-8">
            <h1>{{ $park['name'] }}</h1>
            <span class="text-muted fst-italic">{{ $park['city'] }}, {{ $park['country'] }}</span>
        </div>
        <div class="col-2">
            <a href="/mankement-melden?park={{ $park['identifier'] }}" class="btn btn-primary float-end"><i
                    class="bi bi-plus"></i>&nbsp;Melden</a>
        </div>
    </div>
    <div class="row mt-5">
        <h2>Lopende mankementjes in {{ $park['name'] }}</h2>
        <span class="text-muted fst-italic">Deze mankementjes zijn nog niet opgelost.</span>
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>
