<?php
require_once("settings.php");

// Establish a database connection
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve search criteria from the form
$JobReferenceNumber = mysqli_real_escape_string($conn, $_POST["JobReferenceNumber"]);
$FirstName = mysqli_real_escape_string($conn, $_POST["FirstName"]);
$LastName = mysqli_real_escape_string($conn, $_POST["LastName"]);

// Create and execute the SQL query with LIKE and wildcard %
$query = "SELECT * FROM eoi WHERE JobRefNo LIKE '%$JobReferenceNumber%' AND FirstName LIKE '%$FirstName%' AND LastName LIKE '%$LastName%'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Database query failed: " . mysqli_error($conn);
} else {
    // Display the search results in a table
    echo "<h2>Search Results</h2>";
    echo "<table border=\"1\">";
    echo "<tr><th>Job reference number</th><th>First name</th><th>Last name</th><th>Street Address</th><th>Suburb town</th><th>State</th><th>Postcode</th><th>Email address</th><th>Phone number</th><th>Skills</th><th>Other skills</th><th>Status</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["JobRefNo"] . "</td>";
        echo "<td>" . $row["FirstName"] . "</td>";
        echo "<td>" . $row["LastName"] . "</td>";
        echo "<td>" . $row["StreetAddress"] . "</td>";
        echo "<td>" . $row["SuburbTown"] . "</td>";
        echo "<td>" . $row["State"] . "</td>";
        echo "<td>" . $row["Postcode"] . "</td>";
        echo "<td>" . $row["EmailAddress"] . "</td>";
        echo "<td>" . $row["PhoneNumber"] . "</td>";
        echo "<td>" . $row["Skills"] . "</td>";
        echo "<td>" . $row["OtherSkills"] . "</td>";
        echo "<td>" . $row["Status"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Close the database connection
mysqli_close($conn);
?>
