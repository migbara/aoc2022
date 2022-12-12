<?php

//AOC - Day 12
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\12\calculate.php"

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

function getStart($data){
    $x = '';
    $y = '';
    for ($i=0; $i < count($data); $i++) { 
        for ($j=0; $j < count($data[$i]); $j++) { 
            if($data[$i][$j]=='S'){
                $x = $i;
                $y = $j;
                break 2;
            }
        }
    }

    return ["x"=>$x,"y"=>$y];
}

function findPath($maxPend,$x,$y,$data,$path,$steps,$visitados,&$paths,&$pasos){
    // echo "FROM ".$x.",".$y." [".$data[$x][$y]."]"."\r\n";
    // print_r($path);
    // if($data[$x][$y]!='E')
    //     $visited[$x][$y] = true;
    // North
    if($steps < min($pasos)-1){
        if($y>0){
            // We found the top
            if($data[$x][($y-1)]=='E' && (ord($data[$x][$y]) <= ord("z")) && (abs(ord($data[$x][$y]) - ord("z")) <= $maxPend)){
                // echo "FINAL HACIA EL NORTE"."\r\n";

                // array_push($path,[$x,($y-1)]);
                // array_push($paths,$path);
                $steps++;
                array_push($pasos,$steps);
                echo "ENCONTRADO CAMINO CON ".count($path)." PASOS ".$steps."\r\n";
            }
            else{
                //Is possible to go
                if( ($data[$x][$y]=='S' || ($data[$x][$y]!='S' && (ord($data[$x][$y]) <= ord($data[$x][($y-1)])) && (abs(ord($data[$x][$y]) - ord($data[$x][($y-1)])) <= $maxPend) )) && (!isset($visitados[$x][($y-1)])) ){
                    // echo "FROM ".$x.",".$y." ";
                    // echo "NOS VAMOS AL NORTE ".$x.",".($y-1)."\r\n";

                    $p = $path;
                    $v = $visitados;
        
                    // array_push($p,[$x,($y-1)]);
                    $v[$x][($y-1)] = 'X';
                    $s = $steps + 1;
                    findPath($maxPend,$x,($y-1),$data,$p,$s,$v,$paths,$pasos);
                }
            }

        }
        // South
        if($y<count($data[$x])-1){
            // We found the top
            if($data[$x][($y+1)]=='E' && (ord($data[$x][$y]) <= ord("z")) && (abs(ord($data[$x][$y]) - ord("z")) <= $maxPend)){
                // echo "FINAL HACIA EL SUR"."\r\n";

                // array_push($path,[$x,($y+1)]);
                // array_push($paths,$path);
                $steps++;
                array_push($pasos,$steps);
                echo "ENCONTRADO CAMINO CON ".count($path)." PASOS ".$steps."\r\n";
            }
            else{
                //Is possible to go

                // echo ord($data[$x][$y])." ".ord($data[$x][($y+1)])." ".abs(ord($data[$x][$y]) - ord($data[$x][($y+1)]))."\r\n";

                if( ($data[$x][$y]=='S' || ($data[$x][$y]!='S' && (ord($data[$x][$y]) <= ord($data[$x][($y+1)])) && (abs(ord($data[$x][$y]) - ord($data[$x][($y+1)])) <= $maxPend) )) && (!isset($visitados[$x][($y+1)])) ){
                    // echo "FROM ".$x.",".$y." ";
                    // echo "NOS VAMOS AL SUR ".$x.",".($y+1)."\r\n";

                    $p = $path;
                    $v = $visitados;
        
                    // array_push($p,[$x,($y+1)]);
                    $v[$x][($y+1)] = 'X';
                    $s = $steps + 1;
                    findPath($maxPend,$x,($y+1),$data,$p,$s,$v,$paths,$pasos);
                }
            }

        }
        // West
        if($x>0){
            // We found the top
            if($data[($x-1)][$y]=='E' && (ord($data[$x][$y]) <= ord("z")) && (abs(ord($data[$x][$y]) - ord("z")) <= $maxPend)){
                // echo "FINAL HACIA EL OESTE"."\r\n";

                // array_push($path,[($x-1),$y]);
                // array_push($paths,$path);
                $steps++;
                array_push($pasos,$steps);
                echo "ENCONTRADO CAMINO CON ".count($path)." PASOS ".$steps."\r\n";
            }
            else{
                //Is possible to go
                if( ( $data[$x][$y]=='S' || ($data[$x][$y]!='S' && (ord($data[$x][$y]) <= ord($data[($x-1)][$y])) && (abs(ord($data[$x][$y]) - ord($data[($x-1)][$y])) <= $maxPend) ) ) && (!isset($visitados[($x-1)][$y])) ){
                    // echo "FROM ".$x.",".$y." ";
                    // echo "NOS VAMOS AL OESTE ".($x-1).",".$y."\r\n";

                    $p = $path;
                    $v = $visitados;
        
                    // array_push($p,[($x-1),$y]);
                    $v[($x-1)][$y] = 'X';
                    $s = $steps + 1;
                    findPath($maxPend,($x-1),$y,$data,$p,$s,$v,$paths,$pasos);
                }
            }

        }
        // East
        if($x<count($data)-1){
            // We found the top
            if($data[($x+1)][$y]=='E' && (ord($data[$x][$y]) <= ord("z")) && (abs(ord($data[$x][$y]) - ord("z")) <= $maxPend)){
                // echo "FINAL HACIA EL ESTE"."\r\n";

                // array_push($path,[($x+1),$y]);
                // array_push($paths,$path);
                $steps++;
                array_push($pasos,$steps);
                echo "ENCONTRADO CAMINO CON ".count($path)." PASOS ".$steps."\r\n";
            }
            else{
                //Is possible to go
                if( ( $data[$x][$y]=='S' || ($data[$x][$y]!='S' && (ord($data[$x][$y]) <= ord($data[($x+1)][$y])) && (abs(ord($data[$x][$y]) - ord($data[($x+1)][$y])) <= $maxPend) ) ) && (!isset($visitados[($x+1)][$y])) ){
                    // echo "FROM ".$x.",".$y." ";
                    // echo "NOS VAMOS AL ESTE ".($x+1).",".$y."\r\n";

                    $p = $path;
                    $v = $visitados;
        
                    // array_push($p,[($x+1),$y]);
                    $v[($x+1)][$y] = 'X';
                    $s = $steps + 1;
                    findPath($maxPend,($x+1),$y,$data,$p,$s,$v,$paths,$pasos);
                }
            }

        }
    }
}

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $data = [];
    $pasos = [999999999];
    $paths = [];
    $j = 0;

    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);  

        for ($i=0; $i < strlen($line); $i++) { 
            // if(!isset($data[$i][$j]))
            //     $data[$i][$j] = [];

            $data[$i][$j] = substr($line,$i,1);
            $visited[$i][$j] = false;
        }
        $j++;

    }

    if($part!=2){
        
        // print_r($data);
        // print_r($visited);

        $start = getStart($data);

        $path = [];
        $visitados = [];

        $maxPend = 1;

        $steps = 0;

        findPath($maxPend,$start["x"],$start["y"],$data,$path,$steps,$visitados,$paths,$pasos);

        // print_r($paths);

        // $maxs = [];

        // foreach ($paths as $key => $path) {
        //     // echo count($path)."\r\n";
        //     array_push($maxs,count($path));
        // }

        // sort($maxs);

        // // print_r($maxs);

        // $result = array_shift($maxs);

        // print_r($pasos);

        $result = min($pasos);

    }
    else{

        $results = checkVisibles($data);

        $result = $results["maxviews"];
        
    }
    

    return ["result"=>$result];
}

