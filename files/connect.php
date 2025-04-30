<?php
	$name = $_POST['name'];
	$selector = $_POST['selector'];
	$Placename = $_POST['Placename'];
	$email = $_POST['email'];
	$PhoneNo = $_POST['PhoneNo'];
	$numbers = $_POST['numbers'];
	$selectoptions = $_POST['selectoptions'];

	// Database connection
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "db";
	$conn = new mysqli('localhost','root','','db');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into bio form(name, selector , Placename, email, PhoneNo, numbers, selectoptions) values(?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssiis", $name, $selector, $Placename, $email, $PhoneNo, $numbers, $selectoptions );
		$execval = $stmt->execute();
		echo $execval;
		echo "Submitted successfully...";
		$stmt->close();
		$conn->close();
	}
?>