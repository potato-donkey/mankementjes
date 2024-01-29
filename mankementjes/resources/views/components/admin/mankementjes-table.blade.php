<input type=text class="form-control" id="searchMankementjes" placeholder="Zoeken in park, locatie of titel">
<table class="table table-striped table-hover mankementjes-table" id="{{ $tableid }}">
    <thead>
        <tr>
            <th>ID</th>
            <th>Park</th>
            <th>Locatie</th>
            <th>Titel</th>
            <th>Datum</th>
            <th>Afbeelding</th>
            <th>Gebruiker</th>
            <th>Status</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mankementjes as $mankement)
            @php
                $park = \App\Models\Park::where('identifier', '=', $mankement->park)->first();
                $location = \App\Models\Location::where('id', '=', $mankement->location)->first();
                $user = \App\Models\User::where('id', '=', $mankement->user_id)->first();
            @endphp
            <tr>
                <td>{{ $mankement->id }}</td>
                <td>{{ $park->name }} ({{ $park->identifier }})</td>
                <td>{{ $location->location }} ({{ $location->id }})</td>
                <td>{{ $mankement->title }}</td>
                <td>{{ $mankement->date }}</td>
                <td>
                    @if ($mankement->image)
                        <a href="{{ $mankement->image }}" target="_blank">Foto&nbsp;<i
                                class="bi bi-box-arrow-up-right"></i></a>
                    @elseif ($mankement->image == '/assets/noimg.jpg')
                        Geen foto
                    @endif
                </td>
                <td>{{ $user->name }} ({{ $user->id }})</td>
                <td>{{ $mankement->status }}</td>
                <td class="fs-4">
                    <a title="Bekijken" class="text-success" href="/mankementje/{{ $mankement->id }}"><i
                            class="bi bi-search"></i></a>
                    <a title="Bewerken" class="text-warning" href="/admin/mankementje/{{ $mankement->id }}/edit"><i
                            class="bi bi-pencil-square"></i></a>
                    <a title="Verwijderen" class="text-danger" href="/admin/mankementje/{{ $mankement->id }}/delete"><i
                            class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
