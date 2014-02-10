<?php 
session_start();
error_reporting(E_ERROR);
//This is the directory where images will be saved 
$target = 'uploadimages/'; 
$target = $target . basename( $_FILES['photo']['name']); 
//This gets all the other information from the form 
$pic=($_FILES['photo']['name']);
$date=date("YmdHis");
//echo $date;
$newpic=$date.$pic;
$imagename=$_POST['imagename'];
$description=$_POST['description'];
//echo $imagename;
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
{ 

rename("uploadimages/$pic","uploadimages/$newpic");

include "config.php";
$user_name=$_SESSION["user_id"];		
$query = "INSERT INTO fobos_pic_info (user_id, name,imagename,description)
		VALUES('$user_name','$newpic','$imagename','$description')";
			mysql_query($query,$con);
			echo "<br><br>".$query;
header("Location: ./uploadfile?msg=success");
} 
else { 
//Gives and error if its not 
header("Location: ./uploadfile?msg=sorry");
} 

?>