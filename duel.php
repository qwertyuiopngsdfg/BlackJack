<?php

$file_name = $_POST['filename'];
$file_handler = fopen($file_name, "r");
$deck = fgetcsv($file_handler, 1000, ",");
$u_score = 0;
$d_score = 0;
$k = $_POST['draw_count']; //現在までデッキをドローした総数;
$k = intval($k);
$draw_confirm = $_POST['draw'];
if ($draw_confirm == 'yes') {
    $i = $k - 3;
} else {
    $i = $k - 4;
}
$j = 4;
?>

<html lang="ja">
<head>
    <title>Blackack</title>
</head>
<body>
    <h1>BlackJack</h1>
    <?php if ($draw_confirm == 'no') : ?>
        <p>あなたの引いたカードは<?= $deck[0]; preg_match("/[0-9]+/", $deck[0], $num) ? $u_score += intval($num[0]) : $u_score += 10;?>です。</p>
        <p>あなたの引いたカードは<?= $deck[1]; preg_match("/[0-9]+/", $deck[1], $num) ? $u_score += intval($num[0]) : $u_score += 10;?>です。</p>
        <?php for ($count=0; $count < $i; $count++) : ?>
            <p>あなたの引いたカードは<?= $deck[$j]; preg_match("/[0-9]+/", $deck[$j], $num) ? $u_score += intval($num[0]) : $u_score += 10; $j++; $k++;?>です。</p>
        <?php endfor; ?>
        <?= 'ユーザーの合計得点は' . $u_score . 'です。' ?>
        <p>ディーラーの引いたカードは<?= $deck[2]; preg_match("/[0-9]+/", $deck[2], $num) ? $d_score += intval($num[0]) : $d_score += 10; ?>です。</p>
        <p>ディーラーの引いたカードは<?= $deck[3]; preg_match("/[0-9]+/", $deck[3], $num) ? $d_score += intval($num[0]) : $d_score += 10; ?>です。</p>
        <?php while ($d_score < 17) : ?>
            <p>ディーラーの引いたカードは<?= $deck[$j]; preg_match("/[0-9]+/", $deck[$j], $num) ? $d_score += intval($num[0]) : $d_score += 10; $j++;?>です。</p>
            <?php if ($d_score > 17) break; ?>
        <?php endwhile; ?>
        <?php if ($d_score > 21) : ?>
        <?= 'ディーラーの合計得点は' . $d_score . 'です。' ?>
        <p>ディーラーがバースト！！</p>
        <p>△プレイヤーの勝ちです。△</p>
        <?php exit; ?>
        <?php endif; ?> 
        <?= 'ディーラーの合計得点は' . $d_score . 'です。' ?>
        <?php if ($u_score > $d_score) : ?>
            <p>△プレイヤーの勝ちです△</p>
            <p>ブラックジャック終了！また遊んでね！！</p>
            <?php exit; ?>
        <?php elseif ($u_score == $d_score) : ?>
            <p>△引き分けです△</p>
            <p>ブラックジャック終了！また遊んでね！！</p>
            <?php exit; ?>
        <?php endif; ?>
        <p>△ディーラーの勝ちです△</p>
        <p>ブラックジャック終了！また遊んでね！！</p>
        <?php exit; ?>
    <?php endif; ?>
    <p>あなたの引いたカードは<?= $deck[0]; preg_match("/[0-9]+/", $deck[0], $num) ? $u_score += intval($num[0]) : $u_score += 10;?>です。</p>
    <p>あなたの引いたカードは<?= $deck[1]; preg_match("/[0-9]+/", $deck[1], $num) ? $u_score += intval($num[0]) : $u_score += 10;?>です。</p>
    <?php for ($count=0; $count < $i; $count++) : ?>
        <p>あなたの引いたカードは<?= $deck[$j]; preg_match("/[0-9]+/", $deck[$j], $num) ? $u_score += intval($num[0]) : $u_score += 10; $j++; $k++;?>です。</p>
    <?php endfor; ?>
    <p>ディーラーの引いたカードは<?= $deck[2];?>です。</p>
    <p>ディーラーの2枚目のカードはわかりません。</p>
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