<?php

$file_name = $_POST['filename'];
$file_handler = fopen($file_name, "r");
$deck = fgetcsv($file_handler, 1000, ",");
$i = 0;
$k = $_POST['draw_count'];
$k = intval($k);
if ($_POST['draw'] == 'yes') {
    $j = $k - 3;
    var_dump($j);
} else {
    $j = $k - 4;
}
?>

<html lang="ja">
<head>
    <title>Blackack</title>
</head>
<body>
    <h1>BlackJack</h1>
    <p>あなたの引いたカードは<?= $deck[0]; preg_match("/[0-9]+/", $deck[0], $num); $u_point[0] = intval($num[0]);?>です。</p>
    <p>あなたの引いたカードは<?= $deck[1]; preg_match("/[0-9]+/", $deck[1], $num); $u_point[1] = intval($num[0]);?>です。</p>
    <?php $u_score = $u_point[0] + $u_point[1]; ?>
    <?php for ($count=0; $count < $j; $count++) : ?>
        <p>あなたの引いたカードは<?= $deck[$k]; preg_match("/[0-9]+/", $deck[$k], $num); $u_score += intval($num[0]); $k++;?>です。</p>
    <?php endfor; ?>
    <p>ディーラーの引いたカードは<?= $deck[2]; preg_match("/[0-9]+/", $deck[2], $num);$d_point[0] = intval($num[0]);?>です。</p>
    <p>ディーラーの2枚目のカードはわかりません。<?php preg_match("/[0-9]+/", $deck[3], $num);$d_point[1] = intval($num[0]); ?></p>
    <?= 'ユーザーの合計得点は' . $u_score . 'です。' ?>
    <?php if ($u_score > 21) : ?>
        <p>バーストしました。</p>
        <p>△ディーラーの勝ちです△</p>
        <p>ブラックジャック終了！また遊んでね！！</p>
        <?php exit; ?>
    <?php elseif ($u_score == 21) : ?>
        <p>ブラックジャック！！</p>
        <p>△プレイヤーの勝ちです△</p>
        <p>ブラックジャック終了！また遊んでね！！</p>
        <?php exit; ?>
    <?php endif; ?>
    <form action="duel.php" method="post">
        <p>カードをひきますか？</p>
        <input type="radio" name="draw" value="yes">yes
        <input type="radio" name="draw" value="no">no
        <input type="hidden" name="filename" value="<?= $file_name; ?>">
        <input type="hidden" name="draw_count" value="<?= $k; ?>">
        <input type="submit">
    </form>
</body>
</html>