<?php
if (!$argv[1]) {
	die("\nAuthor: Liu Guanwei\n英数字を全角から半角に、かなを半角から全角に変更します。\n\nMust with a filename!\n後ろにファイル名が必要です。\n必须加上要转换的文件名。\nExample:\n\tphp han2zen.php genkai.txt\n");
}

mb_language("Ja");
mb_internal_encoding("utf-8");
$fileHankaku=fopen($argv[1],"r") or die("Can't open file");
$fileZenkaku=fopen("HANKAKU_".$argv[1],"w") or die("Can't write file");

while (!feof($fileHankaku)) {
	$line=fgets($fileHankaku);
	$newline=mb_convert_kana($line,"rsnKHV");
	echo $newline;
	fwrite($fileZenkaku,$newline);
}

fclose($fileHankaku);
fclose($fileZenkaku);
echo "Done!\n完成!\n";