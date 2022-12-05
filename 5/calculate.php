<?php

//AOC - Day 5
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\5\calculate.php"

function getStacks($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");

    $stacks = [];
    $movs = [];
    
    $readstacks = true;

    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);

        if($line=='')
            $readstacks = false;

        if($readstacks){
            $pos = 1;
            $nstack = 1;
            while($pos < strlen(($line))){
    
                if(!isset($stacks[$nstack])){
                    $stacks[$nstack] = [];
                }
    
                if( (substr($line,$pos,1)!=" ") && !is_numeric(substr($line,$pos,1)) ){
                    // $stacks[$nstack][] = substr($line,$pos,1);
                    array_unshift($stacks[$nstack],substr($line,$pos,1));
                }
                $pos += 4;
    
                $nstack++;
            }
        }
        else{
            if($line!=''){
                $w = explode(" from ",$line);
                $p = explode(" ",$w[0]);
                $move = $p[1];
                $p = explode(" to ",$w[1]);
                $from = $p[0];
                $to = $p[1];

                $movs[] = ["move"=>$move,"from"=>$from,"to"=>$to];

            }
        }


        
    }
    
    return ["stacks"=>$stacks,"movs"=>$movs];
}


function calculate($file,$part=""){
    
    $string = '';
    
    if($part!=2){
        
        $data = getStacks($file,$part);
        
        // print_r($data["stacks"]);
        // print_r($data["movs"]);

        for ($i=0; $i < count($data["movs"]); $i++) { 
            $mov = $data["movs"][$i];
            for ($j=0; $j < $mov["move"]; $j++) { 
                $n = array_pop($data["stacks"][$mov["from"]]);
                array_push($data["stacks"][$mov["to"]],$n);
            }
        }

        // print_r($data["stacks"]);

        foreach ($data["stacks"] as $stack) {
            $string .= array_pop($stack);
        }

    }
    else{
        $data = getStacks($file,$part);
        
        // print_r($data["stacks"]);
        // print_r($data["movs"]);

        for ($i=0; $i < count($data["movs"]); $i++) { 
            $mov = $data["movs"][$i];
            // for ($j=0; $j < $mov["move"]; $j++) { 
                $n = array_splice($data["stacks"][$mov["from"]],-$mov["move"]);
                // print_r($mov);
                // print_r($n);
                $data["stacks"][$mov["to"]] = array_merge($data["stacks"][$mov["to"]],$n);
            // }

            // print_r($data["stacks"]);
        }

        // print_r($data["stacks"]);

        foreach ($data["stacks"] as $stack) {
            $string .= array_pop($stack);
        }
        

    }
    

    return ["string"=>$string];
}

$part0 = calculate('');
echo "PART 0"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part0["string"]."\r\n"."\r\n";

$part1 = calculate(1);
echo "PART 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part1["string"]."\r\n"."\r\n";

$part20 = calculate('',2);
echo "PART 2 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part20["string"]."\r\n"."\r\n";

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["string"]."\r\n"."\r\n";
exit();

