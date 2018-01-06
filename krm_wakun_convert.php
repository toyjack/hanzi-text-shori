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

function seek($haystack, $needle)
{
    if (strlen($needle) > strlen($haystack)) {
        die('wrong seek term!');
    }

    $seeks = array();
    while ($seek = strrpos($haystack, $needle)) {
        $seeks[]  = $seek;
        $haystack = substr($haystack, 0, $seek);
    }
    return $seeks;
}

function dakuon($term = '')
{
    switch ($term) {
        case 'カ':
            return 'ガ';
            break;
        case 'キ':
            return 'ギ';
            break;
        case 'ク':
            return 'グ';
            break;
        case 'ケ':
            return 'ゲ';
            break;
        case 'コ':
            return 'ゴ';
            break;

        case 'サ':
            return 'ザ';
            break;
        case 'シ':
            return 'ジ';
            break;
        case 'ス':
            return 'ズ';
            break;
        case 'セ':
            return 'ゼ';
            break;
        case 'ソ':
            return 'ゾ';
            break;

        case 'タ':
            return 'ダ';
            break;
        case 'チ':
            return 'ヂ';
            break;
        case 'ツ':
            return 'ヅ';
            break;
        case 'テ':
            return 'デ';
            break;
        case 'ト':
            return 'ド';
            break;

        case 'ハ':
            return 'バ';
            break;
        case 'ヒ':
            return 'ビ';
            break;
        case 'フ':
            return 'ブ';
            break;
        case 'ヘ':
            return 'ベ';
            break;
        case 'ホ':
            return 'ボ';
            break;

        default:
            return '□';
            break;
    }
    return $term;
}

mb_regex_encoding('UTF-8');
mb_internal_encoding('UTF-8');

// start here
if (!$argv[1]) {
    die("need a file\n");
}

$file = read_File($argv[1]); //read file
print("Line Num:".count($file)."\n");
foreach ($file as $line) {
    $temp = mb_split('\t', $line);
    // print($temp[1]."\t");
    // if (preg_match('/\([LHSN@"]+\)/u', $temp[1])) {
    //     // print("matched\n");
    // }else{
    //     // print("not matched\n");
    // }
    $term = $temp[0];
    $def  = $temp[1];
    $tones="";
    // print($term."\t".$def."\n");
    if (preg_match('/\(.+\)/u', $def)) {
        // 義注の訓と声調を分離する
        $a   = mb_split('\(', $def);
        $def = $a[0];
        //　最後の括弧を除く
        $tones = mb_substr($a[1], 0, -1);
    }

    // 踊り字を処理
    if (preg_match('/ヽ/u', $def)) {
    	$pos=seek($def,"ヽ");
    	$l = mb_strlen($def, 'UTF-8');
        for ($i = 0; $i < $l; $i++) {
            $kun_split[] = mb_substr($def, $i, 1, 'UTF-8');
        }


    }




    //　濁音処理
    if (preg_match('/"/u', $tones)) {
        // search for "
        $pos = seek($tones, '"');
        // explode t $kun
        $l = mb_strlen($def, 'UTF-8');
        for ($i = 0; $i < $l; $i++) {
            $kun_split[] = mb_substr($def, $i, 1, 'UTF-8');
        }
        // 修改所有浊音
        foreach ($pos as $p) {
            // array pos fix
            $p -= 1;
            $kun_split[$p] = dakuon($kun_split[$p]);
        }
        // 清空$kun_split
        $def       = implode($kun_split);
        $kun_split = array();
    }

    print($term . "\t" . $def . "\n");

}
