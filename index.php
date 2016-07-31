<?php
require_once 'vendor/autoload.php';

use \Michelf\Markdown;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Battleship</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bower_components/bootstrap/assets/js/html5shiv.js"></script>
      <script src="bower_components/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
    
    <link href="css/global.css" rel="stylesheet" media="screen">    
</head>
<body>
    <div class="container">
        <h1 class="gigant">Battleship</h1>

        <img class="img-center" src="assets/img/battleship.png" alt="battleship">

        <form action="game.php" method="POST">
            <div class="play">
                <div class="form-input">
                    <input type="text" value="" placeholder="username" name="username" required>
                </div>

                <button type="submit" class="btn btn-play">Play</button>
            </div>
        </form>
    </div>
    <div class="container dark">
        <div class="description">
            <?= Markdown::defaultTransform(file_get_contents("README.md")) ?>
        </div>
    </div>
</body>
</html>