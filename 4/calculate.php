<?php

//AOC - Day 4
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\4\calculate.php"


function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");

    $sum = 0;

    if($part!=2){

        // fully contains
        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $pairs = explode(",",$line);

            $p1 = explode("-",$pairs[0]);
            $p2 = explode("-",$pairs[1]);

            // echo $p1[0] . "-" .$p1[1].",".$p2[0] . "-" .$p2[1]."\r\n";

            if( ($p1[0]<=$p2[0] && $p1[1]>=$p2[1]) || ($p2[0]<=$p1[0] && $p2[1]>=$p1[1]) ) {
                $sum++;
            }

        }
    }
    else{

        // Overlaps
        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $pairs = explode(",",$line);

            $p1 = explode("-",$pairs[0]);
            $p2 = explode("-",$pairs[1]);

            // echo $p1[0] . "-" .$p1[1].",".$p2[0] . "-" .$p2[1]."\r\n";

            if( ($p1[0]<=$p2[0] && $p1[1]>=$p2[0]) || ($p2[0]<=$p1[0] && $p2[1]>=$p1[0]) ) {
                $sum++;
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
