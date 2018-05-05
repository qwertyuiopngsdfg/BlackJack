<?php

require_once('deck.class.php');
require_once('game.class.php');

session_start();
$ceatedeck = new CreateDeck;
$_SESSION['deck'] = $ceatedeck->shuffleDeck();
$game = new Game;
$messages = $game->startGame();
$_SESSION['user_hand'] = $game->firstDraw();
array_splice($_SESSION['deck'], 0, 2);
$_SESSION['dealer_hand'] = $game->firstDraw();
array_splice($_SESSION['deck'], 0, 2);
$user_points = $game->totalPoints($_SESSION['user_hand']);

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
    <h1><a href="/">Blackack</a></h1>
    <?php foreach ($messages as $msg) : ?>
    <p><?= $msg ?></p>
    <?php endforeach; ?>
    <p>あなたの合計得点は<?= $user_points ?>です。</p>
    <p>カードをひきますか？</p>
    <form action="duel.php" method="post">
        <input type="radio" name="draw" value="yes" checked>yes
        <input type="radio" name="draw" value="no">no
        <input type="hidden" name="filename" value="">
        <input type="hidden" name="draw_count" value="4">
        <input type="submit">
    </form>
</body>
</html>