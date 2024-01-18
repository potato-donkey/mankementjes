<x-head title="Inloggen" />
<x-navbar />

<div class="container mt-5 pt-4">
    <h2>Inloggen</h2>
    <div class="row">
        <div class="col-4">
            <form action="/me/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mailadres</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Wachtwoord</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-secondary">Inloggen</button>
            </form>
        </div>
        <div class="col-2"></div>
        <div class="col">
            <h3>Log in om</h3>
            <ul>
                <li>Mankementjes te melden</li>
                <li>Op de hoogte te blijven van mankementjes</li>
                <li>Je eigen mankementjes te beheren</li>
            </ul>

            <p>Heb je nog geen account? <a href="/me/register">Registreer je dan nu!</a></p>
        </div>
    </div>
</div>

<x-footer />
