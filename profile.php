<?php

session_start();

if(!isset($_SESSION['user'])){
    
    header('Location:/');
}
include("include/config.inc");
echo $_SESSION[user]."<br />";
$result = mysqli_query($con,"SELECT * FROM c_user WHERE id='$_SESSION[user]'");

while($row = mysqli_fetch_array($result))
  {
   echo $row['name']."<br />";
   echo $row['email']."<br />";
   echo $row['mobile']."<br />";
   echo $row['pin']."<br />";
   echo $row['type']."<br />";
   echo $row['agent_id']."<br />";
   echo $row['hash']."<br />";
    }
    ?>
    <a href="logout.php">Logout</a>