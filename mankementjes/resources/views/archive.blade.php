@php
    // select where status = 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', 'Opgelost')->orderBy('date', 'desc')->get();
@endphp
<x-head title="Archief" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-12 col-md-6">
            <h2>Opgeloste mankementjes</h2>
            <span class="text-muted fst-italic">Deze mankementjes zijn al opgelost.</span>
        </div>
        <div class="col-6 col-md-4">
            <x-park-filter />
        </div>
    </div>
    <div class="row">
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>

<x-footer />
