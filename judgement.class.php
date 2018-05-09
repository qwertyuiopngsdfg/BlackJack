<?php

Class Jadgement 
{
    private $_messages = [];
    public function bustOrBlackjack($points, $name) {
<<<<<<< HEAD
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
=======
        if ($points == $this->__max) {
            $this->__messages[] = 'BlackJack!!!!';
            $this->__messages[] = $name . 'の勝ちです！！';
            $this->__messages[] = NEWGAME;
        } elseif ($points > $this->__max) {
            $this->__messages[] = 'バーストしました！！';
            $this->__messages[] = $name . 'の負けです！！';
            $this->__messages[] = NEWGAME;
            return $this->__messages;
>>>>>>> 32aca6099927f561d4acfa8322d9060300e43179
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
<<<<<<< HEAD
        $this->_messages[] = NEWGAME;
        return $this->_messages;
=======
        $this->__messages[] = NEWGAME;
        return $this->__messages;
>>>>>>> 32aca6099927f561d4acfa8322d9060300e43179
    }
}