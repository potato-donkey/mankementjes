@php
    // select where status is not 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', '!=', 'Opgelost')->orderBy('date', 'desc')->get();
@endphp
<x-head title="Home" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-12 col-md-6">
            <h2>Lopende mankementjes</h2>
            <span class="text-muted fst-italic">Deze mankementjes zijn nog niet opgelost.</span>
        </div>
        @auth
        <div class="col-8 col-md-4">
            <x-park-filter />
        </div>

            <div class="col-4 col-md-2">
                <a href="/melden" class="btn btn-primary float-end"><i class="bi bi-plus"></i>&nbsp;Melden</a>
            </div>
        @endauth

        @guest
            <div class="col-12 col-md-6">
            <x-park-filter />
        </div>
        @endguest
    </div>
    <div class="row">
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>

<x-footer />
