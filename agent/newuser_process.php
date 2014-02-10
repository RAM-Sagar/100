<?php



include("../include/config.inc");
//echo "md5 of ".$_POST[password]." is ".$password;


$result = mysqli_query($con,"SELECT * FROM c_user");
$count=0;
while($row = mysqli_fetch_array($result))
  {
   
  if($_POST[email]==$row['email']){
    
   $count++;
  } 
  
  }


if($count==0){
    
    
    $alpha = "abcdefghijklmnopqrstuvwxyz";
$alpha_upper = strtoupper($alpha);
$numeric = "0123456789";
$special = ".-+=_,!@$#*%<>[]{}";
$chars = "";
 
if (isset($_POST['length'])){
    // if you want a form like above
    if (isset($_POST['alpha']) && $_POST['alpha'] == 'on')
        $chars .= $alpha;
     
    if (isset($_POST['alpha_upper']) && $_POST['alpha_upper'] == 'on')
        $chars .= $alpha_upper;
     
    if (isset($_POST['numeric']) && $_POST['numeric'] == 'on')
        $chars .= $numeric;
     
    if (isset($_POST['special']) && $_POST['special'] == 'on')
        $chars .= $special;
     
    $length = $_POST['length'];
}else{
    // default [a-zA-Z0-9]{9}
    $chars = $alpha . $alpha_upper . $numeric;
    $length = 9;
}
 
$len = strlen($chars);
$pw = '';
 
for ($i=0;$i<$length;$i++)
        $pw .= substr($chars, rand(0, $len-1), 1);
 
// the finished password
$pw = str_shuffle($pw);


$password=md5($pw);
$hash = uniqid(md5(mt_rand()));
$name=strtoupper($_POST[name]);
//echo $hash."<br />".mt_rand();
    $sql="INSERT INTO c_user (name, email, mobile, password, pin, status, hash, agent_id)
VALUES ('$name','$_POST[email]','$_POST[phone]','$password',$_POST[pin],'0','$hash',$_POST[agent_id])";
mysqli_query($con,$sql);
if(mysqli_query){



			
			$to = $_POST[email]; // Send email to our user  
			$subject = 'Signup | Verification'; // Give the email a subject
			$from = "100BonusPoints<100BonusPoints@100bonuspoints.com>";
			$message = ' 
			 
			Thanks for signing up! 
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
			 
            
			Please click this link to activate your account: 
			 
			'.$mainurl.'/verify.php?email='.$to.'&hash='.$hash.' 
            Login with this credentials
            
            Email: '.$to.'
			Password: '.$pw.' 
			'; // Our message above including the link  
								  
			$headers = "From:" .$from; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email  
            
            echo "Accont has been created with ".$to." to verify... :)";
            
} else {
    
    echo "NOT OK";
}
}else {
    
    echo $_POST[email]." alredy exist..";
}