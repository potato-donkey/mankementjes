@php
    // Select all mankementjes made by the current user
    $mankementjes = \App\Models\Mankementje::where('user_id', '=', Auth::user()->id)->get();
@endphp
<x-head title="Gebruiker" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <h2>Gegevens</h2>
        <span><b>Gebruikersnaam:</b> {{ Auth::user()->name }}</span><br>
        <span><b>E-mailadres:</b> {{ Auth::user()->email }}</span><br>
        <span><b>Lid sinds:</b>
            {{ \App\Http\Controllers\DateController::renderFullDate(Auth::user()->created_at) }}</span><br>
    </div>
    <div class="row mt-5">
        <h3>Mijn mankementjes</h3>
        <x-mankement-list :mankementjes="$mankementjes" />
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-3">
            <div class="btn-group" role="group">
                <a href="/me/logout" class="btn btn-danger">Uitloggen</a>
                <a href="/me/edit" class="btn btn-warning">Gegevens wijzigen</a>
            </div>
        </div>
    </div>

</div>

<x-footer />
