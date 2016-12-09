<?php

$data = file_get_contents("input.txt", TRUE);
$rows = explode(PHP_EOL, $data);

$charactersCounter = [];

foreach($rows as $row){
    foreach(str_split($row) as $position => $character){
        if(!isset($charactersCounter[$position][$character])){
            $charactersCounter[$position][$character] = 0;
        }
        $charactersCounter[$position][$character]++;
    }
}

foreach($charactersCounter as $position => $characters){
    asort($characters);
    reset($characters);

    $char = key($characters);
    echo $char;
}
file_put_contents('./result.txt', print_r($charactersCounter, true));