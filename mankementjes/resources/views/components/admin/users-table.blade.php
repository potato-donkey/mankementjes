<input type=text class="form-control" id="searchUsers" placeholder="Zoeken in ID, naam of e-mailadres">
<table class="table table-striped table-hover" id="{{ $tableid }}">
    <thead>
        <tr>
            <th>ID</th>
            <th>Gebruikersnaam</th>
            <th>E-mailadres</th>
            <th>Lid sinds</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
