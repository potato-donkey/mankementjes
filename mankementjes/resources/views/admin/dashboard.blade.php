<x-head title="Administratie" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <h2>Administratie</h2>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mankementjes-tab" data-bs-toggle="tab"
                    data-bs-target="#mankementjes-tab-pane" type="button" role="tab"
                    aria-controls="mankementjes-tab-pane" aria-selected="true">Mankementjes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane"
                    type="button" role="tab" aria-controls="users-tab-pane"
                    aria-selected="false">Gebruikers</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mankementjes-tab-pane" role="tabpanel"
                aria-labelledby="mankementjes-tab" tabindex="0">
                @php
                    // select all mankementjes
                    $mankementjes = \App\Models\Mankementje::all()->sortBy('date');

                    // select all users
                    $users = \App\Models\User::all();
                @endphp
                <x-admin.mankementjes-table :mankementjes="$mankementjes" />
            </div>
            <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                <x-admin.users-table :users="$users" />
            </div>
        </div>

    </div>
</div>

<x-footer />
