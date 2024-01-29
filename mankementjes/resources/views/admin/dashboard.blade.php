<x-head title="Administratie" />
<x-navbar />

@php
    // select all mankementjes
    $mankementjes = \App\Models\Mankementje::all()->sortBy('date');

    // select all users
    $users = \App\Models\User::all();
@endphp

<div class="container mt-5 pt-4">
    <div class="row">
        <h2>Administratie</h2>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mankementjes-tab" data-bs-toggle="tab"
                    data-bs-target="#mankementjes-tab-pane" type="button" role="tab"
                    aria-controls="mankementjes-tab-pane" aria-selected="true">Mankementjes&nbsp;<span
                        class="badge text-bg-light">{{ count($mankementjes) }}</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane"
                    type="button" role="tab" aria-controls="users-tab-pane"
                    aria-selected="false">Gebruikers&nbsp;<span
                        class="badge text-bg-light">{{ count($users) }}</span></button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mankementjes-tab-pane" role="tabpanel"
                aria-labelledby="mankementjes-tab" tabindex="0">
                <x-admin.mankementjes-table :mankementjes="$mankementjes" tableid="tableMankementjes" />
            </div>
            <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                <x-admin.users-table :users="$users" tableid="tableUsers" />
            </div>
        </div>

    </div>
</div>

<script>
    const searchMankementjes = document.getElementById('searchMankementjes');
    const tableMankementjes = document.getElementById('tableMankementjes');
    const rowsMankementjes = tableMankementjes.querySelectorAll('tbody tr');

    // When typed into searchMankementjes
    searchMankementjes.addEventListener('input', () => {
        const query = searchMankementjes.value.toLowerCase();
        rowsMankementjes.forEach(row => {
            const columns = row.querySelectorAll('td');

            if (columns[1].innerText.toLowerCase().includes(query) || columns[2].innerText.toLowerCase()
                .includes(query) || columns[3].innerText.toLowerCase().includes(query)) {
                // Show row
                row.style.display = '';
            } else {
                // Hide row
                row.style.display = 'none';
            }
        });
    });

    const searchUsers = document.getElementById('searchUsers');
    const tableUsers = document.getElementById('tableUsers');
    const rowsUsers = tableUsers.querySelectorAll('tbody tr');

    // When typed into searchUsers
    searchUsers.addEventListener('input', () => {
        const query = searchUsers.value.toLowerCase();
        rowsUsers.forEach(row => {
            const columns = row.querySelectorAll('td');

            if (columns[0].innerText.toLowerCase().includes(query) || columns[1].innerText.toLowerCase()
                .includes(query) || columns[2].innerText.toLowerCase().includes(query)) {
                // Show row
                row.style.display = '';
            } else {
                // Hide row
                row.style.display = 'none';
            }
        });
    });
</script>

<x-footer />
