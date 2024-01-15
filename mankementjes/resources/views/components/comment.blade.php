<div class='card'>
        <div class='card-body'>
            @php
                $user = \App\Models\User::where('id', $comment['user_id'])->first();
            @endphp

            @if($comment["user_id"] == 0)
                <h5 class='card-title primary'>{{$user["name"]}}</h5>
            @else
                <h5 class='card-title'>{{$user["name"]}}</h5>
            @endif
            
            <p class='card-text'>{{$comment["content"]}}</p>
        <small>{{$comment["date"]}}</small>
    </div>
</div>
