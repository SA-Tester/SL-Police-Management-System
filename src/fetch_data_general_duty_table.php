<?php
// Replace these database credentials with your actual values
$servername = 'localhost';
$username = 'Testuser';
$password = 'Testuser';
$dbname = 'sl-police';

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// SQL query to fetch data from the table for duty_type = "General"
$sql = "SELECT empID, duty_type,duty_cause, start, end, location_id FROM duty WHERE duty_type = 'General'";

// Execute the query and get the result set
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Initialize an array to hold the fetched data
    $data = array();

    // Loop through the result set and store each row in the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Close the result set
    $result->close();

    // Close the database connection
    $conn->close();

    // Convert the array to JSON format and send it as the response
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // No "General" duties found in the table
    // Close the database connection
    $conn->close();

    // Return an empty array as the response
    header('Content-Type: application/json');
    echo json_encode(array());
}
?>
