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
            $_SESSION['cpu_hand'] = $game->firstDraw();
            $_SESSION['secret_card'] = $_SESSION['deck'][1];
            array_splice($_SESSION['deck'], 0, 2);
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            $judgement = $judge->bustOrBlackjack($user_points, 'あなた');
            $message = 'あなたの得点は:' . $user_points;
            array_push($_SESSION['messages'], $message);
            break;
        case 'draw':
            $message = $game->showCard('あなた');
            array_push($_SESSION['messages'], $message);
            $draw_card = $game->nextDraw();
            array_push($_SESSION['user_hand'], $draw_card);
            array_splice($_SESSION['deck'], 0, 1);
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            $judgement = $judge->bustOrBlackjack($user_points, 'あなた');
            $message = 'あなたの得点は:' . $user_points;
            array_push($_SESSION['messages'], $message);
            break;
        case 'stop':
            $user_points = $game->totalPoints($_SESSION['user_hand']);
            $cpu_points = $game->totalPoints($_SESSION['cpu_hand']);
            $message = 'CPUの2枚目のカードは' . $_SESSION['secret_card'] . 'でした';
            array_push($_SESSION['messages'], $message);
            $judgement = $judge->bustOrBlackjack($cpu_points, 'CPU');
            if (empty($judgement) && $cpu_points < 17) {
                for ($i=0; $cpu_points < 17; $i++) {
                    $message = $game->showCard('CPU');
                    $draw_card = $game->nextDraw();
                    array_push($_SESSION['cpu_hand'], $draw_card);
                    array_push($_SESSION['messages'], $message);
                    array_splice($_SESSION['deck'], 0, 1);
                    $cpu_points = $game->totalPoints($_SESSION['cpu_hand']);
                }
                $message = 'CPUの得点は:' . $cpu_points;
                array_push($_SESSION['messages'], $message);
                $judgement = $judge->bustOrBlackjack($cpu_points, 'CPU');
                if (!$judgement) {
                    $judgement = $judge->checkTheWinner($user_points, $cpu_points);
                }
            }
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