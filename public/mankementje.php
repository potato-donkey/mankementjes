<?php
    require_once "./functions.php";

    session_start();

    if(isset($_SESSION['loggedin'])) {
        $loggedin = $_SESSION['loggedin'];
    } else {
        $loggedin = false;
    }

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

    $status = $mankementje->status;

    $commentsArray = $mankementje->comments;
    $comments = "";

    if(count($commentsArray) == 0) {
        $comments = "<p>Er zijn nog geen reacties geplaatst.</p>";
    }

    foreach($commentsArray as $comment) {
        $comments .= renderComment($comment->username, $comment->date, $comment->content, $comment->status, $comment->id);
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
    <title><?php echo "$title &centerdot; $location, $park" ?> | Mankementjes</title>
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
        <div class="row">
            <div class="col">
                <?php
                    if($status == 'open') {
                        echo "<a href='/' class='me-2 hover-pointer'><i class='bi bi-caret-left-fill'></i>Terug naar homepagina</a>";	
                    } else {
                        echo "<a href='/archief.php' class='me-2 hover-pointer'><i class='bi bi-caret-left-fill'></i>Terug naar archief</a>";
                    }
                ?>
                <span class="mankementje-park-locatie" title="Locatie van het mankementje"><?php echo $park; ?>
                    &centerdot; <?php echo $location; ?>
                    (<?php echo $section;?>)</span><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <img class="img-fluid rounded mb-2" src="<?php echo $image; ?>">
                <h2><?php echo $title; ?></h2>
                <span class="mankementje-datum">Gemeld op <?php echo $date; ?> door <?php echo $user; ?></span>
                <p>
                    <?php echo $description; ?>
                </p>
            </div>
            <div class="col-12 col-md-6 ps-md-5">
                <?php if($status == 'open') {
                    echo "<a class='btn btn-success me-2' title='Markeer dit mankementje als opgelost'><i class='bi bi-check'></i>&nbsp;Dit is opgelost!</a>";
                    echo "<a class='btn btn-danger' title='Rapporteer dit mankementje'><i class='bi bi-exclamation-triangle-fill'></i>&nbsp;Rapporteer</a>";
                    }
                ?>

                <?php
                if($loggedin) { // Only let logged in users comment
                echo "<h3 class='mt-3'>Reageren</h3>";
                echo "<form class='mb-3' method='POST' enctype='multipart/form-data action ='http://localhost:3000/comment/add'>";
                echo "<div class='mb-3'>";
                    echo "<textarea class='form-control' name='content' id='comment' placeholder='Typ hier je reactie...' rows='2' required></textarea>";
                echo "</div>";
                echo "<input type='hidden' name='mankementje' value='$id'>";
                echo "<input type='hidden' name='user' value='" . $_SESSION['username'] . "'>";
                echo "<button type='submit' class='btn btn-primary'>Plaats reactie</button>";
                }
                ?>
                <h2 class="mt-3">Reacties</h2>
                <?php echo $comments; ?>
            </div>
        </div>


    </div>
</body>

</html>