
<style>
    a{
        
        font-size: 25px;
        
    }
    p{
        
        font-size: 15px;
    }
</style>
<?php



$search=$_GET['search'];
//$search="sagar";

$con=mysqli_connect("sql210.byethost10.com","b10_14268602","bit2byte123","b10_14268602_100bp");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$query="SELECT * FROM search WHERE header like '%$search%' OR content like '%$search%' ORDER BY date";

//echo $query;
$result=mysqli_query($con,$query);

$num=mysql_numrows($result);

if ($result == "")

{
	echo "<br /><br />No results! <br><p></p><a href=http://bit2byte.byethost10.com/search/> Go back </a>";
} 

else 

   {
	
echo "<h3> Search Results: </h3>";

   }



while($row = mysqli_fetch_array($result))
  {
   echo "<a href='#'>".$row['header']."</a><br />";
   echo $row['content']."<br />";
   echo $row['date']."<br />";
    }

mysql_close();



?>