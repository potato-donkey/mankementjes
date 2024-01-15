@foreach ($comments as $comment)
    <x-comment :comment="$comment" />
@endforeach

@if(count($comments) == 0)
    <div class='col-12'><p>Geen reacties om te tonen.</p></div>
@endif