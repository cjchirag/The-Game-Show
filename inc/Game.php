<?php


class Game {
  protected $phrase;
  protected $lives;

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

  public function getLives () {
    return $this->lives;
  }

  public function setLives (Int $life) {
    $this->lives = $life;
  }


  // A function that checks if the player has selected all the letters.
  public function checkForWin($playerInput) {
    $bool = false;

    foreach ($this->phrase->selected_letters as $correct_letters) {
      foreach ($playerInput as $input) {
        if ($correct_letters === $input) {
          $bool = true;
        } else {
          $bool = false;
        }
      }
    }

    return $bool;
  }

  // A function that checks if the player has guessed too many wrongs.
  public function checkForLose() {

    if ($this->lives === 0) {
      return true;
    } else {
      return false;
    }

  }

  // A function that displays one message: Whether they won or lost. Or the function returns false if not won or lost.
  public function gameOver($playerInput = []) {

  $message = '';

  if ($playerInput != []) {
    if ($this->checkForWin($playerInput) && $this->checkForLose() != true) {
      $message = 'Congratulations on guessing:' . " " . $this->phrase->current_phrase;
    } else // if ($this->checkForWin($playerInput) === false && $this->checkForLose() === true)
    {
      $message = 'The phrase was:' . " " . $this->phrase->current_phrase . ', Better luck next time!';
    }
  } else {
    return false;
  }

    if ($message != '') {
      return $message;
    } else {
      return false;
    }

  }

  // On-screen keyboard form
  public function displayKeyboard($userinput = []) {

    $keys = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'
            , 'z', 'x', 'c', 'v', 'b', 'n', 'm'];

    $html = "<form action='play.php' method='POST'>";

    $html .= "<div id='qwerty' class='section'>";

    foreach($keys as $key) {

      if (in_array($key, $userinput)) {

        if ($key == 'q' || $key == 'a' || $key == 'z') {
          $html .= '<div class="keyrow">';
        }

        $html .= "<button class='key' style='background-color: red' disabled>$key</button>";

        if ($key == 'p' || $key == 'l' || $key == 'm') {
          $html .= '</div>';
        }

      } else {
          if ($key == 'q' || $key == 'a' || $key == 'z') {
            $html .= '<div class="keyrow">';
          }

          $html .= "<button class='key' value='$key' name='key-input-$key' type='submit'>$key</button>";

          if ($key == 'p' || $key == 'l' || $key == 'm') {
            $html .= '</div>';
          }

        }

      }


    $html .= '</div>';

    return $html;

    /*
    for ($key = 0; $key<count($keys); $key++) {

      if ($keys[$key] == 'q' || $keys[$key] == 'a' || $keys[$key] == 'z') {
        $html .= '<div class="keyrow">';
      }

      foreach ($userinput as $input) {
        if ($input == $keys[$key]) {
          $html .= "<button class='key' style='background-color: red' disabled>" . $keys[$key] . "</button>";

          if ($keys[$key] == 'p' || $keys[$key] == 'l' || $keys[$key] == 'm') {
            $html .= '</div>';
          }

          $key++;

        }
      }

      $html .= "<input type='hidden' name='key-input-$keys[$key]' value=$keys[$key]>";
      $html .= "<button type='submit' class='key'>$keys[$key]</button>";

      if ($keys[$key] == 'p' || $keys[$key] == 'l' || $keys[$key] == 'm') {
        $html .= '</div>';
      }

    }
    */

    /*
    foreach ($keys as $key) {

      if ($key == 'q' || $key == 'a' || $key == 'z') {
        $html .= '<div class="keyrow">';
      }

      foreach ($userinput as $input) {
        if ($input == $key) {
          $html .= "<button class='key' style='background-color: red' disabled>$key</button>";
        }
      }

      $html .= "<input type='hidden' name='key-input-$key' value=$key>";
      $html .= "<button type='submit' class='key'>$key</button>";

      if ($key == 'p' || $key == 'l' || $key == 'm') {
        $html .= '</div>';
      }

    }
    */

      /*
      $html .= '<button class="key">q</button>
      <button class="key">w</button>
      <button class="key">e</button>
      <button class="key">r</button>
      <button class="key" style="background-color: red" disabled>t</button>
      <button class="key">y</button>
      <button class="key">u</button>
      <button class="key">i</button>
      <button class="key">o</button>
      <button class="key">p</button>
      </div>';

            <button class="key">q</button>
            <button class="key">w</button>
            <button class="key">e</button>
            <button class="key">r</button>
            <button class="key" style="background-color: red" disabled>t</button>
            <button class="key">y</button>
            <button class="key">u</button>
            <button class="key">i</button>
            <button class="key">o</button>
            <button class="key">p</button>
        </div>'

    */
    /*
    <div id="qwerty" class="section">
        <div class="keyrow">
            <button class="key">q</button>
            <button class="key">w</button>
            <button class="key">e</button>
            <button class="key">r</button>
            <button class="key" style="background-color: red" disabled>t</button>
            <button class="key">y</button>
            <button class="key">u</button>
            <button class="key">i</button>
            <button class="key">o</button>
            <button class="key">p</button>
        </div>

        <div class="keyrow">
            <button class="key">a</button>
            <button class="key">s</button>
            <button class="key">d</button>
            <button class="key">f</button>
            <button class="key">g</button>
            <button class="key">h</button>
            <button class="key">j</button>
            <button class="key">k</button>
            <button class="key">l</button>
        </div>

        <div class="keyrow">
            <button class="key">z</button>
            <button class="key">x</button>
            <button class="key">c</button>
            <button class="key">v</button>
            <button class="key">b</button>
            <button class="key">n</button>
            <button class="key">m</button>
        </div>
    </div>
    */
  }

  // A function that displays the score
  public function displayScore() {

  $html = '<div id="scoreboard" class="section"><ol>';

    for ($life = 1; $life <= 5; $life++) {
      if ($life <= $this->lives) {
      $html .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
    } else {
      $html .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
      }
  }

  $html .= '</ol></div>';
  return $html;

  }

}






?>
