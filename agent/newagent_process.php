<?php

include("../include/config.inc");

$result = mysqli_query($con,"SELECT * FROM a_gent_user");
$count=0;
while($row = mysqli_fetch_array($result))
  {
   
  if($_POST[email]==$row['email']){
    
   $count++;
  } 
  
  }


if($count==0){
    
$password=md5($_POST[password]);
$hash = uniqid(md5(mt_rand()));
//echo $hash."<br />".mt_rand();
$name=strtoupper($_POST[name]);
//echo "md5 of ".$_POST[password]." is ".$password;
$sql="INSERT INTO a_gent_user (name, email, mobile, password, pin, status, hash, agent_id)
VALUES ('$name','$_POST[email]','$_POST[phone]','$password',$_POST[pin],'0','$hash',$_POST[agent_id])";
mysqli_query($con,$sql);
if(mysqli_query){



			
			$to = $_POST[email]; // Send email to our user  
			$subject = 'Signup | Verification'; // Give the email a subject
			$from = "100Bonuspoints<100BonusPoints@100bonusPoints.com>";
			$message = ' 
			 
			Thanks for signing up! 
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
			 
            
			Please click this link to activate your account: 
			 
			'.$mainurl.'/verify.php?email='.$to.'&hash='.$hash.' 
            Login with this credentials
            
            Email: '.$to.'
			Password: '.$_POST[password].' 
			'; // Our message above including the link  
								  
			$headers = "From:" .$from; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email  
            
            echo "Check your ".$to." to verify... :)";
            
} else {
    
    echo "NOT OK";
}
}else {
    
    echo $_POST[email]." alredy exist..";
}