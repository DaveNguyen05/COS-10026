<?php
require_once("settings.php");

// Establish a database connection
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve search criteria from the form
$JobReferenceNumber = mysqli_real_escape_string($conn, $_POST["JobReferenceNumber"]);

// Create and execute the SQL query with LIKE and wildcard %
$query = "DELETE FROM eoi WHERE JobRefNo LIKE '%$JobReferenceNumber%'";
if (!empty($JobReferenceNumber)) {
    $result = mysqli_query($conn, $query);
}

if (!$result) {
    echo "Database query failed: " . mysqli_error($conn);
} else {
    // Display the search results in a table
    echo "<h2>Delete Successful</h2>";
    echo '<a href="manage.php">Manage</a>';
    
}

// Close the database connection
mysqli_close($conn);
?>
