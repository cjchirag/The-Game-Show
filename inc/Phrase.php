<?php

$all_phrases = ['chirag', 'krish', 'pooja'];

                /*
                'Only time will tell', 'In the nick of time', 'Lost track of time', 'Lasted an eternity',
                                'Just a matter of time', 'A waste of time', 'Time flies', 'In a jiffy', 'The time of my life',
                                'At the speed of light'
                */


class Phrase {
  public $current_phrase;
  public $selected_letters;


  public function __construct($current_phrase) {
    $this->current_phrase = strtolower($current_phrase);
    $this->selected_letters = $this->setSelectedLetters($this->current_phrase);
  }


  public function getCurrentPhrase() {
    return $this->current_phrase;
  }

  public function setCurrentPhrase() {
    $this->current_phrase = $all_phrases[mt_rand(0, count($all_phrases))];
  }

  public function getSelectedLetters() {
    return $this->selected_letters;
  }

  public function setSelectedLetters(String $phrase) {
    $letters = str_split($phrase);
    return $letters;
  }

  public function addPhraseToDisplay($inputs = []) {

    $count = 0;
    $list_items = '';

    // tp show: $list_items .= "<li class='show letter " . $this->selected_letters[$count] . "'>" . $this->selected_letters[$count] . "</li>";
    // To hide letter :  $list_items .= "<li class='hide letter " . $this->selected_letters[$count] . "'>" . $this->selected_letters[$count] . "</li>";
    // To hide space  $list_items .= "<li class='hide space'> </li>";
    // return '<div id="phrase" class="section"><ul>' . $list_items . '</ul></div>'

    foreach ($this->selected_letters as $correct_value) {

      if ($correct_value === ' ') {
        $list_items .= "<li class='hide space'> </li>";
      } else {

            if (in_array($correct_value, $inputs)) {
            $list_items .= "<li class='show letter " . $this->selected_letters[$count] . "'>" . $correct_value . "</li>";
          } else {
            $list_items .= "<li class='hide letter " . $this->selected_letters[$count] . "'>" . $correct_value . "</li>";
          }

      }

    }

    return '<div id="phrase" class="section"><ul>' . $list_items . '</ul></div>';

  }

  public function checkLetter(String $input) {
    $letters = str_split($this->current_phrase);
    $bool = false;

    foreach ($letters as $letter) {
      if ($input === $letter) {

        $bool = true;
        break;
      } else {
        $bool = false;
      }
    }
    return $bool;
  }

}

/*

Raw Logic for when a letter is inputted. When the letter is inputted and even if one letter is present, all will go blue.
// when a letter is selected and is true
} else if ($show != '' && $this->checkLetter($show) == true) {
    $list_items .= "<li class='show letter " . $this->selected_letters[$show] . "'>" . $this->selected_letters[$show] . "</li>";
} /* else if ($show != '' && $this->checkLetter($show) == false) {
    // the letter is wrong
    echo 'Wrong choice bro!!';
    if ($this->selected_letters[$count] != ' ') {
        $list_items .= "<li class='show letter " . $this->selected_letters[$count] . "'>" . $this->selected_letters[$count] . "</li>";
    } else {
        $list_items .= "<li class='hide space'> </li>";
    }
} */
  /*
  <div id="phrase" class="section">
      <ul>
          <li class="hide letter o">o</li>
          <li class="hide letter w">w</li>
          <li class="hide space"> </li>
          <li class="hide letter a">a</li>
          <li class="hide letter r">r</li>
          <li class="hide letter e">e</li>
          <li class="hide space"> </li>
          <li class="hide letter y">y</li>
          <li class="hide letter o">o</li>
          <li class="hide letter u">u</li>
      </ul>
  </div>
  */
