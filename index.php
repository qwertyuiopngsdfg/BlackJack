<?php

require_once('functions.php');
$u_score = 0;

?>
<html lang="ja">
<head>
    <title>Blackack</title>
</head>
<body>
    <h1>BlackJack</h1>
    <p>あなたの引いたカードは<?= $deck[0]; preg_match("/[0-9]+/", $deck[0], $num) ? $u_score += intval($num[0]) : $u_score += 10;?>です。</p>
    <p>あなたの引いたカードは<?= $deck[1]; preg_match("/[0-9]+/", $deck[1], $num) ? $u_score += intval($num[0]) : $u_score += 10;?>です。</p>
    <p>ディーラーの引いたカードは<?= $deck[2];?>です。</p>
    <p>ディーラーの2枚目のカードはわかりません</p>
    <p>あなたの合計得点は<?= $u_score; ?>です。</p>
    <form action="duel.php" method="post">
        <p>カードをひきますか？</p>
        <input type="radio" name="draw" value="yes">yes
        <input type="radio" name="draw" value="no" checked>no
        <input type="hidden" name="filename" value="<?= $file_name ?>">
        <input type="hidden" name="draw_count" value="4">
        <input type="submit">
    </form>
</body>
</html>