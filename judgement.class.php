<?php

Class Jadgement 
{
    private $_messages = [];
    public function bustOrBlackjack($points, $name) {
        if ($points == MAXVALUE) {
            $this->_messages[] = 'BlackJack!!!!';
            $this->_messages[] = $name . 'の勝ちです！！';
            $this->_messages[] = NEWGAME;
            return $this->_messages;
        } elseif ($points > MAXVALUE) {
            $this->_messages[] = 'バーストしました！！';
            $this->_messages[] = $name . 'の負けです！！';
            $this->_messages[] = NEWGAME;
            return $this->_messages;
        }
    }

    public function checkTheWinner($user_point, $com_point) {
        if ($user_point == $com_point) {
            $this->_messages[] = '引き分けです！！';
        } elseif ($user_point > $com_point) {
            $this->_messages[] = 'あなたの勝ちです！！';
        } else {
            $this->_messages[] = 'CPUの勝ちです！！';
        }
        $this->_messages[] = NEWGAME;
        return $this->_messages;
    }
}