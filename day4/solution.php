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
        $realRooms[] = [
            'string' => $matches[1],
            'sectorId' => $matches[2]
        ];
    }
}
$decryptedRooms = [];
foreach($realRooms as $key => $realRoom){
    foreach(str_split($realRoom['string']) as $character){
        if($character == '-'){
            $next_ch = ' ';
        }
        else {
            $next_ch = $character;
            for($i = 0; $i < (int) $realRoom['sectorId']; $i++){
                $next_ch = ++$character;
                if (strlen($next_ch) > 1) { // if you go beyond z or Z reset to a or A
                    $next_ch = substr($next_ch,-1);
                }

            }
        }


        if(!isset($decryptedRooms[$key][0])){
            $decryptedRooms[$key][0] = '';
        }

        $decryptedRooms[$key][0] .= $next_ch;
        $decryptedRooms[$key]['code'] = $realRoom['sectorId'];
    }
}

var_dump($decryptedRooms);
file_put_contents('./result.txt', print_r($decryptedRooms, true));