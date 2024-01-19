@php
    // select where status is not 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', '!=', 'Opgelost')->get();
@endphp
<x-head title="Home" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-6">
            <h2>Lopende mankementjes</h2>
            <span class="text-muted fst-italic">Deze mankementjes zijn nog niet opgelost.</span>
        </div>
        <div class="col-4">
            <x-park-filter />
        </div>
        <div class="col-2">
            <a href="/mankement-melden" class="btn btn-primary float-end"><i class="bi bi-plus"></i>&nbsp;Melden</a>
        </div>
    </div>
    <div class="row">
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>

<x-footer />
