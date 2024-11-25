<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Home Page</title>
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body>
        <h2>Hello, <?php echo $_SESSION['user_name']; ?></h2>
        <a href="logout.php"></a>
    </body>
    </html>
    <?php
}
else {
    header("Location: login_page.php");
    exit();
}
?>