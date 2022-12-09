<?php

//AOC - Day 9
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\9\calculate.php"

function checkVisibles($data){
    $cont = 0;
    $maxViews = 0;
    for ($j=1; $j < (count($data)-1); $j++) { 
        for ($i=1; $i < (count($data[$i])-1); $i++) {
            $views_oeste = 0;
            $views_este = 0;
            $views_norte = 0;
            $views_sur = 0;
            // echo $data[$i][$j]."\r\n";
            $v = $data[$i][$j];

            // if( ($data[$i-1][$j] >= $v) && ($data[$i+1][$j] >= $v) && ($data[$i][$j-1] >= $v) && ($data[$i][$j+1] >= $v) ){
            //     echo "NO ES VISIBLE";
            // }
            // else{
            //     echo "VISIBLE";
            //     $cont++;
            // }

            //comprobamos hacia el oeste
            $visibleo = true;
            for($n = $i-1; $n >= 0; $n--){
                $oeste = $data[$n][$j];
                // echo "OESTE: ".$oeste."\r\n";
                if($oeste >= $v){
                    $visibleo = false;
                    $views_oeste++;
                    break;
                }
                else{
                    $views_oeste++;
                }
            }
            //comprobamos hacia el este
            $visiblee = true;
            for($s = $i+1; $s < count($data[$i]); $s++){
                $este = $data[$s][$j];
                // echo "ESTE: ".$este."\r\n";
                if($este >= $v){
                    $visiblee = false;
                    $views_este++;
                    break;
                }
                else{
                    $views_este++;
                }
            }
            //comprobamos hacia el norte
            $visiblen = true;
            for($e = $j-1; $e >= 0; $e--){
                $norte = $data[$i][$e];
                // echo "NORTE: ".$norte."\r\n";
                if($norte >= $v){
                    $visiblen = false;
                    $views_norte++;
                    break;
                }
                else{
                    $views_norte++;
                }
            }
            //comprobamos hacia el sur
            $visibles = true;
            for($o = $j+1; $o < count($data); $o++){
                $sur = $data[$i][$o];
                // echo "SUR: ".$sur."\r\n";
                if($sur >= $v){
                    $visibles = false;
                    $views_sur++;
                    break;
                }
                else{
                    $views_sur++;
                }
            }
            if($visiblen || $visibles || $visiblee || $visibleo){
                $cont++;
                // echo "VISIBLE"."\r\n";
            }
            $views = $views_norte * $views_sur * $views_este * $views_oeste;
            if($views > $maxViews)
                $maxViews = $views;
                
        }
        // echo "\r\n";
    }
    return ["cont"=>$cont,"maxviews"=>$maxViews];
}

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

function move2 (&$in,$a,$b,$direction,$n){

    //Norte (U) mueve y negativamente
    //Sur (D) mueve y positivamente
    //Este (L) mueve x negativamente
    //Oeste (R) mueve x positivamente
    
    switch ($direction) {
        case 'U':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $in[$a]["y"]--;              
                if(abs($in[$a]["y"]-$in[$b]["y"])>1 && ($in[$a]["x"] != $in[$b]["x"])){
                    // echo "MOVEMOS T"."\r\n";
                    $in[$b]["x"] = $in[$a]["x"];
                    $in[$b]["y"] = $in[$b]["y"]+1;
                }
                elseif(($in[$a]["x"] == $in[$b]["x"]) && (($in[$a]["y"])<($in[$b]["y"]-1))){
                    $in[$b]["y"]--;
                }
                
                // $h[$x][$y] = 'x';
                // $t[$xt][$yt] = 'X';
                $in[$a]["v"][$in[$a]["x"]][$in[$a]["y"]] = 'X';
                $in[$b]["v"][$in[$b]["x"]][$in[$b]["y"]] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            break;
        
        case 'D':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $in[$a]["y"]++;              
                if(abs($in[$a]["y"]-$in[$b]["y"])>1 && ($in[$a]["x"] != $in[$b]["x"])){
                    // echo "MOVEMOS T"."\r\n";
                    $in[$b]["x"] = $in[$a]["x"];
                    $in[$b]["y"] = $in[$a]["y"]-1;
                }
                elseif(($in[$a]["x"] == $in[$b]["x"]) && (($in[$a]["y"])>($in[$b]["y"]+1))){
                    $in[$b]["y"]++;
                }
                
                $in[$a]["v"][$in[$a]["x"]][$in[$a]["y"]] = 'X';
                $in[$b]["v"][$in[$b]["x"]][$in[$b]["y"]] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            break;
        
        case 'L':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $in[$a]["x"]--;              
                if(abs($in[$a]["x"]-$in[$b]["x"])>1 && ($in[$a]["y"] != $in[$b]["y"])){
                    // echo "MOVEMOS T"."\r\n";
                    $in[$b]["y"] = $in[$a]["y"];
                    $in[$b]["x"] = $in[$a]["x"]+1;
                }
                elseif(($in[$a]["y"] == $in[$b]["y"]) && (($in[$a]["x"])<($in[$b]["x"]-1))){
                    $in[$b]["x"]--;
                }
                
                $in[$a]["v"][$in[$a]["x"]][$in[$a]["y"]] = 'X';
                $in[$b]["v"][$in[$b]["x"]][$in[$b]["y"]] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
            }
            break;
        
        case 'R':
            //Damos el primer paso con h
            for($k=0; $k < $n; $k++){
                $in[$a]["x"]++;              
                if(abs($in[$a]["x"]-$in[$b]["x"])>1 && ($in[$a]["y"] != $in[$b]["y"])){
                    // echo "MOVEMOS T"."\r\n";
                    $in[$b]["y"] = $in[$a]["y"];
                    $in[$b]["x"] = $in[$a]["x"]-1;
                }
                elseif(($in[$a]["y"] == $in[$b]["y"]) && (($in[$a]["x"])>($in[$b]["x"]+1))){
                    $in[$b]["x"]++;
                }
                
                $in[$a]["v"][$in[$a]["x"]][$in[$a]["y"]] = 'X';
                $in[$b]["v"][$in[$b]["x"]][$in[$b]["y"]] = 'X';
                // echo "--    X: ".$x." Y: ".$y."\r\n";
                // echo "--    XT: ".$xt." YT: ".$yt."\r\n";
                echo "--    X: ".$in[$a]["x"]." Y: ".$in[$a]["y"]."\r\n";
                echo "--    XT: ".$in[$b]["x"]." YT: ".$in[$b]["y"]."\r\n";
            }
            
            break;
        
        default:
            
            break;
    }
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

        $nudos = 2;

        for ($i=0; $i < $nudos; $i++) {

            $v[0][0] = "X";

            $in[$i] = ["x"=>0,"y"=>0,"v"=>$v];
        }

        // move2($in,0,0,'',0);

        foreach ($steps as $step) {
            $direction = $step[0];
            $long = $step[1];

            for($i=1; $i<$nudos; $i++){
                move2($in,$i-1,$i,$direction,$long);
            }
        }

        // echo "X: ".$x." Y: ".$y."\r\n";
        // echo "XT: ".$xt." YT: ".$yt."\r\n";
        // print_r($t);

        print_r($in);

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

// if(diffChars("m","jqj")){
//     echo "true";
// } 
// else
//     echo "false";

$part0 = calculate('');
echo "PART 0"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part0["result"]."\r\n"."\r\n";

$part1 = calculate(1);
echo "PART 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part1["result"]."\r\n"."\r\n";

$part20 = calculate('',2);
echo "PART 2 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part20["result"]."\r\n"."\r\n";

exit();
$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["result"]."\r\n"."\r\n";

