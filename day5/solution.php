<?php

$password = '';
$passwordArray = [];
$i = 0;
// Part 1

while(count($passwordArray) < 8){

    $hash = md5('ojvtpuvg' . $i);
    if(substr($hash, 0, 5) === '00000'){

        $position = substr($hash, 5, 1);
        $value = substr($hash, 6, 1);

        if($position >= 0 && $position < 8 && is_numeric($position)){
            if(!isset($passwordArray[$position])){
                var_dump($hash);
                $passwordArray[$position] = $value;
            }
        }
    }

    $i++;
}
ksort($passwordArray);
var_dump(($passwordArray));
var_dump(implode($passwordArray));