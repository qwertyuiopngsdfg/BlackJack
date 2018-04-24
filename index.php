<?php
require_once('functions.php');

?>
<html lang="ja">
<head>
    <title>BlackJack</title>
</head>
<body>
    <h1>BlackJack</h1>
    <p>あなたの引いたカードはスペードの6です。</p>
    <p>あなたの引いたカードはダイヤの4です。</p>
    <p>ディーラーの引いたカードはクラブの２です。</p>
    <p>ディーラーの2枚目のカードはわかりません。</p>
    <form action="index.php">
        <p>カードをひきますか？</p>
        <input type="radio" name="draw" value="yes">yes
        <input type="radio" name="draw" value="no">no
        <input type="submit">
    </form>
    <p>あなたの引いたカードはクラブの9です。</p>
    <p>あなたの合計得点は18です。</p>
    <p>カードを引きますか？</p>
    <p>あなたの合計得点は18です。</p>
    <p>ディーラーの2枚目のカードはクラブの8です。</p>
    <p>ディーラーの3枚目のカードは７です。</p>
    <p>ディーラーの合計得点は17です。</p>
    <p>△プレイヤーの勝ちです△</p>
    <p>ブラックジャック終了！また遊んでね！！</p>
</body>
</html>

