<?php
    require_once "./functions.php";

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
    <title>Melden | Mankementjes</title>
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
        <h2>Mankementjes melden is op dit moment nog niet mogelijk.</h2>
        <a href='/' class='me-2 hover-pointer'><i class='bi bi-caret-left-fill'></i>Terug naar homepagina</a>
    </div>
</body>

</html>