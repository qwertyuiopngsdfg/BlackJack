<?php
define('NEWGAME', "<form action='' method='post'><input type='submit' name='button' value='newgame'></form>");
require_once('deck.class.php');
require_once('game.class.php');
require_once('judgement.class.php');
define('MAXVALUE', 21);
define('NEWGAME', "<form action='' method='post'><input type='submit' name='button' value='newgame'></form>");


session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $button =$_POST['button'];
    $game = new Game;
    $judge = new Jadgement;
    switch ($button) {
        case 'newgame':
            $ceatedeck = new CreateDeck;
            $_SESSION['deck'] = $ceatedeck->shuffleDeck();
            $_SESSION['messages'] = $game->startGame();//ユーザー2枚。CPUも2枚ドロー　CPUの2枚目のカードは非公開にする。
            $_SESSION['user_hand'] = $game->firstDraw(); //ユーザーが2枚ドロー、手札に加える
            array_splice($_SESSION['deck'], 0, 2); //デッキからドローしたカードを除外する
            $_SESSION['cpu_hand'] = $game->firstDraw();
            $_SESSION['secret_card'] = $_SESSION['deck'][1];//CPUが2枚目にドローした非公開のカードを保存。
            array_splice($_SESSION['deck'], 0, 2);
            $user_points = $game->totalPoints($_SESSION['user_hand']);//手札のカードの合計得点を算出する。
            $judgement = $judge->bustOrBlackjack($user_points, 'あなた');//21と同点、もしくは21以上になってないか判定する。
            $_SESSION['messages'][] = 'あなたの得点は:' . $user_points;
            break;
        case 'draw':
            $_SESSION['messages'][] = $game->showCard('あなた');
            $_SESSION['user_hand'][] = $game->nextDraw();
            array_splice($_SESSION['deck'], 0, 1);
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            $judgement = $judge->bustOrBlackjack($user_points, 'あなた');
            $_SESSION['messages'][] = 'あなたの得点は:' . $user_points;
            break;
        case 'stop':
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            $cpu_points = $game->totalPoints($_SESSION['cpu_hand']);
            $_SESSION['messages'][] = 'CPUの2枚目のカードは' . $_SESSION['secret_card'] . 'でした';
            $judgement = $judge->bustOrBlackjack($cpu_points, 'CPU');
            if (empty($judgement) && $cpu_points < 17) {
                for ($i=0; $cpu_points < 17; $i++) {
                    $_SESSION['messages'][] = $game->showCard('CPU');
                    $_SESSION['cpu_hand'][] = $game->nextDraw();
                    array_splice($_SESSION['deck'], 0, 1);
                    $cpu_points = $game->totalPoints($_SESSION['cpu_hand']);
                }
                $_SESSION['messages'][] = 'CPUの得点は:' . $cpu_points;
                $judgement = $judge->bustOrBlackjack($cpu_points, 'CPU');
                if (!$judgement) {
                    $judgement = $judge->checkTheWinner($user_points, $cpu_points);
                }
            } else {
                $_SESSION['messages'][] = 'CPUの得点は:' . $cpu_points;
                $judgement = $judge->checkTheWinner($user_points, $cpu_points);
            }
            break;
        default :
            echo 'error';
            exit;
    }
} else {
    echo NEWGAME;
    exit;
}
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