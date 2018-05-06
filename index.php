<?php

require_once('deck.class.php');
require_once('game.class.php');
require_once('judgement.class.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $button =$_POST['button'];
    $game = new Game;
    $judge = new Jadgement;
    switch ($button) {
        case 'newgame':
            $ceatedeck = new CreateDeck;
            $_SESSION['deck'] = $ceatedeck->shuffleDeck();
            $_SESSION['messages'] = $game->startGame();
            $_SESSION['user_hand'] = $game->firstDraw();
            array_splice($_SESSION['deck'], 0, 2);
            $_SESSION['dealer_hand'] = $game->firstDraw();
            array_splice($_SESSION['deck'], 0, 2);
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            $judgement = $judge->blackJack($user_points, 'あなた');
            break;
        case 'draw':
            $message = $game->showCard();
            array_push($_SESSION['messages'], $message);
            $draw_card = $game->nextDraw();
            array_push($_SESSION['user_hand'], $draw_card);
            array_splice($_SESSION['deck'], 0, 1);
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            break;
        case 'stop':

            break;
        default :
            echo 'error';
            exit;
    }
} else {
    echo "<form action='' method='post'>";
    echo "<input type='submit' name='button' value='newgame'>";
    echo "</form>";
    exit;
}


/*
//user draw
for ($i=0; $i < 2; $i++) {
    if(strstr($deck[$i], 'A')) {
        $user_score >= 11 ? $user_score += 1 : $user_score += 11;
        $user_ace += 1;
    } elseif(preg_match("/[0-9]+/", $deck[$i], $num)) {
        $user_score += intval($num[0]);
    } else {
        $user_score += 10;
    }
}

if ($user_score > 21 && !$user_ace == 0) {
    $user_score -= 10;
    $user_ace  -= 1;
}
if ($user_score == 21) { $message = 'ブラックジャック！！あなたの勝ちです。'; }
*/
?>
<html lang="ja">
<head>
    <title>BlackJack</title>
</head>
<body>
    <h1>Blackack</h1>
    <?php foreach ($_SESSION['messages'] as $msg) : ?>
    <p><?= $msg ?></p>
    <?php endforeach; ?>
    <p>あなたの合計得点は<?= $user_points ?>です。</p>
    <?php if ($judgement) : ?>
    <?php foreach ($judgement as $row) : ?>
    <p><?= $row ?></p>
    <?php endforeach ?>
    <?php else : ?>
    <p>カードをひきますか？</p>
    <form action='' method='post'>
        <input type='submit' name='button' value='newgame'>
        <input type='submit' name='button' value='draw'>
        <input type='submit' name='button' value='stop'>
    </form>
    <?php endif; ?>
</body>
</html>