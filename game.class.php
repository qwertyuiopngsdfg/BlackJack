<?php

Class Game 
{
    private $_deck = [];
    private $_messages = [];
    private $_message;
    private $_cards = [];
    private $_card;
    private $_points = 0;
    private $_ace = 0;
    private $_hand;

    public function startGame() {
        $this->_messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][0] . 'です';
        $this->_messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][1] . 'です';
        $this->_messages[] = 'コンピュータの引いたカードは' . $_SESSION['deck'][2] . 'です。';
        $this->_messages[] = 'コンピュータの2枚目に引いたカードはわかりません。';
        return $this->_messages;
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

    public function nextDraw() {
        if(preg_match("/[0-9]+/", $_SESSION['deck'][0], $num)) {
            $this->_card = $num[0];
        } else {
            $this->_card = substr($_SESSION['deck'][0], -1);
        }
        return $this->_card;
    }

    public function showCard() {
        $this->_message = 'あなたの引いたカードは' . $_SESSION['deck'][0] . 'です';
        return $this->_message;
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