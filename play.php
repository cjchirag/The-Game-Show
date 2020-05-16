<!DOCTYPE html>

<?php
ini_set('display_errors', '1');
session_start();
include 'inc/Phrase.php';
include 'inc/Game.php';
$test = new Phrase('Chirag');

//$_SESSION['user_values'] = [];

$game = new Game($test);
// $all_phrases[mt_rand(0, count($all_phrases))]

$keys = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'
        , 'z', 'x', 'c', 'v', 'b', 'n', 'm'];

foreach ($keys as $key) {
  if (isset($_POST["key-input-$key"])) {
    $_SESSION['user_values'][] = $key;
    var_dump($_SESSION['user_values']);
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
        echo $test->addPhraseToDisplay($_SESSION['user_values']);
        echo $game->displayKeyboard($_SESSION['user_values']);
        ?>
    </div>
</div>

</body>
</html>
