<!DOCTYPE html>

<?php
ini_set('display_errors', '1');
include 'inc/Phrase.php';
include 'inc/Game.php';

session_start();

//$_SESSION['user_values'] = [];

if ($_SESSION['new-game'] === true) {
  $_SESSION['user_values'] = [];
  $phrase = new Phrase ($all_phrases[mt_rand(0, count($all_phrases)-1)]);
  $game = new Game ($phrase);
  $_SESSION['phrase'] = $phrase;
  $_SESSION['game'] = $game;
  $_SESSION['new-game'] = false;
}

if (isset($_POST['reset'])) {
  $_SESSION['user_values'] = [];
  $_SESSION['phrase'] = new Phrase($all_phrases[mt_rand(0, count($all_phrases)-1)]);
  $_SESSION['game'] = new Game($_SESSION['phrase']);
}

if (isset($_POST['home'])) {
  header("Location: index.php");
  exit();
}

$keys = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'
        , 'z', 'x', 'c', 'v', 'b', 'n', 'm'];

foreach ($keys as $key) {
  if (isset($_POST["key-input-$key"])) {
    $_SESSION['user_values'][] = $key;
  }
}

if ($_SESSION['user_values'] != []) {
  if ($_SESSION['phrase']->checkLetter(end($_SESSION['user_values'])) === false) {
    $_SESSION['game']->lives--;
  }
}

// var_dump($test->addPhraseToDisplay($input));
// var_dump($game->displayKeyboard($input));

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <?php
        $GameOverTest = $_SESSION['game']->gameOver($_SESSION['user_values']);

        if (is_string($GameOverTest)) {

          echo '<h1 id="game-over-message">';
          echo $GameOverTest;
          echo "</h1>";

        } else if ($GameOverTest == false)  {

          echo $_SESSION['game']->displayScore($_SESSION['game']->lives);
          echo $_SESSION['phrase']->addPhraseToDisplay($_SESSION['user_values']);
          echo $_SESSION['game']->displayKeyboard($_SESSION['user_values']);

        }
        ?>

        <form action="play.php" method = 'post'>
            <input id="btn__reset" type="submit" name='reset' value = 'reset' />
            <input id="btn__reset" type="submit" name='home' value = 'home' />
        </form>
    </div>
</div>

</body>
</html>
