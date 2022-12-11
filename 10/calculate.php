<?php

//AOC - Day 10
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\10\calculate.php"

function check($cycles,$x,&$values){
    if(($cycles == 20) || (($cycles-20) % 40 == 0)){
        // echo "CICLES ".$cycles." X ".$x."\r\n";
        $values[$cycles] = $cycles * $x;
    }
}

function changeSprite(&$sprite,$x){
    if($x==-1)
        $sprite = "#".str_repeat(".", (40 - ($x+2)));
    if($x==0)
        $sprite = "##".str_repeat(".", (40 - ($x+2)));
    if($x>0 && $x<39){
        $sprite = str_repeat(".", ($x-1))."###".str_repeat(".", (40 - ($x+2)));
    }
    if($x==39){
        $sprite = str_repeat(".", ($x-1))."##";
    }
    if($x==40){
        $sprite = str_repeat(".", ($x-1))."#";
    }
}

function drawRow(&$row,&$panel,$sprite){
    $row .= substr($sprite,strlen($row),1);
    // echo "ROW     ".$row."\r\n";

    if(strlen($row)==40){
        $panel[] = $row;
        $row = '';
    }
}

function drawPanel($panel){
    foreach ($panel as $line) {
        echo $line."\r\n";
    }
}

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $values = [];
    $data = [];

    //Get steps
    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);

        $data[] = $line;

    }

    // print_r($data);


    if($part!=2){
        
        // print_r($data);

        $x = 1;
        $cycles = 0;
        $i = 1;

        foreach ($data as $v) {
            
            if($v=="noop"){
                $cycles++;
                check($cycles,$x,$values);
            }
            else{
                $d = explode(" ",$v);
                $add = $d[1];
                $cycles++;
                check($cycles,$x,$values);
                

                // echo "i - ".$i." v ".$v." CICLES ".$cycles." X ".$x."\r\n";

                $cycles++;
                check($cycles,$x,$values);
                $x += $add;
            }
            // echo "i ".$i." v ".$v." CICLES ".$cycles." X ".$x."\r\n";
            $i++;
        }

        // print_r($values);

        $result = array_sum($values);
    }
    else{

        // print_r($data);

        $x = 1;
        $cycles = 0;
        $i = 1;

        $panel = [];
        $sprite = "###.....................................";
        // echo "SPRITE: ".$sprite."\r\n";

        $row = "";

        foreach ($data as $v) {

            
            
            if($v=="noop"){
                $cycles++;
                check($cycles,$x,$values);
                drawRow($row,$panel,$sprite);
            }
            else{
                $d = explode(" ",$v);
                $add = $d[1];
                $cycles++;
                check($cycles,$x,$values);
                drawRow($row,$panel,$sprite);

                // echo "i - ".$i." v ".$v." CICLES ".$cycles." X ".$x."\r\n";

                $cycles++;
                check($cycles,$x,$values);
                drawRow($row,$panel,$sprite);
                
                $x += $add;
                // $sprite = str_repeat(".", ($x-1))."###".str_repeat(".", (40 - ($x+2)));
                changeSprite($sprite,$x);
                // echo "SPRITE: ".$sprite."\r\n";
            }
            // echo "i ".$i." v ".$v." CICLES ".$cycles." X ".$x."\r\n";
            $i++;
        }
        //echo "ROW ".$row."\r\n";

        drawPanel($panel);

        $result = 0;
        
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
