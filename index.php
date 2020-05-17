<!DOCTYPE html>
<?php
ini_set('display_errors', '1');

if (isset($_POST['new-game'])) {
	session_start();
	$_SESSION['new-game'] = true;
	header('location: play.php');
	exit();
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
			<h2 class="header">Phrase Hunter</h2>
            <form action="index.php" method='POST'>
              <input id="btn__reset" type="submit" name='new-game' value="Start Game" />
            </form>
		</div>

	</body>
</html>
