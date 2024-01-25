<div class="row mt-auto row-cols-1 row-cols-md-3 g-4 mb-3">
    @if (count($mankementjes) == 0)
        <div class='col-12'>
            <p>Geen mankementjes om te tonen.</p>
        </div>
    @endif
    @foreach ($mankementjes as $mankement)
        <x-mankement :mankementje="$mankement" />
    @endforeach
</div>
