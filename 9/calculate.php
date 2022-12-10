<?php

//AOC - Day 9
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\9\calculate.php"

function move (&$x,&$y,&$xt,&$yt,&$h,&$t,$direction,$n){

    //Norte (U) mueve y negativamente
    //Sur (D) mueve y positivamente
    //Este (L) mueve x negativamente
    //Oeste (R) mueve x positivamente
    
    switch ($direction) {
        case 'U':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $y--;              
                if(abs($y-$yt)>1 && ($xt != $x)){
                    // echo "MOVEMOS T"."\r\n";
                    $xt = $x;
                    $yt = $y+1;
                }
                elseif(($xt == $x) && (($y)<($yt-1))){
                    $yt--;
                }
                
                $h[$x][$y] = 'x';
                $t[$xt][$yt] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            break;
        
        case 'D':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $y++;              
                if(abs($y-$yt)>1 && ($xt != $x)){
                    // echo "MOVEMOS T"."\r\n";
                    $xt = $x;
                    $yt = $y-1;
                }
                elseif(($xt == $x) && (($y)>($yt+1))){
                    $yt++;
                }
                
                $h[$x][$y] = 'x';
                $t[$xt][$yt] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            break;
        
        case 'L':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $x--;              
                if(abs($x-$xt)>1 && ($yt != $y)){
                    // echo "MOVEMOS T"."\r\n";
                    $yt = $y;
                    $xt = $x+1;
                }
                elseif(($yt == $y) && (($x)<($xt-1))){
                    $xt--;
                }
                
                $h[$x][$y] = 'x';
                $t[$xt][$yt] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            break;
        
        case 'R':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $x++;              
                if(abs($x-$xt)>1 && ($yt != $y)){
                    // echo "MOVEMOS T"."\r\n";
                    $yt = $y;
                    $xt = $x-1;
                }
                elseif(($yt == $y) && (($x)>($xt+1))){
                    $xt++;
                }
                
                $h[$x][$y] = 'x';
                $t[$xt][$yt] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            
            break;
        
        default:
            $h[$x][$y] = 'x';
            $t[$xt][$yt] = 'X';
            break;
    }
}