$INT_MAX = 0x7FFFFFFF;

function MinimumDistance($distance, $shortestPathTreeSet, $verticesCount)
{
	global $INT_MAX;
	$min = $INT_MAX;
	$minIndex = 0;

	for ($v = 0; $v < $verticesCount; ++$v)
	{
		if ($shortestPathTreeSet[$v] == false && $distance[$v] <= $min)
		{
			$min = $distance[$v];
			$minIndex = $v;
		}
	}

	return $minIndex;
}

function PrintResult($distance, $verticesCount)
{
	echo "<pre>" . "Vertex    Distance from source" . "</pre>";

	for ($i = 0; $i < $verticesCount; ++$i)
		echo "<pre>" . $i . "\t  " . $distance[$i] . "</pre>";
}

function Dijkstra($graph, $source, $verticesCount)
{
	global $INT_MAX;
	$distance = array();
	$shortestPathTreeSet = array();

	for ($i = 0; $i < $verticesCount; ++$i)
	{
		$distance[$i] = $INT_MAX;
		$shortestPathTreeSet[$i] = false;
	}

	$distance[$source] = 0;

	for ($count = 0; $count < $verticesCount - 1; ++$count)
	{
		$u = MinimumDistance($distance, $shortestPathTreeSet, $verticesCount);
		$shortestPathTreeSet[$u] = true;

		for ($v = 0; $v < $verticesCount; ++$v)
			if (!$shortestPathTreeSet[$v] && $graph[$u][$v] && $distance[$u] != $INT_MAX && $distance[$u] + $graph[$u][$v] < $distance[$v])
				$distance[$v] = $distance[$u] + $graph[$u][$v];
	}

	PrintResult($distance, $verticesCount);
}

function calculate2($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $data = [];
    $pasos = [999999999];
    $paths = [];
    $j = 0;

    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);  

        for ($i=0; $i < strlen($line); $i++) { 
            // if(!isset($data[$i][$j]))
            //     $data[$i][$j] = [];

            $data[$i][$j] = substr($line,$i,1);
            // $visited[$i][$j] = false;
        }
        $j++;

    }

    if($part!=2){
        
        print_r($data);

        Dijkstra($data, 0, 4);

    }
}


function calculate3($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $data = [];
    $pasos = [999999999];
    $paths = [];
    $j = 0;

    while(!feof($f)){ 
        $line = fgets($f);
        $line = rtrim($line);  

        for ($i=0; $i < strlen($line); $i++) { 
            // if(!isset($data[$i][$j]))
            //     $data[$i][$j] = [];

            $data[$i][$j] = substr($line,$i,1);
            $visited[$i][$j] = false;
        }
        $j++;

    }

    if($part!=2){
        
        // print_r($data);


    }
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

exit();
$part20 = calculate('',2);
echo "PART 2 1"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part20["result"]."\r\n"."\r\n";

$part2 = calculate(1,2);
echo "PART 2"."\r\n";
echo "---------------------------------------"."\r\n";
echo "RESULT ".$part2["result"]."\r\n"."\r\n";

