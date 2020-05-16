<!DOCTYPE html>

<?php
ini_set('display_errors', '1');
include 'inc/Phrase.php';
include 'inc/Game.php';
$test = new Phrase('Chirag');

$game = new Game($test);
// $all_phrases[mt_rand(0, count($all_phrases))]

$user_vals = [];
var_dump($user_vals);

$_POST['input'] = [];

$keys = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'
        , 'z', 'x', 'c', 'v', 'b', 'n', 'm'];

foreach ($keys as $key) {
  if (isset($_POST["key-input-$key"])) {
    //$user_vals[] = $key;
    var_dump("key-input-$key");
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
        echo $test->addPhraseToDisplay($user_vals);
        echo $game->displayKeyboard($user_vals);
        ?>
    </div>
</div>

</body>
</html>
