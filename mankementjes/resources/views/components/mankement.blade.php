<div class='mankementje col-12 col-md-4'>
    <div class='card'>
        <img src='{{$mankementje["image"]}}' class='card-img-top' alt='Foto van mankement'>
        <div class='card-body'>
            <span class='mankementje-park-locatie'>{{$mankementje["park"]}} &centerdot; {{$mankementje["location"]}}</span><br>
            <span class='mankementje-titel'>{{$mankementje["title"]}}</span><br>
            <span class='mankementje-datum'>Gemeld op {{$mankementje["date"]}}</span>
            <div class='row mankementje-stats'>
                <div class='col-4 mankementje-comments'>
                    @php
                        $comments = \App\Models\Comment::where('mankementje_id', $mankementje['id'])->get();
                    @endphp
                    <span class='mankementje-stat'><i class='bi bi-chat'></i>&nbsp;{{count($comments)}}</span><br>
                    </div>
                <div class='col-4'>
                    </div>
                <div class='col-4'>
                    <a class='btn btn-primary' href='./mankementje/{{$mankementje["id"]}}'>Bekijk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>