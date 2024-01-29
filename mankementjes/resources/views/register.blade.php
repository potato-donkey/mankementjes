<x-head title="Registreren" />
<x-navbar />

<div class="container mt-5 pt-4">
    <h2>Registreren</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-md-4">
            <form action="/me/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="new_name" class="form-label">Gebruikersnaam</label>
                    <input type="text" class="form-control" id="new_name" name="new_name" required>
                </div>
                <div class="mb-3">
                    <label for="new_email" class="form-label">E-mailadres</label>
                    <input type="email" class="form-control" id="new_email" name="new_email" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Wachtwoord</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="privacy" name="privacy" required>
                    <label for="privacy">Ik ga akkoord met de <a href="/privacy">privacyvoorwaarden</a></label>
                </div>
                <button type="submit" class="btn btn-secondary">Registreren</button>
            </form>
        </div>
        <div class="col col-md-2"></div>
        <div class="col-12 col-md-6">
            <h3>Registreer om</h3>
            <ul>
                <li>Mankementjes te melden</li>
                <li>Op de hoogte te blijven van mankementjes</li>
                <li>Je eigen mankementjes te beheren</li>

                <p>Al een account? <a href="/me/login">Log in!</a></p>
            </ul>
        </div>
    </div>
</div>

<x-footer />
