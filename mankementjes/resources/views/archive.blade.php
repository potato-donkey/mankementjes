@php
    // select where status = 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', 'Opgelost')->get();
@endphp
<x-head title="Archief" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-6">
            <h2>Opgeloste mankementjes</h2>
            <span class="text-muted fst-italic">Deze mankementjes zijn nog niet opgelost.</span>
        </div>
        <div class="col-4">
            <x-park-filter />
        </div>
    </div>
    <div class="row">
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>
