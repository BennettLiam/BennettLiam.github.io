<?php
$servername = "localhost";
$username = "schooltimes";
$password = "";
$dbname = "my_schooltimes";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['buy'])&&isset($_GET['item']) && isset($_GET['price'])) {
	$item = $_GET['item'];
	$price = $_GET['price'];
	$sql="SELECT Item FROM Market WHERE Item='$item' AND Price='$price'";
	$result = $conn->query($sql);

	if($result->num_rows == 0) {
		echo "0";
	} 
	else {
		$item = $_GET['item'];
		$price = $_GET['price'];
		$sql = "DELETE FROM Market WHERE Item='$item' AND Price='$price' LIMIT 1";
		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		}
		else {
			echo "Error deleting record: " . $conn->error;
		}
	}	
}
else if (isset($_GET['item']) && isset($_GET['price'])) {
	$item = $_GET['item'];
	$price = $_GET['price'];
	$sql = "INSERT INTO Market (Item, Price) VALUES ('$item', '$price')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	}
	else {
		echo "Error: " . $sql . "<br />" . $conn->error;
	}
}
else {
	$sql = "SELECT Item, Price FROM Market";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {

		// output data of each row

		while ($row = $result->fetch_assoc()) {
			echo $row["Item"] . "@" . $row["Price"] . ",";
		}
	}
	else {
		echo "0 results";
	}

	$conn->close();
}

?>