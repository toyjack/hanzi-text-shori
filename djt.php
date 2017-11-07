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
$data=array();
$list=read_File('./list.txt');
foreach ($list as $l) {
	$data[$l]="";
}


if (!$argv[1]) die("need a file\n");
$file = read_File($argv[1]); //read file

foreach ($file as $line) {
	if (preg_match('/^.+\t.+\t/u', $line)) {
		$a=mb_split('\t', $line);
		$data[$a[0]].=$a[1];
		}
		//for kanji

}


foreach ($data as $key => $value) {
	print($key."\t".$value."\n");
}
