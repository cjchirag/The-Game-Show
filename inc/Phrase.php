<?php

// A collection to store phrases.

                /*
                'Only time will tell', 'In the nick of time', 'Lost track of time', 'Lasted an eternity',
                                'Just a matter of time', 'A waste of time', 'Time flies', 'In a jiffy', 'The time of my life',
                                'At the speed of light'
                */

$all_phrases = ['You are loved', 'You are the best', 'You got this'];

class Phrase {
  public $phrase;
  public $selected;


  public function __construct($phrase = '', $selected = []) {

    $all_phrases = ['You are loved', 'You are the best', 'You got this'];

    if ($phrase === '') {
        $this->phrase = strtolower($phrase);
    } else {
        // if phrase is not passed, this function randomly sets the phrase from the collection of phrases.
        $this->phrase = strtolower($all_phrases[mt_rand(0, count($all_phrases)-1)]);
    }

    $this->selected_letters = $selected;

  }

  public function addPhraseToDisplay($inputs = []) {

    $count = 0;
    $list_items = '';

    // tp show: $list_items .= "<li class='show letter " . $this->selected_letters[$count] . "'>" . $this->selected_letters[$count] . "</li>";
    // To hide letter :  $list_items .= "<li class='hide letter " . $this->selected_letters[$count] . "'>" . $this->selected_letters[$count] . "</li>";
    // To hide space  $list_items .= "<li class='hide space'> </li>";
    // return '<div id="phrase" class="section"><ul>' . $list_items . '</ul></div>'

    $letters = str_split($this->phrase);

    foreach ($letters as $correct_value) {

      if ($correct_value === ' ') {
        $list_items .= "<li class='hide space'> </li>";
      } else {

            if (in_array($correct_value, $inputs)) {
            $list_items .= "<li class='show letter " . $correct_value . "'>" . $correct_value . "</li>";
          } else {
            $list_items .= "<li class='hide letter " . $correct_value . "'>" . $correct_value . "</li>";
          }

      }

    }

    return '<div id="phrase" class="section"><ul>' . $list_items . '</ul></div>';

  }

  public function checkLetter(String $input) {
    $letters = str_split($this->phrase);
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
