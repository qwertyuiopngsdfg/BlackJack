<?php

Class Game {
    public $_messages = [];
    public function startGame($deck) {
        for ($i=0; $i<4; $i++) {
            switch ($i) {
                case 2 :
                    $_messages[] = 'コンピュータの引いたカードは' . $deck[$i] . 'です。';
                    break;
                case 3 :
                    $_messages[] = 'コンピュータの2枚目に引いたカードはわかりません。';
                    break;
                default :
                    $_messages[] = 'あなたの引いたカードは' . $deck[$i] . 'です';
                    break;
            }
        }
        return $_messages;
    }
}