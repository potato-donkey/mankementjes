<div class='mankementje col-12 col-md-4'>
    <a class='unstyled mankementje' href='./mankementje/{{ $mankementje['id'] }}'>
        <div class='card'>
            <img src='{{ $mankementje['image'] }}' class='card-img-top mankementje-card-img' alt='Foto van mankement'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-8'>
                        <span class='mankementje-park-locatie'>{{ $mankementje['park'] }} &centerdot;
                            {{ $mankementje['location'] }}</span><br>
                        <span class='mankementje-titel'>{{ $mankementje['title'] }}</span><br>
                        <span class='mankementje-datum'>Gemeld op {{ $mankementje['date'] }}</span>
                    </div>
                    <div class='col-4 mankementje-comments'>
                        <div class="row">
                            @php
                                $status = $mankementje['status'];
                                $status = strtolower($status);

                                $colour = '';

                                switch($status) {
                                    case 'open':
                                        $colour = 'red';
                                        break;
                                    case 'opgelost':
                                        $colour = 'green';
                                        break;
                                    default:
                                        $colour = 'secondary';
                                        break;
                                }
                            @endphp
                            <span class='mankementje-status {{$colour}}'><i class="bi bi-circle-fill"></i>&nbsp;{{ $mankementje['status'] }}</span>
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
