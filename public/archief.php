<?php
    require_once "./functions.php";

    session_start();

    if(isset($_SESSION['loggedin'])) {
        $loggedin = $_SESSION['loggedin'];
    } else {
        $loggedin = false;
    }

    $mankementjes = "";

    $mankementjesArray = getArchivedMankementjes();

    foreach($mankementjesArray as $mankement) {
        $mankementjes .= renderMankementje($mankement->id, $mankement->image, $mankement->title, $mankement->park, $mankement->location, $mankement->date, count($mankement->comments));
    }

    if(count($mankementjesArray) == 0) {
        $mankementjes = "<div class='col-12'><p>Er zijn nog geen mankementjes gemeld.</p></div>";
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
    <title>Archief | Mankementjes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="./js/bootstrap.bundle.js"></script>
    <script src="./js/main.js"></script>
</head>

<body>

    <!-- Navigation -->
    <?php echo renderNavbar($loggedin); ?>
    <!-- Render the navbar using the renderNavbar function from functions.php -->

    <div class="container mt-5 pt-4">
        <?php echo renderAlert($alert); ?>
        <h2>Gearchiveerde mankementjes</h2>
        <div class="row row-cols-1 g-4">
            <?php echo $mankementjes; ?>
        </div>
    </div>
</body>

</html>