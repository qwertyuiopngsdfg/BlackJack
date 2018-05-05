<?php

Class Game 
{
    public $_deck = [];
    public $_messages = [];
    public $_cards = [];
    public $_points = 0;
    public $_ace = 0;
    public $_hand;

    public function startGame() {
        $this->_messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][0] . 'です';
        $this->_messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][1] . 'です';
        $this->_messages[] = 'コンピュータの引いたカードは' . $_SESSION['deck'][2] . 'です。';
        $this->_messages[] = 'コンピュータの2枚目に引いたカードはわかりません。';
        
        return $this->_messages;
        /*for ($i=0; $i<4; $i++) {
            switch ($i) {
                case 2 :
                   $ _messages[] = 'コンピュータの引いたカードは' . $_SESSION['deck'][$i] . 'です。';
                    break;
                case 3 :
                    $_messages[] = 'コンピュータの2枚目に引いたカードはわかりません。';
                    break;
                default :
                    $_messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][$i] . 'です';
                    break;
            }
        }
        */
    }

    public function firstDraw() {
        $i = 0;
        while ($i <= 1) {
            if(preg_match("/[0-9]+/", $_SESSION['deck'][$i], $num)) {
                $this->_cards[] = $num[0];
            } else {
                $this->_cards[] = substr($_SESSION['deck'][$i], -1);
            }
            $i++;
        }
        return $this->_cards;
    }

    public function totalPoints($hand) {
        foreach ($hand as $card) {
            switch ($card) {
                case 'J':
                    $this->_points += 10;
                    break;
                case 'Q':
                    $this->_points += 10;
                    break;
                case 'K':
                    $this->_points += 10;
                    break;
                case 'A':
                    $this->_points += 11;
                    $this->_ace += 1;
                    break;
                default:
                    $this->_points += intval($card);
                    break;
            }
        }
        if ($this->_points > 21 && $this->_ace >= 1) {
            $this->_points -= 10;
        }
        return $this->_points;
    }
}