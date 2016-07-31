<?php
    require_once 'vendor/autoload.php';

    session_start();

    use \Michelf\Markdown;
    use \Battleship\Game;

    if (isset($_POST['username'])) {
        $_SESSION['identifier'] = $_POST['username'];
    }

    function loadUsername()
    {
        return $_SESSION['identifier'];
    }

    function loadGame()
    {
        $identifier = loadUsername();

        if (isset($_SESSION[$identifier])) {
            return unserialize($_SESSION[$identifier]);
        }
      
        return new Game($identifier);
    }

    $game = loadGame();

    if (isset($_POST['enemy'])) {
        $coordinate = explode('_', array_keys($_POST['enemy'])[0]);
        $game->playerShot($coordinate[0], $coordinate[1]);
    }


    $_SESSION[loadUsername()] = serialize($game);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Battleship</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
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

        <?= $game->render() ?>
        
    </div>
</body>
</html>