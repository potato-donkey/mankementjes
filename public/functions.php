<?php
ini_set("allow_url_fopen", 1);
$API_URL = "http://localhost:3000";
$ADMIN_USERNAME = "Beheerder";

// A 'mankementje' is a Dutch word for a small defect or malfunction.

// This function renders a 'mankementje' (singular) on the page.
function renderMankementje($id, $image, $title, $park, $location, $date, $comments) {

$mankement = "";

$mankement .= "<div class='mankementje col-12 col-md-3'>";
    $mankement .= "<div class='card'>";
        $mankement .= "<img src='$image' class='card-img-top' alt='Foto van mankement'>";
        $mankement .= "<div class='card-body'>";
            $mankement .= "<span class='mankementje-park-locatie'>$park &centerdot; $location</span><br>";
            $mankement .= "<span class='mankementje-titel'>$title</span><br>";
            $mankement .= "<span class='mankementje-datum'>Gemeld op $date</span>";
            $mankement .= "<div class='row mankementje-stats'>";
                $mankement .= "<div class='col-4 mankementje-comments'>";
                    $mankement .= "<span class='mankementje-stat' title='$comments reacties'><i class='bi bi-chat'></i>&nbsp;$comments</span><br>";
                    $mankement .= "</div>";
                $mankement .= "<div class='col-4'>";
                    $mankement .= "</div>";
                $mankement .= "<div class='col-4'>";
                    $mankement .= "<a class='btn btn-primary' href='./mankementje.php?id=$id'>Bekijk</a>";
                    $mankement .= "</div>";
                $mankement .= "</div>";
            $mankement .= "</div>";
        $mankement .= "</div>";
    $mankement .= "</div>";

return $mankement;
}


function getMankementjes() { // Get all open mankementjes
    global $API_URL;
    $mankementjes = array();

    $json = file_get_contents($API_URL . "/mankementjes");
    $obj = json_decode($json);

    foreach($obj as $mankement) {
        $mankementjes[] = $mankement;
    }

    return $mankementjes;
}

function getArchivedMankementjes() {
    global $API_URL;
    $mankementjes = array();

    $json = file_get_contents($API_URL . "/mankementjes/archief");
    $obj = json_decode($json);

    foreach($obj as $mankement) {
        $mankementjes[] = $mankement;
    }

    return $mankementjes;
}

function getMankementje($id) {
    global $API_URL;

    $json = file_get_contents($API_URL . "/mankementjes/" . $id);
    $mankementje = json_decode($json);

    return $mankementje;
}

function renderComment($name, $date, $content, $status, $id) {
    global $ADMIN_USERNAME;
    global $API_URL;
    if(isset($_SESSION['loggedin'])) {
        $username = $_SESSION['username'];
    } else {
        $username = "";
    }

    if($ADMIN_USERNAME == $name) {
        $displayName = "<b class='text-danger'><i class='bi bi-hammer'></i>&nbsp;$name</b>";
    } else if($username == $name) {
        $displayName = "<b>$name</b>";
    } else {
        $displayName = $name;
    }

    $comment = "";
    $comment .= "<div class='card mb-3'>";
    $comment .= "<div class='card-body'>";
    $comment .= "<h5 class='card-title'>$displayName</h5>";
    $comment .= "<p class='card-text'>$content</p>";
    $comment .= "<small>$date</small>";
    if($status == 'review') {
        $comment .= "<span class='text-warning'>&nbsp;&centerdot;&nbsp;In beoordeling</span>";
    }
    if($username === $name || $username === $ADMIN_USERNAME) {
        $comment .= "&nbsp;<a href='$API_URL/comment/delete/$id/$username' class='text-danger' title='Verwijder reactie'><i class='bi bi-trash3'></i></a>";
    }
    $comment .= "</div>";
    $comment .= "</div>";

    return $comment;
}

