<div class='card'>
    <div class='card-body'>
        @php
            $user = \App\Models\User::where('id', $comment['user_id'])->first();

            $mankementje = \App\Models\Mankementje::where('id', $comment['mankementje_id'])->first();
        @endphp

        @if ($comment['user_id'] == 0)
            <h5 class='card-title text-secondary' title="Website beheerder">{{ $user['name'] }}</h5>
        @elseif($comment['user_id'] == $mankementje['user_id'])
            <h5 class='card-title text-primary' title="Originele aanmelder">{{ $user['name'] }}</h5>
        @else
            <h5 class='card-title'>{{ $user['name'] }}</h5>
        @endif

        <p class='card-text'>{{ $comment['content'] }}</p>
        <small>{{ $comment['date'] }}</small>
    </div>
</div>
