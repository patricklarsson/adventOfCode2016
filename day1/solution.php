<?php

$data = file_get_contents("input.txt", TRUE);
$data = explode(', ', $data);

$currentOrientation = 0;
$map = [0, 0];
$previousPath = [];
$found = false;
$crossingPath = null;

foreach($data as $path){
    $currentOrientation += ($path[0] === "L") ? -1 : 1;
    if($currentOrientation<0) $currentOrientation = 3;
    if($currentOrientation>3) $currentOrientation = 0;

    for ($i = 0; $i < (int)substr($path,1); $i++){
        if($currentOrientation === 0) $map[1]++;
        if($currentOrientation === 1) $map[0]++;
        if($currentOrientation === 2) $map[1]--;
        if($currentOrientation === 3) $map[0]--;

        if(in_array($map, $previousPath) && !$found)
        {
            $crossingPath = abs($map[1]) + abs($map[0]);
            $found = true;
        }

        $previousPath[] = $map;
    }
}

$blocksAway = abs($map[0]) + abs($map[1]);

var_dump($blocksAway, $crossingPath);