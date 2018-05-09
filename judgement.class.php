<?php

Class Jadgement 
{
    private $_messages = [];
    public function bustOrBlackjack($points, $name) {
        if ($points == $this->__max) {
            $this->__messages[] = 'BlackJack!!!!';
            $this->__messages[] = $name . 'の勝ちです！！';
            $this->__messages[] = NEWGAME;
        } elseif ($points > $this->__max) {
            $this->__messages[] = 'バーストしました！！';
            $this->__messages[] = $name . 'の負けです！！';
            $this->__messages[] = NEWGAME;
            return $this->__messages;
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
        $this->__messages[] = NEWGAME;
        return $this->__messages;

    }
}