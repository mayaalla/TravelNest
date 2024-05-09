<?php
include("db.php"); // Ensure you have your database connection file included

header('Content-Type: application/json'); // Set the header to return JSON

$searchTerm = $_GET['search'] ?? ''; // Get the search term from the URL parameter

if (!empty($searchTerm)) {
    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM your_table WHERE name LIKE ?");
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param("s", $searchTerm); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array

    echo json_encode($data); // Encode the data to JSON and output
} else {
    echo json_encode([]); // Return an empty array if no search term is provided
}

$stmt->close();
$conn->close();
?>