function renderNavbar($loggedin) {
    $navbar = "";

    if($loggedin == false) {
        $name = "Bezoeker";
    } else {
        $name = $_SESSION['username'];
    }

    $navbar .= "<nav class='navbar navbar-expand-lg navbar-light bg-light fixed-top'>";
       $navbar .= "<div class='container'>";
           $navbar .= "<a href='/' class='navbar-brand primary'><i class='bi bi-tools'></i>&nbsp;Mankementjes</a>";
           $navbar .= "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive'
                aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'><span
                    class='navbar-toggler-icon'></span></button>";
           $navbar .= "<div class='collapse navbar-collapse' id='navbarResponsive'>";
               $navbar .= "<ul class='navbar-nav'>";
                   $navbar .= "<li class='nav-item'><a href='/archief.php' class='nav-link'>Archief</a></li>";
               $navbar .= "</ul>";
            //    $navbar .= "<form class='d-flex' role='search'>";
            //        $navbar .= "<input class='form-control me-2' type='search' placeholder='Zoeken..' aria-label='Zoeken'>";
            //        $navbar .= "<button class='btn btn-outline-secondary' type='submit'>Zoeken</button>";
            //    $navbar .= "</form>";
               $navbar .= "<ul class=' ms-auto navbar-nav'>";
                   $navbar .= "<li class='nav-item dropdown'>";
                       $navbar .= "<a class='nav-link navbar-icon dropdown-toggle primary' href='#' id='navbarDropdown' role='button'
                            data-bs-toggle='dropdown' aria-expanded='false'>$name&nbsp;<i
                                class='bi bi-person-circle'></i></a>";
                       $navbar .= "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>";
                            if($loggedin == false) {
                                $navbar .= "<li><a class='dropdown-item' href='/auth/login.php'>Inloggen</a></li>";
                            } else {
                                $navbar .= "<li><a class='dropdown-item' href='melden.php'>Mankementje melden</a></li>";
                                $navbar .= "<li>";
                                $navbar .= "<hr class='dropdown-divider'>";
                                $navbar .= "</li>";
                                $navbar .= "<li><a class='dropdown-item' href='/auth/logout.php'>Uitloggen</a></li>";
                            }
                       $navbar .= "</ul>";

           $navbar .= "</div>";
        $navbar .= "</div>";
   $navbar .= "</nav>";

   return $navbar;
}

function createAlert($type, $message) {
    $icon = "";

    switch($type) {
        case 'danger':
            $icon = "<i class='bi bi-exclamation-octagon-fill'></i>";
            break;
        case 'success':
            $icon = "<i class='bi bi-check-lg'></i>";
            break;
        case 'warning':
            $icon = "<i class='bi bi-exclamation-triangle-fill'></i>";
            break;
        case 'info':
            $icon = "<i class='bi bi-info-circle-fill'></i>";
            break;
    }

    return "<div class='alert alert-$type alert-dismissible fade show' role='alert'>$icon&nbsp;$message<button type='button' class='btn-close' data-bs-dismiss='alert' onClick='removeMessageFromURL()' aria-label='Sluiten'></button></div>";
}

function renderAlert($message) {
    $alert = "";
    if(!is_numeric($message)) return "";
    switch ($message) {
        case 01: // 00 series is for logging out
            $alert = createAlert('success', "Succesvol uitgelogd."); // Successfully logged out
            break;
        case 10: // 10 series is for logging in
            $alert = createAlert('danger', "Gebruikersnaam of wachtwoord is onjuist."); // Username or password incorrect
            break;
        case 11:
            $alert = createAlert('danger', "Gebruikersnaam bestaat niet."); // Username doesn't exist
            break;
        case 12:
            $alert = createAlert('success', "Succesvol ingelogd"); // Successfully logged in
            break;
        case 20: // 20 series is for registering
            $alert = createAlert('danger', "Wachtwoorden komen niet overeen."); // Passwords don't match
            break;
        case 21:
            $alert = createAlert('danger', "Gebruikersnaam is al in gebruik."); // Username in use
            break;
        case 22:
            $alert = createAlert('danger', "Wachtwoorden voldoen niet aan de voorwaarden."); // Passwords don't meet requirements
            break;
        case 23:
            $alert = createAlert('success', "Geregistreerd. Je kan nu inloggen."); // Successfully registered. You may now login.
            break;
        case 24:
            $alert = createAlert('danger', "Nee."); // Tried to use admin username
            break;
        case 30: // 30 series is for comments
            $alert = createAlert('warning', "Reactie verwijderd."); // Comment deleted
            break;
        case 31:
            $alert = createAlert('success', "Reactie geplaatst."); // Comment posted
            break;
        case 32:
            $alert = createAlert('danger', "Reactie kon niet worden geplaatst."); // Comment couldn't be posted
            break;
        case 40: // 40 series is for mankementjes
            $alert = createAlert('danger', "Mankementje kon niet worden gemeld."); // Mankement couldn't be posted
            break;
        case 41:
            $alert = createAlert('success', "Mankementje gemeld."); // Mankement posted
            break;
        case 42:
            $alert = createAlert('warning', "Mankementje verwijderd."); // Mankement deleted
            break;
    }
    return $alert;
}

?>