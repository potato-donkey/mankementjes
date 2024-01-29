    @if (count($mankementjes) == 0)
        <div class='col-12' id="noMankementjes">
            <p>Geen mankementjes om te tonen.</p>
        </div>
    @else
        <div class='col-12 d-none' id="noMankementjes">
            <p>Geen mankementjes om te tonen.</p>
        </div>
    @endif
<div class="row mt-auto row-cols-1 row-cols-md-3 g-4 mb-3">
    @foreach ($mankementjes as $mankement)
        <x-mankement :mankementje="$mankement" />
    @endforeach
</div>
