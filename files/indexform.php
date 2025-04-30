<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['selector']) &&
        isset($_POST['Placename']) && isset($_POST['email']) &&
        isset($_POST['PhoneNo']) && isset($_POST['numbers'])&& 
        isset($_POST['selectoptions'])) {
        
            $name = $_POST['name'];
            $selector = $_POST['selector'];
            $Placename = $_POST['Placename'];
            $email = $_POST['email'];
            $PhoneNo = $_POST['PhoneNo'];
            $numbers = $_POST['numbers'];
            $selectoptions = $_POST['selectoptions'];
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbname = "db";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM bio form WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO bio form(name, selector , Placename, email, PhoneNo, numbers, selectoptions) values(?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssiis", $name, $selector, $Placename, $email, $PhoneNo, $numbers, $selectoptions );
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>