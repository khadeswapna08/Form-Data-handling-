<?php
// Database configuration
$servername = "localhost"; // Assuming your MySQL server is on localhost
$username = "root"; // MySQL username (default is root for XAMPP)
$password = ""; // MySQL password (default is empty for XAMPP)
$database = "ajax_form_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the connection is successful, continue with your PHP code here
// Example: Inserting form data into a table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // SQL query to insert data into the table
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        // If data insertion is successful
        $response = [
            'success' => true,
            'name' => $name,
            'email' => $email
        ];
        echo json_encode($response);
    } else {
        // If there is an error in the SQL query
        $response = [
            'success' => false,
            'error' => $conn->error
        ];
        echo json_encode($response);
    }
} else {
    // If accessed without a POST request, deny access
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Access denied']);
}

// Close the connection
$conn->close();
?>
