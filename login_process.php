<?php

include("include/config.inc");
echo $_POST[email]."<br />";
$password=md5($_POST[password]);
//echo "SELECT * FROM c_user WHERE email='$_POST[email]'<br>";
$result = mysqli_query($con,"SELECT * FROM c_user WHERE email='$_POST[email]'");

while($row = mysqli_fetch_array($result))
  {
   // echo $row['password']."==".$password;
  if($password==$row['password']){
    
    echo "<p>Login Success</p>";
    if($row['status']==1){
        session_start();
        $_SESSION['user']=$row['id'];
        $_SESSION['id']=$row['hash'];
        header('Location:profile.php');
        //echo "<p>Active User</p>";
    } else {
        
        echo "<p>In Active User</p>";
    }
  } else{
    
    echo "<p>Login Failed...</p>";
  }
  
  }
