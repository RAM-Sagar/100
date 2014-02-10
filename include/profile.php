<?php

session_start();
include("include/config.inc");
echo $_SESSION['user'];
$result = mysqli_query($con,"SELECT * FROM c_user WHERE email='$_POST[email]'");

while($row = mysqli_fetch_array($result))
  {
   echo $row['name'];
    }