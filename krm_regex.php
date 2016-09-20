<?php
function read_File($file_name)
{
    $file = [];
    if (file_exists($file_name)) {
        $handle = fopen($file_name, "r");
        while (!feof($handle)) {
            $line = trim(fgets($handle));
            array_push($file, $line);
        }
        fclose($handle);
        return $file;
    } else {
        die($file_name . "ファイルはありません!\n");
    }
    
}

function write_File($file_name, $data_array)
{
    $handle = fopen($file_name, "w");
    foreach ($data_array as $line) {
        fwrite($handle, $line);
    }
    fclose($handle);
}

mb_regex_encoding('UTF-8');
mb_internal_encoding('UTF-8');

// start here
if (!$argv[1]) die("need a file\n");
$file = read_File($argv[1]); //read file

//行を読んで
foreach ($file as $line) {
    // 行はカタカナ有無かを判断
    if (preg_match('/\p{Katakana}/u', $line)) {
        $output[]= $line."\t◯訓あり\n";
    }else{
        $output[]= $line."\t×訓なし\n";
    }
}
// done
write_File('kun.txt',$output);
