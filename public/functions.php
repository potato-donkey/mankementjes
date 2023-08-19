<?php
ini_set("allow_url_fopen", 1);
$API_URL = "http://localhost:3000";

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
                    $mankement .= "<span class='mankementje-stat'><i class='bi bi-chat'></i>&nbsp;$comments</span><br>";
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


function getMankementjes() {
    global $API_URL;
    $mankementjes = array();

    $json = file_get_contents($API_URL . "/mankementjes/all");
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

function renderComment($name, $date, $content, $id) {
    $comment = "";
    $comment .= "<div class='card'>";
    $comment .= "<div class='card-body'>";
    $comment .= "<h5 class='card-title'>$name</h5>";
    $comment .= "<p class='card-text'>$content</p>";
    $comment .= "<small>$date</small>";
    $comment .= "</div>";
    $comment .= "</div>";

    return $comment;
}

?>