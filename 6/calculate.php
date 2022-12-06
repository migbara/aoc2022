<?php

//AOC - Day 6
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\6\calculate.php"

function diffChars($needle,$haystack){
    //Find if all the chars of a string are differents or not
    echo $needle." ".$haystack."\r\n";
    if(strlen($haystack)==1){
        return $needle != $haystack;
    }
    else{
        if(strstr($haystack,$needle))
            return false;
        else
            return diffChars(substr($haystack,0,1),substr($haystack,1));
    }
}

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $position = 0;
    
    if($part!=2){
        
        //Size 4
        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            // $line = "mjqmjqa";
            $dif = false;
            $j = 0;
            $size = 4;

            while( !$dif && $j <= strlen($line)-$size){
                $cad = substr($line,$j,$size);

                // echo $cad."\r\n";

                
                $i = 0;
                while (!$dif && $i<=(strlen($cad)-$size)){
                    $char = substr($cad,$i,1);
                    // echo "PROCESANDO ".$char." ".substr($cad,$i+1)."\r\n";
                    $dif = diffChars($char,substr($cad,$i+1));
                    // if($dif)
                    //     echo "true"."\r\n";
                    // else {
                    //     echo "false"."\r\n";
                    // }
                    $i++;
                }
                

                $j++;

            }
            // echo "J ".$j."\r\n";
            // echo "RESULT ".($j+$size-1)."\r\n";

            $position = $j+$size-1;

        }

    }
    else{
        //Size 14
        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            // $line = "mjqmjqa";
            $dif = false;
            $j = 0;
            $size = 14;

            while( !$dif && $j <= strlen($line)-$size){
                $cad = substr($line,$j,$size);

                // echo $cad."\r\n";

                
                $i = 0;
                while (!$dif && $i<=(strlen($cad)-$size)){
                    $char = substr($cad,$i,1);
                    // echo "PROCESANDO ".$char." ".substr($cad,$i+1)."\r\n";
                    $dif = diffChars($char,substr($cad,$i+1));
                    // if($dif)
                    //     echo "true"."\r\n";
                    // else {
                    //     echo "false"."\r\n";
                    // }
                    $i++;
                }
                

                $j++;

            }
            // echo "J ".$j."\r\n";
            // echo "RESULT ".($j+$size-1)."\r\n";

            $position = $j+$size-1;

        }

    }
    

    return ["position"=>$position];
}

// if(diffChars("m","jqj")){
//     echo "true";
// } 
// else
//     echo "false";

$part0 = calculate('');
echo "PART 0"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part0["position"]."\r\n"."\r\n";

$part1 = calculate(1);
echo "PART 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part1["position"]."\r\n"."\r\n";

$part20 = calculate('',2);
echo "PART 2 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part20["position"]."\r\n"."\r\n";

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["position"]."\r\n"."\r\n";

exit();
