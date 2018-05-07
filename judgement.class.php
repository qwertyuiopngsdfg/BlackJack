<?php

Class Jadgement 
{
    private $__max = 21;
    private $__messages = [];
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
            $this->__messages[] = '引き分けです！！';
        } elseif ($user_point > $com_point) {
            $this->__messages[] = 'あなたの勝ちです！！';
        } else {
            $this->__messages[] = 'CPUの勝ちです！！';
        }
        $this->__messages[] = NEWGAME;
        return $this->__messages;
    }
}