<?php

//AOC - Day 11
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\11\calculate.php"


function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $data = [];
    $id = 0;

    //Get data
    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);

        if(substr($line,0,6)=='Monkey'){
            //New monkey
            $data[$id] = ["id"=>$id, "inspected"=>0];

            $line = fgets($f);
            $line = rtrim($line);

            if(substr($line,0,6)=='  Star'){
                //Add starting items to the monkey
                
                $cads = explode("items: ",$line);
                $items = explode(", ",$cads[1]);
                
                $data[$id]["items"] = $items;
    
            }

            $line = fgets($f);
            $line = rtrim($line);

            if(substr($line,0,6)=='  Oper'){
                //Add operations
                
                $cads = explode(" = ",$line);
                $operators = explode(" ",$cads[1]);
                
                $data[$id]["operators"] = $operators;
    
            }

            $line = fgets($f);
            $line = rtrim($line);

            if(substr($line,0,6)=='  Test'){
                //Add test
                
                $cads = explode(": ",$line);
                $test = explode(" ",$cads[1]);
                
                $data[$id]["test"]["condition"] = $test;
    
            }

            $line = fgets($f);
            $line = rtrim($line);

            if(substr($line,0,11)=='    If true'){
                //Add if true
                
                $cads = explode(" ",$line);
                $to = $cads[(count($cads)-1)];
                
                $data[$id]["test"]["T"] = $to;
    
            }

            $line = fgets($f);
            $line = rtrim($line);

            if(substr($line,0,12)=='    If false'){
                //Add if false
                
                $cads = explode(" ",$line);
                $to = $cads[(count($cads)-1)];
                
                $data[$id]["test"]["F"] = $to;
    
            }

            $id++;
        }
        

    }

    // print_r($data);


    if($part!=2){

        $rounds = 20;

        for ($i=0; $i < $rounds; $i++) { 
            // echo "ROUND ".($i+1)."\r\n";
            // echo "-----------------"."\r\n";

            for ($id=0; $id < count($data); $id++) { 

                while(count($data[$id]["items"])>0){

                    $item = array_shift($data[$id]["items"]);
                    $data[$id]["inspected"]++;
                    
                    $op = $data[$id]["operators"][1];
                    $value = $data[$id]["operators"][2];

                    if($value=="old")
                        $value = $item;

                    if($op == "*")
                        $wl = $item * $value;
                    if($op == "+")
                        $wl = $item + $value;

                    $wl = floor($wl / 3);

                    if($wl % $data[$id]["test"]["condition"][2] == 0){
                        array_push($data[$data[$id]["test"]["T"]]["items"],$wl);
                    }
                    else{
                        array_push($data[$data[$id]["test"]["F"]]["items"],$wl);
                    }
                }
            }
        }

        // print_r($data);

        $times = [];

        foreach ($data as $id => $info) {
            array_push($times,$info["inspected"]);
        }

        // print_r($times);

        sort($times);

        // print_r($times);

        $max1 = array_pop($times);
        $max2 = array_pop($times);
        
        $result = $max1 * $max2;
    }
    else{

        //Like before but don't divide by 3

        //We need found first the lowest common multiple for the dividers
        $mcm = 1;
        foreach ($data as $id => $info) {
            $mcm *= $info["test"]["condition"][2];
        }

        $rounds = 10000;

        for ($i=0; $i < $rounds; $i++) { 
            // echo "ROUND ".($i+1)."\r\n";
            // echo "-----------------"."\r\n";

            for ($id=0; $id < count($data); $id++) { 

                while(count($data[$id]["items"])>0){

                    $item = array_shift($data[$id]["items"]);
                    $data[$id]["inspected"]++;
                    
                    $op = $data[$id]["operators"][1];
                    $value = $data[$id]["operators"][2];

                    if($value=="old")
                        $value = $item;

                    if($op == "*"){
                        $wl = $item * $value;
                        // $comp = $wl;
                    }
                    if($op == "+"){
                        $wl = $item + $value;
                        // $comp = $wl;
                    }

                    // $wl = floor($wl / 3);

                    //now we want the remainder dividing by lowest common multiple
                    $wl = $wl % $mcm;

                    if($wl % $data[$id]["test"]["condition"][2] == 0){
                        array_push($data[$data[$id]["test"]["T"]]["items"],$wl);
                    }
                    else{
                        array_push($data[$data[$id]["test"]["F"]]["items"],$wl);
                    }
                }
            }
        }

        // print_r($data);

        $times = [];

        foreach ($data as $id => $info) {
            array_push($times,$info["inspected"]);
        }

        // print_r($times);

        sort($times);

        // print_r($times);

        $max1 = array_pop($times);
        $max2 = array_pop($times);
        
        $result = $max1 * $max2;
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

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["result"]."\r\n"."\r\n";

exit();
