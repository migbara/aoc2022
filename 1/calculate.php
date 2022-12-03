<?php

//AOC - Day 1
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\1\calculate.php"

function updateCounters2(&$counters){
    $counters["counter"]++;
    if($counters["sum"]>$counters["max"]){
        $counters["max"] = $counters["sum"];
        $counters["counter_max"] = $counters["counter"];
    }
    // return ["counter"=>$counters["counvter"],"sum"=>0,"max"=>$counters["max"],"counter_max"=>$counters["counter_max"]];
}



function calculate($part){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$part.".txt";
    $f = fopen($file,"r");

    $data = [];

    $counters = ["counter"=>0,"sum"=>0,"max"=>0,"counter_max"=>0];

    while(!feof($f)){ // FOR TEST && $counter<10){
        $line = fgets($f);
        $n = rtrim($line);

        if($n!=''){
            // $sum += $n;
            $counters["sum"] += $n;
        }
        else{
            // $updated = updateCounters($counter,$sum,$max,$counter_max);
            updateCounters2($counters);
            $data[$counters["counter"]] = $counters["sum"];
            $counters["sum"] = 0;
        }
    }
    updateCounters2($counters);
    $data[$counters["counter"]] = $counters["sum"];

    print_r($data);

    $sort_data = $data;

    sort($sort_data);

    print_r($sort_data);


    $counters["big3sum"] = 0;
    for ($i=1; $i <=3 ; $i++) { 
        $counters["big3sum"] += $sort_data[count($sort_data)-$i];
    }

    return $counters;
}

$part0 = calculate('');
echo "PART 0"."\r\n";
echo "---------------------------------------"."\r\n";
echo "MAX ".$part0["max"]."\r\n";
echo "COUNTER MAX ".$part0["counter_max"]."\r\n"."\r\n";

$part1 = calculate(1);
echo "PART 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "MAX ".$part1["max"]."\r\n";
echo "COUNTER MAX ".$part1["counter_max"]."\r\n"."\r\n";

echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "SUM 3 BIGGER ".$part1["big3sum"]."\r\n"."\r\n";

exit();
