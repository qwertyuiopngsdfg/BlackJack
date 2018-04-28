<?php
require_once('config.php');

//create deck
foreach ($ranks as $rank) {
    foreach ($numbers as $num) {
        $deck[] = $rank . 'の' . $num;
    }
}
shuffle($deck);

//write the deck in the text
$i = 0;
do {
    $i++;
    $file_name = BASE_PASS . '/csv/' . date('Y-m-d') . '(' . $i . ')' . '.csv';
} while (file_exists($file_name));

$file_handler = fopen($file_name, "w");
fputcsv($file_handler, $deck);
