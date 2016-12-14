<?php

$data = file_get_contents("input.txt", TRUE);
$rows = explode(PHP_EOL, $data);

$count1 = [];

foreach($rows as $row){
    if(containsPattern1($row)){
        $count1[] = $row;
    }

    if(containsPattern2($row)){
        $count2[] = $row;
    }


}

echo count($count1);
echo count($count2);

function containsPattern2($str){
    $between = false;
    $chars = str_split($str);
    $validFound = false;

    foreach ($chars as $key => $char){
        if(isset($chars[$key+2])){
            if($char == '['){
                $between = true;
            }
            if($char == ']'){
                $between = false;
            }
        }
    }
}


function containsPattern1($str){
    $between = false;
    $chars = str_split($str);
    $validFound = false;
    foreach ($chars as $key => $char){
       if(isset($chars[$key+3])){
           if($char == '['){
               $between = true;
           }
           if($char == ']'){
               $between = false;
           }
           if($char.$chars[$key+1] == strrev($chars[$key+2].$chars[$key+3]) && $char != $chars[$key+1]){
               if($between){
                   $validFound = false;
                   $foundBetween = true;
               } else if (!$foundBetween){
                   $validFound = true;
               }
           }
       }
    }
    return $validFound;
}


var_dump(containsPattern("xdsqxnovprgobaabvwzkus[fmadbfsbqwravarzrgdg]aeqornszggzbvbizdm"));