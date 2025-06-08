<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "E_COMM";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];

// Insert data
$sql = "INSERT INTO checkout (name, email, mobile, address) 
        VALUES ('$name', '$email', '$mobile', '$address')";

if ($conn->query($sql) === TRUE) {
  // Redirect to payment UI
  header("Location: checkout.html");
  exit();
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
