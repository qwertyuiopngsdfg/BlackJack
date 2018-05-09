<?php

Class Game 
{
    public function startGame() {
        $__messages = [];
        $__messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][0] . 'です';
        $__messages[] = 'あなたの引いたカードは' . $_SESSION['deck'][1] . 'です';
        $__messages[] = 'CPUの引いたカードは' . $_SESSION['deck'][2] . 'です。';
        $__messages[] = 'CPUの2枚目に引いたカードはわかりません。';
        return $__messages;
    }

    public function firstDraw() {
        $__cards = [];
        $i = 0;
        while (1 >= $i) {
            if(preg_match("/[0-9]+/", $_SESSION['deck'][$i], $num)) {
                $__cards[] = $num[0];
            } else {
                $__cards[] = substr($_SESSION['deck'][$i], -1);
            }
            $i++;
        }
        return $__cards;
    }

    public function nextDraw() {
        if(preg_match("/[0-9]+/", $_SESSION['deck'][0], $num)) {
            $__card = $num[0];
        } else {
            $__card = substr($_SESSION['deck'][0], -1);
        }
        return $__card;
    }

    public function showCard($name) {
        $__message = $name . 'の引いたカードは' . $_SESSION['deck'][0] . 'です';
        return $__message;
    }

    public function totalPoints($hand) {
        $__points = 0;
        $__ace = 0;
        foreach ($hand as $card) {
            switch ($card) {
                case 'J':
                    $__points += 10;
                    break;
                case 'Q':
                    $__points += 10;
                    break;
                case 'K':
                    $__points += 10;
                    break;
                case 'A':
                    $__points += 11;
                    $__ace += 1;
                    break;
                default:
                    $__points += intval($card);
                    break;
            }
        }
        if ($__points > 21 && $__ace >= 1) {
            $__points -= 10;
        }
        return $__points;
    }
}