<?php

//AOC - Day 8
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\8\calculate.php"

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

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $data = [];
    $j = 0;

    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);  

        for ($i=0; $i < strlen($line); $i++) { 
            // if(!isset($data[$i][$j]))
            //     $data[$i][$j] = [];

            $data[$i][$j] = substr($line,$i,1);
        }
        $j++;

    }

    if($part!=2){
        
        // print_r($data);

        $visibles = (($j - 2) + strlen($line)) * 2;

        $results = checkVisibles($data);

        $result = $visibles + $results["cont"];

    }
    else{

        $results = checkVisibles($data);

        $result = $results["maxviews"];
        
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

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["result"]."\r\n"."\r\n";

exit();
