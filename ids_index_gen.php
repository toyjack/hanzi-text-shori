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
//start
$file = read_File($argv[1]); //read file
$data = [];
//read file to data[]
foreach ($file as $line) {
    list($unicode, $entry, $ids) = preg_split("/\t/", $line);
    $data[$entry]                = $ids;
}

foreach ($data as $key => $value) {
    $ids_string = preg_split("//u", $value, -1, PREG_SPLIT_NO_EMPTY);
    //从这里开始写广度优先算法
    //BFS以队列来实现
    //
    echo $ids_string[0];
    unset($value); //clean value
}
