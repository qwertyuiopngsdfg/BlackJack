<?php

//create deck
$numbers = [1,2,3,4,5,6,7,8,9,10,11,12,13];
$ranks = ['Club', 'Diamond', 'Heart', 'Spade'];

foreach ($ranks as $rank) {
    foreach ($numbers as $num) {
        $deck[] = $rank . 'の' . $num;
    }
}
shuffle($deck);

//write the deck in the text
$pass = getcwd();
$j = 0;
do {
    $j++;
    $file_name = $pass . '/csv/' . date('Y-m-d') . '(' . $j . ')' . '.csv';
} while (file_exists($file_name));

$file_handler = fopen($file_name, "w");
fputcsv($file_handler, $deck);
