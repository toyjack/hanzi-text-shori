<?php
function num_2geta($num){
	if ($num<10) {
		return strval("0".$num);
	}
	return $num;
}

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
	}else die("file dosent exist");
}

function write_File($file_name,$data_array){
	$handle=fopen($file_name,"w");
	foreach ($data_array as $line) {
		fwrite($handle,$line);
	}
	fclose($handle);
}

//start
$pages=read_File($argv[1]);
$result=[];
foreach ($pages as $page) {
	for ($i=1; $i < 11; $i++) { 
		$num=num_2geta($i);
		$temp=$page.$num."\n";
		array_push($result,$temp);
	}
}
// print_r($result);
write_File("done_".$argv[1],$result);
echo "Done!\n";