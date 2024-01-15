@php
    // select where status is not 'Opgelost'
    $mankementjes = \App\Models\Mankementje::where('status', '!=', 'Opgelost')->get();
@endphp
<x-head title="Home" />
<x-navbar />

<div class="container mt-5 pt-4">
    <h2>Lopende mankementjes</h2>
    <x-mankement-list :mankementjes="$mankementjes" />
</div>