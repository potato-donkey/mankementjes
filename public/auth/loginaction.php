<?php
    $username = $_GET['username'];

    session_start();

    if(!isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: /?message=12');
    } else {
        header('Location: /');
    }
?>