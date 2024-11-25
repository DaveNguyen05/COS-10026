<?php
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$JobReferenceNumber = mysqli_real_escape_string($conn, $_POST["JobReferenceNumber"]);
$FirstName = mysqli_real_escape_string($conn, $_POST["FirstName"]);
$LastName = mysqli_real_escape_string($conn, $_POST["LastName"]);
$Status = mysqli_real_escape_string($conn, $_POST["Status"]);

$query = "UPDATE `eoi` SET Status = '$Status' WHERE JobRefNo = '$JobReferenceNumber' AND FirstName = '$FirstName' AND LastName = '$LastName'";

if (!empty($JobReferenceNumber) && !empty($FirstName) && !empty($LastName) && !empty($Status)) {
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Database query failed: " . mysqli_error($conn);
    } else {
        echo "<h2>Update Successful</h2>";
        echo '<a href="manage.php">Manage</a>';
    }
} else {
    echo "Please provide all required details.";
}

mysqli_close($conn);
?>
