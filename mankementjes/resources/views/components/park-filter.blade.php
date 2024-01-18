<select class="form-select" id="parkFilter" aria-label="Filter op park">
    <option value="none" selected>Alle parken</option>
    @php
        $parks = \App\Models\Park::all();
    @endphp
    @foreach ($parks as $park)
        <option value="{{ $park->identifier }}">{{ $park->name }}</option>
    @endforeach
</select>
