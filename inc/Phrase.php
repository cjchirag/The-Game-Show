<?php

$all_phrases = ['Only time will tell', 'In the nick of time', 'Lost track of time', 'Lasted an eternity',
                'Just a matter of time', 'A waste of time', 'Time flies', 'In a jiffy', 'The time of my life',
                'At the speed of light'];


class Phrase {
  public $current_phrase;
  public $selected_letters;


  public function __construct($current_phrase) {
    $this->current_phrase = $current_phrase;
    $this->selected_letters = $this->setSelectedLetters($current_phrase);
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
    $start = 0;
    $end = 1;
    $letters = str_split($phrase);
    return $letters;
  }/*
    while ($end<=strlen($phrase)) {
      $letter = substr($phrase, $start, $end);
      $letters[] = $letter;
      $end++;
      $start++;
    }
    */

}
