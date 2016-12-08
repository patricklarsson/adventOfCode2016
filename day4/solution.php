<?php

$data = file_get_contents("input.txt", TRUE);
$rows = explode(PHP_EOL, $data);
$sumOfSectorIds = 0;
$realRooms = [];

foreach ($rows as $row){
    // Get the things we need
    preg_match('/([a-z-]+)([\d]+)\[(\w+)\]/', $row, $matches);

    $encrypted = str_split(str_replace('-', '', $matches[1]));
    $sectorId = $matches[2];
    $checksum = $matches[3];

    $letters = [];

    foreach($encrypted as $character){
        if(!isset($letters[$character])){
            $letters[$character] = 1;
        } else {
            $letters[$character] = $letters[$character]+1;
        }
    }

    $temp = $letters;

    uksort($letters, function($a, $b) use ($temp) {
        if($temp[$a] === $temp[$b]){
             return $a > $b;
        }
        return $temp[$b] - $temp[$a];
    });

    unset($temp);

    $letters = implode(array_keys(array_slice($letters, 0, 5)));

    if($letters == $checksum){
        $sumOfSectorIds += $sectorId;
        $realRooms[] = $matches[0];
    }
}

var_dump($realRooms);