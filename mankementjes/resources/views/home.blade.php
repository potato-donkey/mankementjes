@php
    // select where status is not 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', '!=', 'Opgelost')->get();

    $parks = \App\Models\Park::all();
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
            <select class="form-select" id="filter" aria-label="Filter op park">
                <option value="none" selected>Filter op park</option>
                @foreach ($parks as $park)
                    <option value="{{ $park->id }}">{{ $park->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <a href="/mankement-melden" class="btn btn-primary float-end"><i class="bi bi-plus"></i>&nbsp;Melden</a>
        </div>
    </div>
    <div class="row">
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>
