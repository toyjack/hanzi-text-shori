<?php 

function read_File($file_name){
	$file=[];
	if (file_exists($file_name)) {
		$handle=fopen($file_name,"r");
		while (!feof($handle)) {
			$line=trim(fgets($handle));
			array_push($file, $line);
		}
		fclose($handle);
		return $file;
	}else die($file_name."ファイルはありません!\n");
}

function write_File($file_name,$data_array){
	$handle=fopen($file_name,"w");
	foreach ($data_array as $line) {
		fwrite($handle,$line);
	}
	fclose($handle);
}




//start
// $data=read_File($argv[1]);
var_dump(IntlChar::ord(" "));