<x-head title="{{ $mankementje['title'] }}" />
<x-navbar />

@php
    use League\CommonMark\CommonMarkConverter;

    $markdownConfig = [
        'html_input' => 'strip',
        'commonmark' => [
            'enable_strong' => false,
            'use_asterisk' => false,
        ],
    ];

    // Get user from model
    $user = \App\Models\User::where('id', $mankementje['user_id'])->first();

    // Get park from model
    $park = \App\Models\Park::where('identifier', $mankementje['park'])->first();

    // Get status from model
    $status = \App\Models\Status::where('status', $mankementje['status'])->first();

    // Get location from model
    $location = \App\Models\Location::where('id', $mankementje['location'])->first();
@endphp

<div class="container mt-5 pt-4">
    <div class="row mb-2">
        <div class="col">

            @if ($park)
                <a class="mankementje-park-locatie" href="/park/{{ $park['identifier'] }}"
                    title="Ga naar {{ $park['name'] }}">
                    {{ $park['name'] }}
                </a>
            @else
                <span class="mankementje-park-locatie">
                    {{ 'Onbekend' }}
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8">
            <img class="img of-c op-c w-100 mh-60 rounded mb-2 bg-black" src="{{ $mankementje['image'] }}">
            <h2>{{ $mankementje['location'] }} - {{ $mankementje['title'] }}</h2>
            <span class="mankementje-datum">Gemeld op {{ $mankementje['date'] }} door
                @if ($user)
                    {{ $user['name'] }}
                @else
                    onbekend
                @endif &centerdot; {{ $mankementje['status'] }}
            </span>
            <p>
                {{ $mankementje['description'] }}
            </p>
        </div>
        <div class="col-12 col-md-4 ps-md-5">
            @unless ($mankementje['status'] == 'Opgelost')
                <a class='btn btn-success'><i class='bi bi-check'></i>&nbsp;Dit is opgelost!</a>
                <a class='btn btn-danger'
                    href="mailto:report@mankementjes.nl?subject=Report%3A%20mankementje%20%23{{ $mankementje['id'] }}"><i
                        class='bi bi-exclamation-triangle-fill'></i>&nbsp;Rapporteer</a>
            @endunless

            @php
                // Get comments from model
                $comments = \App\Models\Comment::where('mankementje_id', $mankementje['id'])->get();
            @endphp

            <h2 class="mt-3">Reacties</h2>
            <x-comment-list :comments="$comments" />

            @unless ($mankementje['status'] == 'Opgelost')
                <h3 class="mt-3">Reageer</h3>
                <form action="/mankementje/{{ $mankementje['id'] }}/comment" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control" id="comment" name="comment" placeholder="Reactie" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Verstuur</button>
                @else
                    <span class="mankementje-datum mt-3">Dit mankementje is opgelost. Reageren is niet meer mogelijk.</span>
                @endunless

                @guest
                    <span class="mt-3"><a href="/me/login">Log in</a> om te reageren.</span>
                @endguest
        </div>
    </div>
</div>

<x-footer />
