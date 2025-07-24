<?php
// Get form data
$username = $_POST['name'];
$pwd = $_POST['pwd'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$membership = $_POST['membership'];

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'demo');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO joining(username, pwd, email, phone, membership) VALUES (?, ?, ?, ?, ?)");
    
    // Hash the password before inserting (security measure)
    //$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    // Bind parameters: "sss" means three string parameters
    $stmt->bind_param("sssis", $username, $pwd, $email, $phone, $membership);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $conn->close();
}
?>
