<?php

//AOC - Day 7
//php.exe -c "c:\php8.1.0\php.ini" "C:\....\aoc_2022\7\calculate.php"

function addDir2(&$data,$str,$dir){
    $cont = 0;
    if(count($data)==0){
        $data[$str.$dir]["data"] = ["type"=>"dir","name"=>$dir,"str"=>$str.$dir,"data"=>[]];
    }
    else{
        for ($i=0; $i < count($data); $i++) {
            if($data[$i]["type"]=="dir"){
                if(substr($data[$i]["str"],$cont,1) == substr($str,$cont,1))
                    $data[$i]["data"] = ["type"=>"dir","name"=>$dir,"str"=>$str.$dir,"data"=>[]];
                else{
                    for ($j=0; $j < count($data[$i]["data"]); $j++) { 
                        addDir($data[$i]["data"],$str,$dir);
                    }
                }
            }
        }
    }
}

function addDir(&$data,$dir_act,$name){
    // $data[$dir_act.$name] = ["name"=>$name,"type"=>"dir","size"=>0,"data"=>[]];
    $data[$dir_act."#".$name] = ["name"=>$name,"type"=>"dir","size"=>0,"data"=>[]];
}

function addFile(&$data,$dir_act,$filename,$size){
    $data[$dir_act]["data"][] = ["type"=>"file","name"=>$filename,"size"=>$size];
    
    $path = $dir_act;

    while(strstr($path,"#")){
        $data[$path]["size"] += $size;
        // $path = substr($path,0,-1);
        $path = substr($path,0,strrpos($path,"#"));
    }
}

function calculate($file,$part=""){
    //1 - Read from a file
    $file = dirname($_SERVER["SCRIPT_FILENAME"])."\\input".$file.".txt";
    $f = fopen($file,"r");
    
    $data = [];
    $dir_act = '';

    if($part!=2){
        
        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $commands = explode(" ",$line);

            // print_r($commands);
            
            if($commands[1] == 'cd'){
                // $dir_act = $commands[2];
                // $str_dir .= $dir_act;
                // // $data[$str_dir] = ["type"=>"dir","name"=>$dir_act,"str"=>$str_dir, "data"=>[]];
                // addDir($data,$str_dir,$commands[1]);
                if($commands[2]!=".."){
                    // echo "AÑADIMOS DIR ".$commands[2]."\r\n";
                    addDir($data,$dir_act,$commands[2]);
                    // array_push($dir_act,$commands[2]);
                    $dir_act = $dir_act."#".$commands[2];
                }
                else{
                    // $dir_act = substr($dir_act,0,-1);
                    // array_pop($dir_act);
                    $dir_act = substr($dir_act,0,strrpos($dir_act,"#"));
                }
            }
            if(is_numeric($commands[0])){
                // echo "AÑADIMOS FILE ".$commands[1]." SIZE ".$commands[0]."\r\n";
                addFile($data,$dir_act,$commands[1],$commands[0]);
            }

            // print_r($data);
        }

        print_r($data);

        //Queremos todos los directorios que tengan como mucho 100000
        $suma = 0;
        foreach ($data as $key => $value) {
            if($value["size"] <= 100000)
                $suma += $value["size"];
        }

        $result = $suma;

    }
    else{
        while(!feof($f)){ 
            $line = fgets($f);
            $line = rtrim($line);

            $commands = explode(" ",$line);

            // print_r($commands);
            
            if($commands[1] == 'cd'){
                // $dir_act = $commands[2];
                // $str_dir .= $dir_act;
                // // $data[$str_dir] = ["type"=>"dir","name"=>$dir_act,"str"=>$str_dir, "data"=>[]];
                // addDir($data,$str_dir,$commands[1]);
                if($commands[2]!=".."){
                    // echo "AÑADIMOS DIR ".$commands[2]."\r\n";
                    addDir($data,$dir_act,$commands[2]);
                    // array_push($dir_act,$commands[2]);
                    $dir_act = $dir_act."#".$commands[2];
                }
                else{
                    // $dir_act = substr($dir_act,0,-1);
                    // array_pop($dir_act);
                    $dir_act = substr($dir_act,0,strrpos($dir_act,"#"));
                }
            }
            if(is_numeric($commands[0])){
                // echo "AÑADIMOS FILE ".$commands[1]." SIZE ".$commands[0]."\r\n";
                addFile($data,$dir_act,$commands[1],$commands[0]);
            }

            // print_r($data);
        }

        // print_r($data);

        $maxsize = 70000000;
        $used = $data["#/"]["size"];

        echo "SIZE: ".$used."\r\n";

        $unused = $maxsize - $used;

        echo "UNUSED: ".$unused."\r\n";

        $need = 30000000 - $unused;

        echo "NEED: ".$need."\r\n";

        // Queremos el directorio cuyo tamaño sea superior a la cantidad de espacio necesitado (need)
        $suma = 0;
        $min = 999999999;
        $values = [];
        foreach ($data as $key => $value) {
            echo "SIZE ".$value["size"]."\r\n";
            $values[] = $value["size"];
            if($value["size"] >= $need){
                if($value["size"]<$min)
                    $min = $value["size"];
            }
                
        }

        echo "MIN: ".$min."\r\n";

        sort($values);

        print_r($values);

        $result = $min;
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
