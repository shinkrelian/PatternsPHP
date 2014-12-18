<?php

abstract class AbstractObserver {
    abstract function update(AbstractSubject $subject_in);
}

abstract class AbstractSubject {
    abstract function attach(AbstractObserver $observer_in);
    abstract function detach(AbstractObserver $observer_in);
    abstract function notify();
}

function writeln($line_in) {
    echo $line_in."\n";
}

class PatternObserver extends AbstractObserver {
    
	public function __construct() {
    }

    public function update(AbstractSubject $subject) {
      writeln(' nuevos patrones favoritos: '.$subject->getFavorites());
    }
}

class PatternSubject extends AbstractSubject {
    private $favoritePatterns = NULL;
    private $observers = array();
    
    function __construct() {
    }
    
    function attach(AbstractObserver $observer_in) {
      $this->observers[] = $observer_in;
    }

    function detach(AbstractObserver $observer_in) {
      foreach($this->observers as $okey => $oval) {
        if ($oval == $observer_in) { 
          unset($this->observers[$okey]);
        }
      }
    }
    
    function notify() {
      foreach($this->observers as $obs) {
        $obs->update($this);
      }
    }
    
    function updateFavorites($newFavorites) {
      $this->favorites = $newFavorites;
      $this->notify();
    }
    
    function getFavorites() {
      return $this->favorites;
    }
}

  $patternGossiper = new PatternSubject();
  $patternGossipFan = new PatternObserver();
  
  $patternGossiper->attach($patternGossipFan);
  $patternGossiper->updateFavorites('singleton, decorator, state');
  $patternGossiper->updateFavorites('singleton, observer, decorator');
  
  $patternGossiper->detach($patternGossipFan);
  $patternGossiper->updateFavorites('singleton, observer, strategy');

?>