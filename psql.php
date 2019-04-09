<?php

$file = fopen("farmers.csv","r");

$all_rows = array();
$header = fgetcsv($file);
while ($row = fgetcsv($file)) {
  $all_rows[] = array_combine($header, $row);
}

// fclose($file);

// foreach ($all_rows as $key => $value) {
// 	$all_rows['status'] = 'Pending';
// }

function dynamicInsert($assoc_array){
    $keys   = array();
    $values = array();
    foreach($assoc_array as $key => $value){
        $keys[]   = $key;
        $values[] = $value;
    }
    $query = "INSERT INTO 'public'.'farmers'('".implode("','", $keys)."') VALUES('".implode("','", $values)."')";
    return $query;
}

$dynamicInsert = [];

// foreach ($all_rows as $key => $value) {
// 	//Invoking the function
// 	$dynamicInsert[] = dynamicInsert($value);
// }


$text = "";
foreach($all_rows as $key => $value) {
    $text .= dynamicInsert($value)."\n";
}

$fh = fopen("query.txt", "w") or die("Could not open log file.");
fwrite($fh, $text) or die("Could not write file!");
// fclose($fh);

// echo "<pre>";
// print_r($all_rows);