<?php

//AOC - Day 2
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\2\calculate.php"


function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");

    $sum = 0;

    if($part!=2){

        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $play = explode(" ",$line);

            // print_r($play);

            if($play[1] == "X"){
                $sum += 1;
            }
            if($play[1] == "Y"){
                $sum += 2;
            }
            if($play[1] == "Z"){
                $sum += 3;
            }
            if( ($play[0]=='A' && $play[1]=='X') || ($play[0]=='B' && $play[1]=='Y') || ($play[0]=='C' && $play[1]=='Z') ){
                $sum += 3;
            }
            if( ($play[0]=='A' && $play[1]=='Y') || ($play[0]=='B' && $play[1]=='Z') || ($play[0]=='C' && $play[1]=='X')){
                $sum += 6;
            }
        }
    }
    else{

        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $play = explode(" ",$line);

            // print_r($play);

            if($play[1] == "Y"){    //DRAW
                if($play[0]=="A"){
                    $sum += 1;
                }
                if($play[0]=="B"){
                    $sum += 2;
                }
                if($play[0]=="C"){
                    $sum += 3;
                }
                $sum += 3;
            }
            if($play[1] == "X"){    //YOU MUST LOSE
                if($play[0]=="A"){
                    $sum += 3;
                }
                if($play[0]=="B"){
                    $sum += 1;
                }
                if($play[0]=="C"){
                    $sum += 2;
                }
            }
            if($play[1] == "Z"){    //YOU MUST WIN
                if($play[0]=="A"){
                    $sum += 2;
                }
                if($play[0]=="B"){
                    $sum += 3;
                }
                if($play[0]=="C"){
                    $sum += 1;
                }
                $sum += 6;
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
