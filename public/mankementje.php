<?php
    require_once "./functions.php";

    $id = $_GET['id'];
    if(!is_numeric($id)) header('Location: /');

    $mankementje = getMankementje($id);
    $image = $mankementje->image;
    $title = $mankementje->title;
    $description = $mankementje->description;
    $park = $mankementje->park;
    $location = $mankementje->location;
    $section = $mankementje->section;
    $date = $mankementje->date;
    $user = $mankementje->username;

    $commentsArray = $mankementje->comments;
    $comments = "";

    foreach($commentsArray as $comment) {
        $comments .= renderComment($comment->username, $comment->date, $comment->content, $comment->id);
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
        <div class="row">
            <div class="col">
                <span class="mankementje-park-locatie"><?php echo $park; ?> &centerdot; <?php echo $location; ?> (<?php echo $section;?>)</span><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <img class="img-fluid rounded mb-2" src="<?php echo $image; ?>">
                <h2><?php echo $title; ?></h2>
                <span class="mankementje-datum">Gemeld op <?php echo $date; ?> door <?php echo $user; ?></span>
                <p>
                    <?php echo $description; ?>
                </p>
            </div>
            <div class="col-12 col-md-4 ps-md-5">
                <h2>Reacties</h2>

                <?php echo $comments; ?>
            </div>
        </div>

        
    </div>
</body>

</html>