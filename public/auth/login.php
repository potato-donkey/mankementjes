<?php
    require_once "../functions.php";
    session_start();

    if(isset($_SESSION['loggedin'])) {
        $loggedin = $_SESSION['loggedin'];
    } else {
        $loggedin = false;
    }

    // Getting the alert
    if(isset($_GET['message'])) {
        $alert = $_GET['message'];
    } else {
        $alert = 0;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inloggen | Mankementjes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>

    <!-- Navigation -->
    <?php echo renderNavbar($loggedin); ?>
    <!-- Render the navbar using the renderNavbar function from functions.php -->

    <div class="container mt-5 pt-4">
        <?php echo renderAlert($alert); ?>
        <div class="row mt-3">
            <div class="col-5">
                <h2>Inloggen</h2>
                <form class="mb-3" method="POST" enctype="multipart/form-data"
                    action="<?php echo $API_URL; ?>/user/login">
                    <div class="mb-3">
                        <label for="usernameLogin" class="form-label">Gebruikersnaam</label>
                        <input type="text" class="form-control" name="username" id="usernameLogin" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordLogin" class="form-label">Wachtwoord</label>
                        <input type="password" class="form-control" name="password" id="passwordLogin" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Inloggen</button>
                </form>
            </div>

            <div class="col-2 text-center my-5 pt-5">
                <span class="fs-2">of</span>
            </div>

            <div class="col-5">
                <h2>Registreren</h2>
                <form class="mb-3" method="POST" enctype="multipart/form-data"
                    action="<?php echo $API_URL; ?>/user/register">
                    <div class="mb-3">
                        <label for="usernameRegister" class="form-label">Gebruikersnaam</label>
                        <input type="text" class="form-control" name="username" id="usernameRegister" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordRegister" class="form-label">Wachtwoord</label>
                        <input type="password" class="form-control" name="password" id="passwordRegister" required>
                        <div id="passwordHelp" class="form-text">Minimaal 8 tekens, waarvan minstens 1 cijfer.</div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordRegisterRepeat" class="form-label">Wachtwoord herhalen</label>
                        <input type="password" class="form-control" name="passwordRepeat" id="passwordRegisterRepeat"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registreren</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>