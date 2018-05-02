<?php

require_once('config.php');

$file_name = $_POST['filename'];
$file_handler = fopen($file_name, "r");
$deck = fgetcsv($file_handler, 1000, ",");
$k = $_POST['draw_count']; //現在までデッキをドローした総数;
$k = intval($k);
$draw_confirm = $_POST['draw'];
//user draw
for ($i = 0; $i < $k; $i++) {
    if ($i == 0 && $draw_confirm == 'no') {
        $k -= 2;
    }
    if ($i == 2) {
        $i = 4;
    }
    $user_card[] = $i;
    if(strstr($deck[$i], 'A')) {
        $user_score >= 11 ? $user_score += 1 : $user_score += 11;
        $user_ace += 1;
    } elseif (preg_match("/[0-9]+/", $deck[$i], $num)) {
        $user_score += intval($num[0]);
    } else {
        $user_score += 10;
    }
    if ($user_score > 21 && !$user_ace == 0) {
        $user_score -= 10;
        $user_ace -= 1;
    }
    if ($user_score > 21) {
        $message = "ユーザーがバーストしました。</br>△ディーラーの勝ちです。△";
        $i = $k;
    }
    if ($user_score == 21) {
        $message = "ブラックジャック！</br>△あなたの勝ちです△";
        $i = $k;
    }
}
//dealer draw
if ($draw_confirm == 'no' && !isset($message)) {
    for ($i = 2; $dealer_score < 17; $i++) {
        if ($i == 4) {
            $i = $k + 1;
        }
        $dealer_card[] = $i;
        if(strstr($deck[$i], 'A')) {
            $dealer_score >= 11 ? $user_score += 1 : $dealer_score += 11;
            $dealer_ace += 1;
        } elseif(preg_match("/[0-9]+/", $deck[$i], $num)) {
            $dealer_score += intval($num[0]);
        } else {
            $dealer_score += 10;
        }
        if ($user_score > 21 && !$user_ace = 0) {
            $dealer_score -= 10;
            $dealer_ace -= 1;
        }
    }
    if ($dealer_score > 21) {
        $message = "ディーラーがバーストしました。</br>△あなたの勝ちです△";
    }
}

if (!isset($message) && $user_score > $dealer_score) {
    $judge = '△あなたの勝ちです△';
} elseif (!isset($message) && $dealer_score > $user_score) {
    $judge = '△ディーラーの勝ちです。△';
} elseif (!isset($message) && $dealer_score == $user_score) {
    $judge = '△引き分けです。△';
}

?>

<html lang="ja">
<head>
    <title>Blackack</title>
</head>
<body>
    <h1><a href="/">Blackack</a></h1>
    <?php foreach ($user_card as $num) : ?>
        <p>あなたの引いたカードは<?= $deck[$num]; ?>です。</p>
    <?php endforeach; ?>
    <?php if ($draw_confirm == 'yes') : ?>
        <p>ディーラーの引いたカードは<?= $deck[2]; ?>です。</p>
        <p>ディーラーの2枚目のカードはわかりません。</p>
        <p><?= 'あなたの合計得点は' . $user_score . 'です。'; ?></p>
    <?php else : ?>
        <?php foreach ($dealer_card as $num) : ?>
            <p>ディーラーの引いたカードは<?= $deck[$num]; ?>です。</p>
        <?php endforeach; ?>
        <p><?= 'あなたの合計得点は' . $user_score . 'です。'; ?></p>
        <p><?= 'ディーラーの合計得点は' . $dealer_score . 'です。'; ?></p>
    <?php endif; ?>
    <?php if (isset($message)) : ?>
        <p><?= $message; ?></p>
    <?php elseif (isset($judge) && $draw_confirm == 'no') : ?>
        
        <p><?= $judge; ?></p>
    <?php else : ?>
        <form action="duel.php" method="post">
            <p>カードをひきますか？</p>
            <input type="radio" name="draw" value="yes" checked>yes
            <input type="radio" name="draw" value="no">no
            <input type="hidden" name="filename" value="<?= $file_name; ?>">
            <input type="hidden" name="draw_count" value="<?= $k + 1; ?>">
            <input type="submit">
        </form>
    <?php endif; ?>
</body>
</html>