<?php
$con=mysqli_connect("sql210.byethost10.com","b10_14268602","bit2byte123","b10_14268602_100bp");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$mainurl="http://bit2byte.byethost10.com";