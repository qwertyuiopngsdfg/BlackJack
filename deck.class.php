<?php

Class CreateDeck {

    private $_cards = [];
    private $_faces = [2,3,4,5,6,7,8,9,10,'J','Q','K','A'];
    private $_ranks = ['Club', 'Diamond', 'Heart', 'Spade'];

    public function __construct() {
        foreach ($this->_ranks as $rank) {
            foreach ($this->_faces as $face) {
                $this->_cards[] = $rank . 'の' . $face;
            }
        }
    }

    public function shuffleDeck() {
        shuffle($this->_cards);
        return $this->_cards;
    }

}
