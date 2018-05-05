<?php

Class Deck {
    private $_cards = array();
    private $_faces = [2,3,4,5,6,7,8,9,10,'J','Q','K','A'];
    private $_ranks = ['Club', 'Diamond', 'Heart', 'Spade'];
    public function __construct() {
        foreach ($this->_ranks as $rank) {
            foreach ($this->_faces as $face) {
                $cards[] = $rank . 'の' . $face;
            }
            
        }
    }

    public function CreateDeck() {
        shuffle($this->cards);
        return $this->cards;
    }
}
