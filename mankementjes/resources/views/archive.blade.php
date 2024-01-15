@php
    // select where status = 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', 'Opgelost')->get();
@endphp
<x-head title="Archief" />
<x-navbar />

<div class="container mt-5 pt-4">
    <h2>Opgeloste mankementjes</h2>
    <x-mankement-list :mankementjes="$mankementjes" />
</div>