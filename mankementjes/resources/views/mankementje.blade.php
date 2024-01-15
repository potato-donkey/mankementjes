<x-head title="{{ $mankementje['title'] }}" />
<x-navbar />

@php
    // Get user from model
    $user = \App\Models\User::where('id', $mankementje['user_id'])->first();
@endphp

<div class="container mt-5 pt-4">
    <div class="row mb-2">
        <div class="col">
            <span class="mankementje-park-locatie">{{ $mankementje['park'] }}</span><br>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <img class="img-fluid rounded mb-2" src="{{ $mankementje['image'] }}">
            <h2>{{ $mankementje['location'] }} - {{ $mankementje['title'] }}</h2>
            <span class="mankementje-datum">Gemeld op {{ $mankementje['date'] }} door
                {{ $user["name"] }} &centerdot; {{$mankementje["status"]}}</span>
            <p>
                {{ $mankementje['description'] }}
            </p>
        </div>
        <div class="col-12 col-md-6 ps-md-5">
            @unless( $mankementje["status"] == 'Opgelost' )
                <a class='btn btn-success'><i class='bi bi-check'></i>&nbsp;Dit is opgelost!</a>
                <a class='btn btn-danger'><i class='bi bi-exclamation-triangle-fill'></i>&nbsp;Rapporteer</a>
            @endunless
            
            @php
            // Get comments from model
            $comments = \App\Models\Comment::where('mankementje_id', $mankementje['id'])->get();
            @endphp

            <h2 class="mt-3">Reacties</h2>
            <x-comment-list :comments="$comments" />

            @unless ($mankementje["status"] == 'Opgelost')
                <h3 class="mt-3">Reageer</h3>
            @else
                <span class="mankementje-datum mt-3">Dit mankementje is opgelost. Reageren is niet meer mogelijk.</span>
            @endunless

        </div>
    </div>
</div>
