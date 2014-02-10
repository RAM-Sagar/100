<?php

include("include/config.inc");
echo $_POST[email]."<br />";
$password=md5($_POST[password]);
//echo "SELECT * FROM c_user WHERE email='$_POST[email]'<br>";
$result = mysqli_query($con,"SELECT * FROM a_gent_user WHERE email='$_POST[email]'");
echo mysqli_fetch_array($result);
while($row = mysqli_fetch_array($result))
  {
   // echo $row['password']."==".$password;
  if($password==$row['password']){
    
    echo "<p>Login Success</p>";
    if($row['status']==1){
        
        echo "<p>Active User</p>";
    } else {
        header('Location:/agent/?message=In Active User');
        echo "<p>In Active User</p>";
    }
  } else{
    header('Location:/agent/?message=Login Failed...');
    echo "<p>Login Failed...</p>";
  }
  
  }
header('Location:/agent/?message=Login Failed...');