<?php

$servername = "localhost"; 
$port = "3306"; 
$username = "root"; 
$password = isset($_POST["password"]) ? $_POST["password"] : ""; // Check if password is provided 
$dbname = "ashwin"; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    

    $sql = "INSERT INTO register (email, username,password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
   
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sss", $email,  $username, $password); // Assuming name and email are strings, and age is an integer
        
        // Execute the statement
        $stmt->execute();
    
        // Check for errors
        if ($stmt->errno) {
            // Handle error
            echo "<script>alert('Registered successful!');</script>";
            echo "<script>window.location.href = 'welcome.html';</script>";
            // Use header("Location: signin.html"); for PHP redirection
        } else {
            echo "<script>alert('Registered successful!');</script>";
            echo "<script>window.location.href = 'login.html';</script>";
        }
    
        // Close the statement
        $stmt->close();
    } else {
        // Handle prepare error
        echo "Prepare statement error: " . $mysqli->error;
    }
?>
