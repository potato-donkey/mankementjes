<?php
    require_once "./functions.php";

    $mankementjes = "";

    $mankementjesArray = getMankementjes();

    foreach($mankementjesArray as $mankement) {
        $mankementjes .= renderMankementje($mankement->id, $mankement->image, $mankement->title, $mankement->park, $mankement->location, $mankement->date, count($mankement->comments));
    }

    if(count($mankementjesArray) == 0) {
        $mankementjes = "<div class='col-12'><p>Er zijn nog geen mankementjes gemeld.</p></div>";
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mankementjes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="./js/bootstrap.bundle.js"></script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a href="./index.php" class="navbar-brand primary"><i class="bi bi-tools"></i>&nbsp;Mankementjes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="./archief.php" class="nav-link">Archief</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-4">
        <h2>Alle mankementjes</h2>
        <div class="row row-cols-1 g-4">
            <?php echo $mankementjes; ?>
        </div>
    </div>
</body>

</html>