<?php

$data = file_get_contents("input.txt", TRUE);
$rows = explode(PHP_EOL, $data);

$display = [
    0 => ['.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.'],
    1 => ['.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.'],
    2 => ['.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.'],
    3 => ['.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.'],
    4 => ['.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.'],
    5 => ['.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.'],
];

$i = 0;
foreach($rows as $row){
    modifyDisplay($row, $display);
}

function modifyDisplay($instruction, &$display){

    preg_match('/^(\w+) (?:(\d+)x(\d+)|(row|column))(?: (y|x)=(\d+) by (\d+))?/', $instruction, $instructions);

    if($instructions[1] == 'rect') {
        for($i = 0; $i < $instructions[2]; $i++){
            for($j = 0; $j < $instructions[3]; $j++){
                $display[$j][$i] = '#';
            }
        }
    } else {
        if($instructions[4] == 'row'){
            $newLine = array_fill(0, 50, '.');
            foreach($display[$instructions[6]] as $key => $pixel){
                if($key + $instructions[7] > 49){
                    $newLine[abs($key + $instructions[7] - 50)] = $pixel;
                } else {
                    $newLine[$key + $instructions[7]] = $pixel;
                }
            }
            $display[$instructions[6]] = $newLine;
            ksort($display);
        } else {
            $copy = [$display[0][$instructions[6]], $display[1][$instructions[6]], $display[2][$instructions[6]], $display[3][$instructions[6]], $display[4][$instructions[6]], $display[5][$instructions[6]] ];

//            ksort($copy);


            $newRow = [];

            foreach($copy as $key => $pixel){
                if($key + $instructions[7] > 5){
                    $newRow[abs($key + $instructions[7] - 6)] = $pixel;
                } else {
                    $newRow[$key + $instructions[7]] = $pixel;
                }
            }

            foreach($newRow as $key => $value){
                $display[$key][$instructions[6]] = $value;
            }
        }
    }
}

drawDisplay($display);

$numberOfPixels = 0;

foreach($display as $row){
    $numberOfPixels += substr_count(implode($row), '#');
}
echo $numberOfPixels;


function drawDisplay($display){

    foreach($display as $row){
        echo implode($row) . "\n";
    }
}