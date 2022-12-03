<?php

//AOC - Day 3
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\3\calculate.php"

function common($p1,$p2,$p3 = ''){
    for ($i=0; $i < strlen($p1); $i++) { 
        $chr = '';
        // echo "BUSCANDO ".substr($p1,$i,1)." en ".$p2."\r\n";
        if(strpos($p2,substr($p1,$i,1)) !== false){
            $chr = substr($p1,$i,1);
            if($p3 != ''){
                if(strpos($p3,$chr) !== false){
                    break 1;
                }
            }
            else {
                break 1;
            }
        }
    }
    return $chr;
}

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");

    $sum = 0;

    $letters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    if($part!=2){

        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $length = strlen($line);

            $p1 = substr($line,0,($length/2));
            $p2 = substr($line,($length/2),$length);

            // echo $p1 . "-" .$p2."\r\n";

            $common = common($p1,$p2);
            // echo $common." - ";
            $key = array_search($common, $letters) + 1;
            // echo $key."\r\n";

            $sum += $key;
        }
    }
    else{

        $block = [];

        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $block[] = $line;

            if(count($block)==3){
                $common = common($block[0],$block[1],$block[2]);
                // echo $common." - ";

                $key = array_search($common, $letters) + 1;
                // echo $key."\r\n";

                $sum += $key;

                $block = [];
            }
            
        }

    }
    

    return ["sum"=>$sum];
}

$part0 = calculate('');
echo "PART 0"."\r\n";
echo "---------------------------------------"."\r\n";
echo "SUM ".$part0["sum"]."\r\n"."\r\n";

$part1 = calculate(1);
echo "PART 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "SUM ".$part1["sum"]."\r\n"."\r\n";

$part20 = calculate('',2);
echo "PART 2 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "SUM ".$part20["sum"]."\r\n"."\r\n";

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "SUM ".$part2["sum"]."\r\n"."\r\n";

exit();
