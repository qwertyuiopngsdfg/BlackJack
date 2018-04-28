<?php
require_once('config.php');

//create deck
foreach ($ranks as $rank) {
    foreach ($numbers as $num) {
        switch ($num) {
            case 11:
                $deck[] = $rank . 'のJ';
                break;
            case 12:
                $deck[] = $rank . 'のQ';
                break;
            case 13:
                $deck[] = $rank . 'のK';
                break;
            default:
                $deck[] = $rank . 'の' . $num;
                break;
        }
    }
}
shuffle($deck);

//write the deck in the csv
$i = 0;
do {
    $i++;
    $file_name = BASE_PASS . '/csv/' . date('Y-m-d') . '(' . $i . ')' . '.csv';
} while (file_exists($file_name));

$file_handler = fopen($file_name, "w");
fputcsv($file_handler, $deck);
