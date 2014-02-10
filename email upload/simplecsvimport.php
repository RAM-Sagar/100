<?php

/********************************/
/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/
/* Edit the entries below to reflect the appropriate values
/********************************/
$databasehost = "localhost";
$databasename = "test";
$databasetable = "sample";
$databaseusername ="test";
$databasepassword = "";
$fieldseparator = ",";
$lineseparator = "\n";
$file=($_FILES['cvs_file']['name']);

$target="Excel/";
$target = $target . basename( $_FILES['csv_file']['name']);
$pic=($_FILES['csv_file']['name']);
$date=date("YmdHis");
$newpic=$date.$pic;
if(move_uploaded_file($_FILES['csv_file']['tmp_name'], $target)) 
{ 

rename("Excel/$pic","Excel/$newpic");

//echo "<a href=Excel/".$newpic.">File</a>";

} 
else { 
echo "Ooops...!";
} 
$csvfile = "Excel/".$newpic;
//$csvfile = "filename.csv";
/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 0;
/********************************/
/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 1;
$outputfile = "output.sql";
/********************************/


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

fclose($file);

include("config.inc");
$lines = 0;
$queries = "";
$linearray = array();

foreach(split($lineseparator,$csvcontent) as $line) {

	$lines++;

	$line = trim($line," \t");
	
	$line = str_replace("\r","",$line);
	
	/************************************
	This line escapes the special character. remove it if entries are already escaped in the csv file
	************************************/
	$line = str_replace("'","\'",$line);
	/*************************************/
	//echo $lines;
	$linearray = explode($fieldseparator,$line);
	
	$linemysql = implode("','",$linearray);
	
	if($addauto){
	   
       $query = "insert into $databasetable values('','$linemysql','ss123456');";
       $res=mysqli_query($con,$query);
       //echo $res;
        if($res){
        //echo "<b style='color:green'>";
        $linemysql1 .=$linemysql."<br />";  
        $to = $linemysql; // Send email to our user  
			$subject = "Hi Friends"; // Give the email a subject
			$from = "100Bonuspoints<100BonusPoints@100bonusPoints.com>";
			$message = " 
            <h3 style='color:sienna;'>Dear Friends</h3>
			<p>I'am using 100bonuspounts and am feeling very happy to use this portal.</p> 
			"; 
          
            $headers .= "Content-type: text/html\r\n"; 					  
			$headers .= "From:" .$from. "\r\n"; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email 
       }else{
        
        //echo "<b style='color:red'>";
        $linemysql2 .=$linemysql."<br />";
        $mailto .=$linemysql;
       }
       //echo $linemysql."</b><br />";
	}
		
	else{
	   
       $query = "insert into $databasetable values('','$linemysql','ss123456');";
       $res=mysqli_query($con,$query);
       //echo $res;
        if($res){
        //echo "<b style='color:green'>";
        $linemysql1 .=$linemysql."<br />";
        //$mailto .=$linemysql;
         $to = $linemysql; // Send email to our user  
			$subject = "Hi Friends"; // Give the email a subject
			$from = "100Bonuspoints<100BonusPoints@100bonusPoints.com>";
			$message = " 
            <h3 style='color:sienna;'>Dear Friends</h3>
			<p>I'am using 100bonuspounts and am feeling very happy to use this portal.</p> 
			"; 
          
            $headers .= "Content-type: text/html\r\n"; 					  
			$headers .= "From:" .$from. "\r\n"; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email 

       }else{
        
        //echo "<b style='color:red'>";
        $linemysql2 .=$linemysql."<br />";
        $mailto .=$linemysql;
       }
       //echo $linemysql."</b><br />";
	}
		
	
	$queries .= $query . "\n";

	@mysql_query($query);
}

@mysql_close($con);

if($save) {
	
	if(!is_writable($outputfile)) {
		echo "File is not writable, check permissions.\n";
	}
	
	else {
		$file2 = fopen($outputfile,"w");
		
		if(!$file2) {
			echo "Error writing to the output file.\n";
		}
		else {
			fwrite($file2,$queries);
			fclose($file2);
		}
	}
	
}
echo "<b style='color:green'>New Data.......................<br /><br />".$linemysql1;
echo "<br /></b><b style='color:red'>Existing Data.......................<br />".$linemysql2;
echo "<br /><br /></b>Found a total of $lines records in this file.\n<br /><br /><br />";
//echo $mailto;
	        $to = $mailto; // Send email to our user  
			$subject = "Hi Friends"; // Give the email a subject
			$from = "100Bonuspoints<100BonusPoints@100bonusPoints.com>";
			$message = " 
            <h3 style='color:sienna;'>Dear Friends</h3>
			<p>I'am using 100bonuspounts and am feeling very happy to use this portal.</p> 
			"; 
          
            $headers .= "Content-type: text/html\r\n"; 					  
			$headers .= "From:" .$from. "\r\n"; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email 

?>
