<?php

class Game {
  protected $phrase;
  public $lives;

  public function __construct(Phrase $phrase) {
      $this->phrase = $phrase;
      $this->lives = 5;
  }

  public function getPhrase () {
    return $this->phrase;
  }

  public function setPhrase (Phrase $phrase) {
    $this->phrase = $phrase;
  }


  // A function that checks if the player has selected all the correct letters in their input.
  public function checkForWin($playerInput) {
    // filter_input stores all the input values which are correct values.
    $filter_input = [];
    $bool = false;

    $correct_without_space = [];

    foreach ($this->getPhrase()->selected_letters as $selected) {
      if ($selected != ' ') {
        $correct_without_space[] = $selected;
      }
    }

    // to filter the input where the character exists
    foreach ($playerInput as $input) {
      if (in_array($input, $correct_without_space)) {

        // array count values returns the frequency of an element in the array.
        $checkForRepeat = array_count_values($correct_without_space)[$input];

        // A loop and logic condition to add characters which repeat in a phrase based on their frequency.
        if ($checkForRepeat > 1) {
          // if the character repeats more than once, add to the array based on its frequency.
          for ($i=1; $i<=$checkForRepeat; $i++) {
            $filter_input[] = $input;
          }
        } else {
          // if it doesn't repeat -> just add the character once.
          $filter_input[] = $input;
        }
      }
    }

    // to check if the length of the correct value and the user input are the same.
    // logic to check if every filtered character exists in the array.
    if (count($filter_input) === count($correct_without_space)) {
      foreach ($filter_input as $filtered) {
        if (in_array($filtered, $correct_without_space)) {
          $bool = true;
        } else {
          return false;
        }
      }
    }

    if ($bool == true) {
      return true;
    } else {
      return false;
    }

  }

  // A function that checks if the player has guessed too many wrongs.
  public function checkForLose() {

    if ($this->lives <= 0) {
      return true;
    } else {
      return false;
    }

  }

  // A function that displays one message: Whether they won or lost. Or the function returns false if not won or lost.
  public function gameOver($playerInput = []) {

  $message = '';

  if ($playerInput === [] || $this->checkForLose() === false && $this->checkForWin($playerInput) == false) {
      // Game not over yet!
      return false;

  } else {
    // Game over!! Evaluate whether they won or lost!
    if ($this->checkForWin($playerInput) === true && $this->checkForLose() === false) {

      $message = 'Congratulations on guessing:' . " " . $this->phrase->current_phrase;
      return $message;

    } else if ($this->checkForWin($playerInput) === false || $this->checkForLose() === true) {

      $message = 'The phrase was:' . " " . $this->phrase->current_phrase . ', Better luck next time!';
      return $message;

    }

  }

  }

  // On-screen keyboard form
  public function displayKeyboard($userinput = []) {

    $keys = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'
            , 'z', 'x', 'c', 'v', 'b', 'n', 'm'];


    $html = "<form action='play.php' method='POST'>";

    $html .= "<div id='qwerty' class='section'>";

    foreach($keys as $key) {
      // if the key is pressed -> disable the button.
      if (in_array($key, $userinput)) {

        if ($key == 'q' || $key == 'a' || $key == 'z') {
          $html .= '<div class="keyrow">';
        }

        $html .= "<button class='key' style='background-color: red' disabled>$key</button>";

        if ($key == 'p' || $key == 'l' || $key == 'm') {
          $html .= '</div>';
        }
      // if the key is not pressed -> do not disable the button.
      } else {
          if ($key == 'q' || $key == 'a' || $key == 'z') {
            $html .= '<div class="keyrow">';
          }

          $html .= "<button class='key' name='key-input-$key' type='submit'>$key</button>";

          if ($key == 'p' || $key == 'l' || $key == 'm') {
            $html .= '</div>';
          }

        }

      }

    $html .= '</div>';

    return $html;

  }

  // A function that displays the score
  public function displayScore($current_life) {

  $html = '<div id="scoreboard" class="section"><ol>';

  $star = 1;

    while ($star <= 5) {
      if ($current_life >= $star) {
        $html .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
      } else {
        $html .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
      }
      $star++;
    }

  $html .= '</ol></div>';
  return $html;

  }

}

?>
