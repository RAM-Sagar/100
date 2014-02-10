<?php
$lineseparator="\n";
$csvfile="Excel/201401300220561.txt";
echo "<a href=".$csvfile.">122</a><br />";
	if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
}

$file = fopen($csvfile,"r");

if(!$file) {
	echo "Error opening data file.\n";
	exit;
}

$size = filesize($csvfile);

if(!$size) {
	echo "File is empty.\n";
	exit;
}

$csvcontent = fread($file,$size);
//echo $csvcontent;
fclose($file);
$lines=0;
$linearray = array();
foreach(split($lineseparator,$csvcontent) as $line) {

	$lines++;

	$line = trim($line," \t");
	
	$line = str_replace("\r","",$line);
    
    $line = str_replace("'","\'",$line);
    
	$linearray = explode($fieldseparator,$line);
	
	$linemysql = implode("','",$linearray);
    echo $linemysql;
    }
?>