<!DOCTYPE html>
<?php
ini_set('display_errors', '1');

/*

Hey!! Thanks so much reviewing my project. How are you?
 I hope you and yours are safe and sound :)

Here's my success criteria notes:

At the moment, these are the three phrases set for test:
	$all_phrases = ['Only time will tell', 'Time flies', 'In a jiffy'];
You can change them in Phrase.php.

1. Class phrase includes the properties. The constructor accepts current_phrase... though I added a function
		which sets the selected_letters based on the current_phrase input.
		if a phrase string is not passed, setCurrentPhrase function sets the phrase randomly from the collection
		of phrase.

2. Phrase methods work as expected. When the input is correct, the value fills the specific box.
		CheckLetter works as expected to check if the input is correct.

3. The $phrase and $lives properties are declared and set in the constructor.

4. All game methods declared and work as expected.

5. Phrase boxes, keyboard, score are displayed allowing the user to select a value.

6. A value can be selected only once. Once its selected, the value is disabled as logic shows in
	addPhraseToDisplay.
	Appropriate win or loss message displayed based on the methods logic in gameOver.
	Both reset and home button added which reset values allowing the user to play again.

7. HTML and CSS used as given!

Thanks again!! Take care!

*/

// Here the user decides to start a new game!
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
