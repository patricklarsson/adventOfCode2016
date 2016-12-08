<?php

    $data = file_get_contents("input.txt", TRUE);

    $lines = explode(PHP_EOL, $data);

    $position = 5;

    // Part 1
    $possibleToMove = [
      1 => ['R' => 2, 'D' => 4],
      2 => ['R' => 3, 'D' => 5, 'L' => 1],
      3 => ['D' => 6, 'L' => 2],
      4 => ['R' => 5, 'D' => 7, 'U' => 1],
      5 => ['R' => 6, 'D' => 8, 'L' => 4, 'U' => 2],
      6 => ['L' => 5, 'D' => 9, 'U' => 3],
      7 => ['R' => 8, 'U' => 4],
      8 => ['R' => 9, 'L' => 7, 'U' => 5],
      9 => ['L' => 8, 'U' => 6],
    ];

    // Part 2
    $possibleToMove = [
        1 => ['D' => 3],
        2 => ['R' => 3, 'D' => 6],
        3 => ['U' => 1, 'D' => 7, 'L' => 2, 'R' => 4],
        4 => ['L' => 3, 'D' => 8],
        5 => ['R' => 6],
        6 => ['U' => 2, 'D' => 10, 'L' => 5, 'R' => 7],
        7 => ['U' => 3, 'D' => 11, 'L' => 6, 'R' => 8],
        8 => ['U' => 4, 'D' => 12, 'L' => 7, 'R' => 9],
        9 => ['L' => 8],
        10 => ['U' => 6, 'R' => 11],
        11 => ['U' => 7, 'D' => 13, 'L' => 10, 'R' => 12],
        12 => ['U' => 8, 'L' => 11],
        13 => ['U' => 11]
    ];

    foreach ($lines as $line){
        $lineLength = strlen($line);
        for($i = 0; $i < $lineLength; $i++){
            $direction = $line[$i];
            if(isset($possibleToMove[$position][$direction])){
                $position = $possibleToMove[$position][$direction];
            }
        }
        if($position == 10) echo 'A';
        if($position == 11) echo 'B';
        if($position == 12) echo 'C';
        if($position == 13) echo 'D';
        if(!in_array($position, [10,11,12,13])) echo $position;

    }
