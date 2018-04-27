<?php
$deck = $_POST['deck'];
var_dump($deck);
?>

<html lang="ja">
<head>
    <title>Blackack</title>
</head>
<body>
    <h1>BlackJack</h1>
    <p>あなたの引いたカードは<?= $deck[$i]; preg_match("/[0-9]+/", $deck[$i], $num);$point[$i] = intval($num[0]); $i++;?>です。</p>
    <p>あなたの引いたカードは<?= $deck[$i]; preg_match("/[0-9]+/", $deck[$i], $num);$point[$i] = intval($num[0]); $i++;?>です。</p>
    <p>ディーラーの引いたカードは<?= $deck[$i]; $i++ ?>です。</p>
    <p>ディーラーの2枚目のカードはわかりません。<?php $i++; ?></p>
    <p>あなたの合計得点は<?= $point[0] + $point[1]; ?>です。</p>
    <form action="index.php" method="get">
        <p>カードをひきますか？</p>
        <input type="radio" name="draw" value="yes">yes
        <input type="radio" name="draw" value="no">no
        <input type="hidden" name="deck" value="<?= $deck ?>">
        <input type="submit">
    </form>
    <p>あなたの引いたカードはクラブの9です。</p>
    <p>カードを引きますか？</p>
    <p>あなたの合計得点は18です。</p>
    <p>ディーラーの2枚目のカードはクラブの8です。</p>
    <p>ディーラーの3枚目のカードは７です。</p>
    <p>ディーラーの合計得点は17です。</p>
    <p>△プレイヤーの勝ちです△</p>
    <p>ブラックジャック終了！また遊んでね！！</p>
</body>
</html>