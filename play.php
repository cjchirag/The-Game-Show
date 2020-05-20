<!DOCTYPE html>

<?php
ini_set('display_errors', '1');
include 'inc/Phrase.php';
include 'inc/Game.php';

session_start();

/*
When a new game is started from index.php. The session variable 'new-game' is set
to true when the player selects to start a new game.
*/

/*

VARIABLE DEFINITIONS:

SESSION Variables:
'user_values' -> is used to store user inputs. The buttons the user clicks to register their guesses.
'phrase' -> is used to store the current phrase object.
'game' -> is used to store the current game object.
'new-game' -> is initally set at index.php. It is set to true when the user clicks to start a new game. And once
the game has begun, it is set to false.

*/




if ($_SESSION['new-game'] === true) {
  $_SESSION['user_values'] = [];
  $phrase = new Phrase ($all_phrases[mt_rand(0, count($all_phrases)-1)]);
  $game = new Game ($phrase);
  $_SESSION['phrase'] = $phrase;
  $_SESSION['game'] = $game;
  $_SESSION['new-game'] = false;
}

/*
The game is reset here when the user clicks the reset button.
*/
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
    $_SESSION['user_values'][] = strtolower($key);
    $_SESSION['game']->getPhrase()->selected = $_SESSION['user_values'];
  }
}

if ($_SESSION['user_values'] != []) {
  if ($_SESSION['phrase']->checkLetter(end($_SESSION['user_values'])) === false) {
    $_SESSION['game']->lives--;
  }
}

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
        // A variable to test whether the game is over or not.
        $GameOverTest = $_SESSION['game']->gameOver($_SESSION['user_values']);

        // if a sting is returned -> it means we have a result :D
        if (is_string($GameOverTest)) {

          echo '<h1 id="game-over-message">';
          echo $GameOverTest;
          echo "</h1>";

        // if a false is returned -> it means the game is not over
        } else if ($GameOverTest == false)  {

        // All the display methods are called here since the game is not over.

          echo $_SESSION['game']->displayScore($_SESSION['game']->lives);
          echo $_SESSION['game']->getPhrase()->addPhraseToDisplay($_SESSION['user_values']);
          echo $_SESSION['game']->displayKeyboard($_SESSION['user_values']);

        }

        // A form for navigation and reseting the game. It sets a post values which
        // evaluates whether the game is reset or not.
        ?>
        <form action="play.php" method = 'post'>
            <input id="btn__reset" type="submit" name='reset' value = 'reset' />
            <input id="btn__reset" type="submit" name='home' value = 'home' />
        </form>
    </div>
</div>

</body>
</html>
