<?php 
//define
define("HEADNAME", "Ls");


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
$data=read_File($argv[1]);
$result=[];
foreach ($data as $line) {
	list($gyo,$num_of_char)=preg_split("/\t/",$line);
	$num_of_char=(int)$num_of_char;
	if ($num_of_char=="X") {
		echo $gyo."行はわからない\n";
		continue;
	}
	if(is_int($num_of_char)){
		for ($i=1; $i <= $num_of_char ; $i++) { 
			$temp=HEADNAME.$gyo."_".num_2geta($i)."\n";
			array_push($result,$temp);
		}
	}
}
write_File("done_".$argv[1],$result);
echo "Done!\ndone_".$argv[1]."ファイルを確認\n";