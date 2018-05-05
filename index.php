<?php

session_start();

require_once('functions.php');

$new_game = new NewGame;
$deck = $new_game->CreateDeck();

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

?>
<html lang="ja">
<head>
    <title>BlackJack</title>
</head>
<body>
    <h1><a href="/">Blackack</a></h1>
    <p>あなたの引いたカードは<?= $deck[0]; ?>です。</p>
    <p>あなたの引いたカードは<?= $deck[1]; ?>です。</p>
    <p>ディーラーの1枚目のカードは<?= $deck[2]; ?>です。</p>
    <p>ディーラーの2枚目のカードはわかりません。</p>
    <p>あなたの合計得点は<?= $user_score ?>です。</p>
    <?php if(!isset($message)) : ?>
    <p>カードをひきますか？</p>
    <form action="duel.php" method="post">
        <input type="radio" name="draw" value="yes" checked>yes
        <input type="radio" name="draw" value="no">no
        <input type="hidden" name="filename" value="<?= $file_name ?>">
        <input type="hidden" name="draw_count" value="4">
        <input type="submit">
    </form>
    <?php else : ?>
    <p><?= $message ?></p>
    <?php endif; ?>
</body>
</html>