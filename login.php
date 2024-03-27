<?php
// Ensure username and password are set
if(isset($_POST['username']) && isset($_POST['password'])) {
    $servername = "localhost";
    $port = "3306"; // Default MySQL port
    $username = "root";
    $password = $_POST["password"]; // No need for isset as it's checked above
    $dbname = "ashwin";

    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data and sanitize them
    $username = $_POST['username'];
    // No need to retrieve password again

    // Prepare statement
    $stmt = $conn->prepare("SELECT * FROM register WHERE username=? AND password=?");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ss", $username, $password); // Password should be string type

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists
            // Redirect to next page
            header("Location: homepage.html");
            exit(); // Ensure that script execution stops here to prevent further output
        } else {
            // User does not exist
            echo json_encode(array("success" => false, "error" => "Invalid username or password"));
        }

        // Close the result
        $result->close();
        // Close the statement
        $stmt->close();
    } else {
        // Handle prepare error
        echo json_encode(array("success" => false, "error" => "Prepare statement error: " . $conn->error));
    }

    // Close connection
    $conn->close();
} else {
    // Handle missing username or password
    echo json_encode(array("success" => false, "error" => "Username or password not provided"));
}
?>
