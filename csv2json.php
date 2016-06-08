<?php
/*
 * modify from https://gist.github.com/robflaherty/1185299
 * Converts CSV to JSON
 * Example uses Google Spreadsheet CSV feed
 * csvToArray function I think I found on php.net
 */
//for MAC
ini_set("auto_detect_line_endings", true);

header('Content-type: application/json');
// Set your CSV feed
$feed = $argv[1];
// Arrays we'll use later
$keys     = array();
$newArray = array();
// Function to convert CSV into associative array
function csvToArray($file, $delimiter)
{
    if (($handle = fopen($file, 'r')) !== false) {
        $i = 0;
        while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== false) {
            for ($j = 0; $j < count($lineArray); $j++) {
                $arr[$i][$j] = $lineArray[$j];
            }
            $i++;
        }
        fclose($handle);
    }
    return $arr;
}
// Do it
$data = csvToArray($feed, "\t");
// Set number of elements (minus 1 because we shift off the first row)
$count = count($data) - 1;

//Use first row for names
$labels = array_shift($data);
foreach ($labels as $label) {
    $keys[] = $label;
}
// Add Ids, just in case we want them later
$keys[] = 'id';
for ($i = 0; $i < $count; $i++) {
    $data[$i][] = $i;
}

// Bring it all together
for ($j = 0; $j < $count; $j++) {
    $d            = @array_combine($keys, $data[$j]);
    $newArray[$j] = $d;
    
    $newnewArray[$newArray[$j]["Entry"]]=$newArray[$j]["IDS"];
}



// Print it out as JSON
echo json_encode($newnewArray, JSON_UNESCAPED_UNICODE);
