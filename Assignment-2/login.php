<?php
session_start();
include("phpenhancements.php");

if(isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = validate($_POST['uname']);
$pass = validate($_POST['password']);

if(empty($uname)) {
    header ("Location: login_page.php?error=Username is require");
    exit();
}
else if(empty($pass)) {
    header ("Location: login_page.php?error=Password is require");
    exit();
}

$sql ="SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
     echo "Logged In";
      $_SESSION['user_name'] = $row['username'];
       $_SESSION['name'] = $row['name'];
       $_SESSION['id'] = $row['id'];
       header("Location: login_home_page.php");
       exit();
}
else{
    header("Location: login_page.php");
    exit();
}