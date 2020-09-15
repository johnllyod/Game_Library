 <?php
$servername = "db4free.net";
$username = "personalsql";
$password = "17jtheskull";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else 
{
	$db_select = mysqli_select_db($conn, "game_lib");
}
?> 