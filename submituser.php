<?php 

$con = mysql_connect("localhost","kai","kai");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}

if (mysql_query("CREATE DATABASE dbWinner",$con))
{
	//echo "Database created";
	mysql_select_db("dbWinner", $con);
	$sql = "CREATE TABLE Winners 
	(
		winnerID int NOT NULL AUTO_INCREMENT, 
		PRIMARY KEY(winnerID),
		Name varchar(20),
		Queens int,
		DateFin varchar(20)
	)";
	mysql_query($sql,$con); 
}
else
{
	//echo "Database found";
	//echo "Error creating database: " . mysql_error();
}
	

mysql_select_db("dbWinner", $con);


$Data = $_POST["fname"]; 
if ($Data != "")
{
	$sql="INSERT INTO Winners (Name, Queens, DateFin)
	VALUES
	('" . $Data . "'," . $_POST[fqueen] . ",'" . $_POST[fdate] . "')";

	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}

}

$result = mysql_query("SELECT * FROM Winners");

echo "<table border='1'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Queens</th>";
echo "<th>Time</th>";
echo "</tr>";

while($row = mysql_fetch_array($result))
{

	echo "<tr>";
	echo "<td>" . $row['Name'] . "</td>";
	echo "<td>" . $row['Queens'] . "</td>";
	echo "<td>" . $row['DateFin'] . "</td>";
	echo "</tr>";
}

echo "</table>";
mysql_close($con);

 ?>
