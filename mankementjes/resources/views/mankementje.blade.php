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
            <img class="img w-100 of-c op-c mh-40 bg-primary rounded mb-2" src="{{ $mankementje['image'] }}">
            <h2>
                @if ($location)
                    {{ $location['location'] }}
                @else
                    {{ 'Algemeen' }}
                @endif - {{ $mankementje['title'] }}
            </h2>
            <span class="mankementje-datum">Gemeld op
                {{ \App\Http\Controllers\DateController::renderFullDate($mankementje['date']) }} door
                @if ($user)
                    {{ $user['name'] }}
                @else
                    {{ '(onbekend)' }}
                @endif &centerdot;

                @php
                    $statusText = $mankementje['status'];
                    $statusText = strtolower($statusText);

                    $colour = '';

                    switch ($statusText) {
                        case 'open':
                            $colour = 'red';
                            break;
                        case 'opgelost':
                            $colour = 'green';
                            break;
                        default:
                            $colour = 'orange';
                            break;
                    }
                @endphp
                <span class="mankementje-status {{ $colour }}"
                    title="{{ $status['description'] }}">{{ $status['status'] }}</span>
                @if ($status['status'] == 'Opgelost' && !empty($mankementje['solve_date']))
                    op {{ \App\Http\Controllers\DateController::renderFullDate($mankementje['solve_date']) }}
                @endif
            </span>
            {!! str_replace(
                "\n",
                '<br />',
                (new CommonMarkConverter($markdownConfig))->convert($mankementje['description'])->getContent(),
            ) !!}
        </div>
        <div class="col-12 col-md-4 ps-md-5">
            @unless ($mankementje['status'] == 'Opgelost')
                @auth
                    @if ($mankementje['user_id'] == Auth::user()->id || Auth::user()->id == 0)
                        <a class='btn btn-success' href="/mankementje/{{ $mankementje['id'] }}/solve"><i
                                class='bi bi-check'></i>&nbsp;Dit is opgelost!</a>
                    @endif
                @endauth
                <a class='btn btn-danger'
                    href="mailto:report@mankementjes.nl?subject=Rapport%3A%20mankementje%20%23{{ $mankementje['id'] }}"><i
                        class='bi bi-exclamation-triangle-fill'></i>&nbsp;Rapporteer</a>
            @endunless

            @php
                // Get comments from model
                $comments = \App\Models\Comment::where('mankementje_id', $mankementje['id'])->get();
            @endphp

            <h2 class="mt-3">Reacties</h2>
            <x-comment-list :comments="$comments" />

            @auth
                @unless ($mankementje['status'] == 'Opgelost')
                    <h3 class="mt-3">Reageer</h3>
                    <form action="/mankementje/{{ $mankementje['id'] }}/comment" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Reactie"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Plaatsen</button>
                    @else
                        <span class="mankementje-datum mt-3">Dit mankementje is opgelost. Reageren is niet meer mogelijk.</span>
                    @endunless
                @endauth

                @guest
                    <span class="mt-3"><a href="/me/login">Log in</a> om te reageren.</span>
                @endguest
        </div>
    </div>
</div>

<x-footer />
