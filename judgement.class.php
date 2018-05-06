<?php

Class Jadgement {
    private $__max = 21;
    private $__message = [];
    public function blackJack($points, $name) {
        if ($points == $this->__max) {
            $this->__message[] = 'BlackJack!!!!';
            $this->__message[] = $name . 'の勝ちです！！';
            $this->__message[] = "<form action='' method='post'>";
            $this->__message[] = "<input type='submit' name='button' value='newgame'>";
            $this->__message[] = "</form>";
            return $this->__message;
        }
        return false; 
    }
}