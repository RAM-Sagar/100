<?php

include("include/config.inc");

$result = mysqli_query($con,"SELECT * FROM c_user");
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
$sql="INSERT INTO c_user (name, email, mobile, password, pin, status, type, hash, agent_id)
VALUES ('$name','$_POST[email]','$_POST[phone]','$password',$_POST[pin],'0','free','$hash',$_POST[agent_id])";
mysqli_query($con,$sql);
if(mysqli_query){



			
			$to = $_POST[email]; // Send email to our user  
			$subject = 'Signup | Verification'; // Give the email a subject
			$from = "100Bonuspoints<100BonusPoints@100bonusPoints.com>";
			$message = " 
            <h3 style='color:sienna;'>Dear ".$name."</h3>
			Thanks for signing up! 
			<p>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
			 </p>
            
			
			 
			<a style='color:green;' href='".$mainurl."/verify.php?email=".$to."&hash=".$hash."'>Please click here to activate your account</a> 
            <p><u>Login with this credentials</u></p>
            
            <p>Email: ".$to."</p>
			<p>Password: ".$_POST[password]."</p> 
			"; 
            
            $headers .= "Content-type: text/html\r\n"; 					  
			$headers .= "From:" .$from. "\r\n"; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email  
            
            echo "Check your ".$to." to verify... :)";
            
} else {
    
    echo "NOT OK";
}
}else {
    
    echo $_POST[email]." alredy exist..";
}