function move2 (&$in,$nodo,$direction){

    //Norte (U) mueve y negativamente
    //Sur (D) mueve y positivamente
    //Este (L) mueve x negativamente
    //Oeste (R) mueve x positivamente
    
    switch ($direction) {
        case 'U':
            // echo "MOVIENDO EL ".$nodo." ARRIBA"."\r\n";

            if($nodo==0){
                $in[$nodo]["y"]--;
                // echo "MUEVE H ARRIBA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
            }
            else{

                if((abs($in[($nodo-1)]["y"]-$in[$nodo]["y"])>1 || abs($in[($nodo-1)]["x"]-$in[$nodo]["x"])>1) && ($in[($nodo-1)]["x"] != $in[$nodo]["x"])){
                    
                    if($in[($nodo-1)]["y"] > $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] + 1;
                    elseif($in[($nodo-1)]["y"] < $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] - 1;

                    if($in[($nodo-1)]["x"] < $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] - 1;
                    elseif($in[($nodo-1)]["x"] > $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] + 1;
                    
                    // echo "MUEVE ".$nodo." DIAGONAL ARRIBA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
                elseif(($in[($nodo-1)]["x"] == $in[$nodo]["x"]) && (($in[($nodo-1)]["y"])<($in[$nodo]["y"]-1))){

                    $in[$nodo]["y"]--;

                    // echo "MUEVE ".$nodo." ARRIBA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
            }
            
            $in[$nodo]["v"][$in[$nodo]["x"]][$in[$nodo]["y"]] = 'X';

            if(isset($in[($nodo+1)]))
                move2($in,$nodo+1,$direction);
                
            break;
        
        case 'D':
            if($nodo==0){
                $in[$nodo]["y"]++;              
                // echo "MUEVE H ABAJO"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
            }
            else{
                if((abs($in[($nodo-1)]["y"]-$in[$nodo]["y"])>1 || abs($in[($nodo-1)]["x"]-$in[$nodo]["x"])>1) && ($in[($nodo-1)]["x"] != $in[$nodo]["x"])){
                    
                    if($in[($nodo-1)]["y"] > $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] + 1;
                    elseif($in[($nodo-1)]["y"] < $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] - 1;

                    if($in[($nodo-1)]["x"] < $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] - 1;
                    elseif($in[($nodo-1)]["x"] > $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] + 1;

                    // echo "MUEVE ".$nodo." DIAGONAL ABAJO"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
                elseif(($in[($nodo-1)]["x"] == $in[$nodo]["x"]) && (($in[($nodo-1)]["y"])>($in[$nodo]["y"]+1))){

                    $in[$nodo]["y"]++;
                    // echo "MUEVE ".$nodo." ABAJO"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
            }
            
            $in[$nodo]["v"][$in[$nodo]["x"]][$in[$nodo]["y"]] = 'X';

            if(isset($in[($nodo+1)]))
                move2($in,$nodo+1,$direction);
            
            break;
        
        case 'L':
            if($nodo==0){
                $in[$nodo]["x"]--;
                // echo "MUEVE H IZQUIERDA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
            }
            else{             
                if((abs($in[($nodo-1)]["y"]-$in[$nodo]["y"])>1 || abs($in[($nodo-1)]["x"]-$in[$nodo]["x"])>1) && ($in[($nodo-1)]["y"] != $in[$nodo]["y"])){
                    
                    if($in[($nodo-1)]["y"] > $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] + 1;
                    elseif($in[($nodo-1)]["y"] < $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] - 1;

                    if($in[($nodo-1)]["x"] < $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] - 1;
                    elseif($in[($nodo-1)]["x"] > $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] + 1;
                    
                    // echo "MUEVE ".$nodo." DIAGONAL IZQUIERDA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
                elseif(($in[($nodo-1)]["y"] == $in[$nodo]["y"]) && (($in[($nodo-1)]["x"])<($in[$nodo]["x"]-1))){
                    $in[$nodo]["x"]--;
                    // echo "MUEVE ".$nodo." IZQUIERDA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
            }
            
            $in[$nodo]["v"][$in[$nodo]["x"]][$in[$nodo]["y"]] = 'X';

            if(isset($in[($nodo+1)]))
                move2($in,$nodo+1,$direction);
            
            break;
        
        case 'R':
            if($nodo==0){
                $in[$nodo]["x"]++;
                // echo "MUEVE H DERECHA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
            }
            else{
                if((abs($in[($nodo-1)]["y"]-$in[$nodo]["y"])>1 || abs($in[($nodo-1)]["x"]-$in[$nodo]["x"])>1) && ($in[($nodo-1)]["y"] != $in[$nodo]["y"])){
                    
                    if($in[($nodo-1)]["y"] > $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] + 1;
                    elseif($in[($nodo-1)]["y"] < $in[$nodo]["y"])
                        $in[$nodo]["y"] = $in[$nodo]["y"] - 1;

                    if($in[($nodo-1)]["x"] < $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] - 1;
                    elseif($in[($nodo-1)]["x"] > $in[$nodo]["x"])
                        $in[$nodo]["x"] = $in[$nodo]["x"] + 1;
                    
                    // echo "MUEVE ".$nodo." DIAGONAL DERECHA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
                elseif(($in[($nodo-1)]["y"] == $in[$nodo]["y"]) && (($in[($nodo-1)]["x"])>($in[$nodo]["x"]+1))){
                    $in[$nodo]["x"]++;
                    // echo "MUEVE ".$nodo." DERECHA"." x ".$in[$nodo]["x"]." y ".$in[$nodo]["y"]."\r\n";
                }
            }

            // print_r($in[$nodo]);
            
            $in[$nodo]["v"][$in[$nodo]["x"]][$in[$nodo]["y"]] = 'X';

            if(isset($in[($nodo+1)]))
                move2($in,$nodo+1,$direction);
            
            break;
        
        default:
            
            break;
    }

    return null;
}

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $h = [];
    $t = [];
    $steps = [];

    //Get steps
    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);  

        $step = explode(" ",$line);

        $steps[] = $step;

    }

    // print_r($steps);


    if($part!=2){
        
        // print_r($data);

        $x = 0;
        $y = 0;
        $xt = 0;
        $yt = 0;

        move($x,$y,$xt,$yt,$h,$t,'',0);

        foreach ($steps as $step) {
            $direction = $step[0];
            $long = $step[1];

            move($x,$y,$xt,$yt,$h,$t,$direction,$long);
        }

        // echo "X: ".$x." Y: ".$y."\r\n";
        // echo "XT: ".$xt." YT: ".$yt."\r\n";
        // print_r($t);

        //Contar los puntos de t
        $cont = 0;
        foreach ($t as $i => $value) {
            foreach ($value as $j => $c) {
                $cont++;
            }
        }

        $result = $cont;
    }
    else{

        // print_r($data);

        $x = 0;
        $y = 0;
        $xt = 0;
        $yt = 0;

        $in=[];

        $nudos = 10;

        for ($i=0; $i < $nudos; $i++) {

            $v[0][0] = "X";

            $in[$i] = ["x"=>0,"y"=>0,"v"=>$v];
        }

        // move2($in,0,0,'',0);

        foreach ($steps as $step) {
            $direction = $step[0];
            $long = $step[1];

            for($k=0; $k < $long; $k++){
                move2($in,0,$direction);
            }
        }

        // echo "X: ".$x." Y: ".$y."\r\n";
        // echo "XT: ".$xt." YT: ".$yt."\r\n";
        // print_r($t);

        // print_r($in);

        //Contar los puntos de $in[$nudos-1]
        $cont = 0;
        foreach ($in[($nudos-1)]["v"] as $i => $value) {
            foreach ($value as $j => $c) {
                $cont++;
            }
        }

        $result = $cont;
        
    }
    

    return ["result"=>$result];
}


$part0 = calculate('');
echo "PART 0"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part0["result"]."\r\n"."\r\n";

$part1 = calculate(1);
echo "PART 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part1["result"]."\r\n"."\r\n";

$part21 = calculate('',2);
echo "PART 2 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part21["result"]."\r\n"."\r\n";

$part22 = calculate('0',2);
echo "PART 2 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part22["result"]."\r\n"."\r\n";

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["result"]."\r\n"."\r\n";

exit();
