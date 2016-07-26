<?php
    require_once 'vendor/autoload.php';

    session_start();

    use \Michelf\Markdown;
    use \Battleship\Game;

    function loadGame($identifier)
    {
        if (isset($_SESSION[$identifier])) {
            return unserialize($_SESSION[$identifier]);
        }
      
        return new Game($identifier);
    }

    $game = loadGame('test');

    if (isset($_POST['enemy'])) {
        $coordinate = explode('_', array_keys($_POST['enemy'])[0]);
        $game->playerShot($coordinate[0], $coordinate[1]);
    }


    $_SESSION['test'] = serialize($game);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Battleship</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bower_components/bootstrap/assets/js/html5shiv.js"></script>
      <script src="bower_components/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
    
    <link href="css/global.css" rel="stylesheet" media="screen">    
</head>
<body>
    <div class="container">
        <h1>Battleship</h1>

        <?php
        $messages = $game->getMessages();
        foreach ($messages as $key => $value) {
            echo '<div class="alert alert-info">' . $key . ' &raquo; ' . $value . '</div>';
        }
        ?>

        <form action="" method="post">
            <div class="row">
                <?= $game->getHTML() ?>
            </div>
        </form>

        <div class="anmerkungen">
        <?= Markdown::defaultTransform(file_get_contents("README.md")) ?>
        </div>

        <script src="bower_components/jquery/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </div>
</body>
</html>