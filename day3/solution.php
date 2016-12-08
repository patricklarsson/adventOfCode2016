<?php

/** Fix these solutions, to much repetition **/
$data = file_get_contents("input.txt", TRUE);

// Part 1
$output = preg_replace('/[[:blank:]]+/', ' ', $data);

$lines = explode(PHP_EOL, $output);
$legals = 0;

foreach($lines as $line){
    $values = explode(' ', trim($line));
    $isLegal = ($values[0] + $values[1] > $values[2]) && ($values[0] + $values[2] > $values[1]) && ($values[1] + $values[2] > $values[0]);
    if($isLegal){
        $legals++;
    }
}


// Part 2
$values = [];
foreach($lines as $line){
    $values[] = explode(' ', trim($line));
}

array_unshift($values, "setKeyTo1SoModulusWillWork");
unset($values[0]);

$result = 0;
$isLegal = 0;
$lines = [];
$degrees = [];

for($i = 0; $i < 3; $i++){
    foreach($values as $key => $value){
        $degrees[] = $value[$i];
        if($key % 3 == 0){
            $lines[] = $degrees;
            $degrees = [];
        }
    }
}

$legals = 0;
foreach($lines as $values){
    $isLegal = ($values[0] + $values[1] > $values[2]) && ($values[0] + $values[2] > $values[1]) && ($values[1] + $values[2] > $values[0]);
    if($isLegal){
        $legals++;
    }
}

var_dump($legals);
