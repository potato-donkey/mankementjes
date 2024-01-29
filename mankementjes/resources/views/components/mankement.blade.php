<div class='mankementje col' data-park="{{ $mankementje['park'] }}">
    <a class='unstyled mankementje' href='./mankementje/{{ $mankementje['id'] }}'>
        <div class='card'>
            <img src='{{ $mankementje['image'] }}' class='card-img-top mankementje-card-img' alt='Foto van mankement'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-8'>
                        <span class='mankementje-park-locatie text-primary'>
                            <span class='text-secondary'>
                                @php
                                    $park = \App\Models\Park::where('identifier', $mankementje['park'])->first();
                                    $statusObj = \App\Models\Status::where('status', $mankementje['status'])->first();
                                @endphp

                                @if ($park)
                                    {{ $park['name'] }}
                                @else
                                    {{ 'Onbekend' }}
                                @endif
                            </span>
                            <br />
                            <span class=' mankementje-locatie fst-italic'>
                                @php
                                    $location = \App\Models\Location::where('id', $mankementje['location'])->first();
                                @endphp
                                @if ($location)
                                    {{ $location['location'] }}
                                @else
                                    {{ 'Algemeen' }}
                                @endif
                            </span></span><br>
                        <span class='mankementje-titel'>{{ $mankementje['title'] }}</span><br>
                        <span class='mankementje-datum'>Gemeld op
                            {{ \App\Http\Controllers\DateController::renderFullDate($mankementje['date']) }}</span><br />
                            @php
                                $status = $mankementje['status'];
                                $status = strtolower($status);

                                $colour = '';

                                switch ($status) {
                                    case 'open':
                                        $colour = 'red';
                                        break;
                                    case 'opgelost':
                                        $colour = 'green';
                                        break;
                                    case 'onderhoud':
                                        $colour = 'blue';
                                        break;
                                    default:
                                        $colour = 'orange';
                                        break;
                                }
                            @endphp
                            <span class='mankementje-status {{ $colour }}'
                                title="{{ $statusObj['description'] }}"><i
                                    class="bi bi-circle-fill"></i>&nbsp;{{ $mankementje['status'] }}</span>
                    </div>
                    <div class='col-4 mankementje-comments'>
                        <div class="row">

                        </div>
                        <div class="row mt-3">
                            @php
                                $comments = \App\Models\Comment::where('mankementje_id', $mankementje['id'])->get();
                            @endphp
                            <span class='mankementje-stat'><i
                                    class='bi bi-chat'></i>&nbsp;{{ count($comments) }}</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
