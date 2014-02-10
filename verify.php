<?php  
//echo $_GET['email'];
echo "<br />";
//echo $_GET['hash'];
$email = $_GET['email']; // Set email variable
	$hash = $_GET['hash']; // Set hash variable
//echo "<br />UPDATE c_user SET status='1' WHERE email='".$email."' AND hash='".$hash."' AND status='0'";
include "include/config.inc";
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
	// Verify data
	
$search = mysqli_query($con,"SELECT * FROM c_user WHERE email='".$email."' AND hash='".$hash."' AND status='0'") or die(mysql_error());   
$match  = mysqli_num_rows($search); 
$result=mysqli_num_rows($match); 
//echo $match;
if($match > 0){  
    // We have a match, activate the account  
	$query="UPDATE c_user SET status='1' WHERE email='".$email."' AND hash='".$hash."' AND status='0'";
	mysqli_query($con,$query) or die(mysql_error());  
	echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
		echo '<div><a href="'.$mainurl.'">Login</a></div>';
}
else{  
    // No match -> invalid url or account has already been activated.
		echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>'; 
}
}
else
{
// Invalid approach  
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';  
} 
           
?> 