@php
    // select where status = 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', 'Opgelost')->get();

    $parks = \App\Models\Park::all();
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
            <select class="form-select" id="parkFilter" aria-label="Filter op park">
                <option value="none" selected>Alle parken</option>
                @foreach ($parks as $park)
                    <option value="{{ $park->identifier }}">{{ $park->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
</div>
