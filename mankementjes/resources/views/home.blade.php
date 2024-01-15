@php
    $mankementjes = [
        [
            "park" => "Efteling",
            "location" => "Pardoes Promenade",
            "title" => "Kapotte lantaarnpaal",
            "date" => "12-10-2021",
            "comments" => 3,
            "id" => 1,
            "image" => "https://via.placeholder.com/300x200"
        ]
    ];

    $mankementjes = \App\Models\Mankementje::all();
@endphp
<x-head title="Home" />
<x-navbar />

<div class="container mt-5 pt-4">
    <h2>Alle mankementjes</h2>
    <x-mankement-list :mankementjes="$mankementjes" />
</div>