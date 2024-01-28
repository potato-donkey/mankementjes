@php
    // Select all parks
    $parks = \App\Models\Park::all()->sortBy('name');

    // Select all locations
    $locations = \App\Models\Location::all()->sortBy('location');
@endphp
<x-head title="Melden" />
<x-navbar />

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-4">
            <h2>Mankementje melden</h2>
            <span class="text-muted fst-italic">Meld hier een nieuw mankementje.</span>

            <form action="/melden" method="POST">
                @csrf
                <label for="parkSelector" class="form-label">Park</label>
                <select class="form-select" id="parkSelector" name="park">
                    @foreach ($parks as $park)
                        <option value="{{ $park->identifier }}">{{ $park->name }}</option>
                    @endforeach
                </select>

                <label for="location" class="form-label mt-2">Locatie</label>
                <select class="form-select" id="location" name="location">
                    <option data-park="none" selected disabled>Selecteer een locatie</option>
                    @foreach ($locations as $location)
                        <option data-park="{{ $location->park }}" value="{{ $location->id }}">
                            {{ $location->location }}
                            ({{ $location->description }})
                        </option>
                    @endforeach
                </select>

                <label for="title" class="form-label mt-2">Titel</label>
                <input type="text" class="form-control" id="title" name="title">

                <label for="description" class="form-label mt-2">Beschrijving</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>

                <button type="submit" class="btn btn-secondary mt-2">Melden</button>
            </form>
        </div>
    </div>
</div>

<script>
    const parkSelector = document.getElementById('parkSelector');
    const locationSelector = document.getElementById('location');

    const locationsByPark = (park) => {
        // select option where data-park is 'none'
        locationSelector.value = locationSelector.querySelector('[data-park="none"]').value;

        for (let i = 0; i < locationSelector.options.length; i++) {
            const option = locationSelector.options[i];
            if (option.dataset.park === 'none') continue;

            if (option.dataset.park === park) {
                option.hidden = false;
            } else {
                option.hidden = true;
            }
        }
    }

    // Get first option in parkSelector
    const firstPark = parkSelector.querySelector('option');
    locationsByPark(firstPark.value);

    parkSelector.addEventListener('change', (event) => {
        const park = event.target.value;
        locationsByPark(park);
    });
</script>

<x-footer />
