<?php
// 「人    音仁(L")二ン　ヒト(HL)　ワレ(LL)　サニ　マホル　ユク」
// を
// 「人   音仁(L")二ン
// 人   ヒト(HL)
// 人   ワレ(LL)
// 人   サニ
// 人   マホル
// 人   ユク」
// へ変換する
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

//start
if (!$argv[1]) die("need a file\n");
$file = read_File($argv[1]); //read file

foreach ($file as $line) {
    //掲出字と義注を分離
    $line_splited=mb_split('\t', $line);
    //義注をさらに分離
    if ($line_splited) {
        $defs=mb_split('\s', $line_splited[1]);
    } else break;
    // generate a map
    foreach ($defs as $term) {
        if ($term) {
            $data[$line_splited[0]][]=$term;
        }
        
    }
}

// $dataはすべてのデータ
// print_r($data);
foreach ($data as $key => $value) {
    $line=$key;
    // print_r($value);
    foreach ($value as $term) {
        // $line.="\t".$term;
        $output[]=$key."\t".$term."\n";
    }
}

write_File("output.txt",$output);
