<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Login page">
  <meta name="keywords" content="Assignment1 about">
  <meta name="author" content="DGD">
  <link href="styles/style.css" rel="stylesheet">
  <title>Assignment2 login page</title>
</head>

<div id="container">

  <header>
    <?php include './inc/header.inc'; ?>
    <?php include './inc/menu.inc'; ?>
  </header>

  <body>
  <div class="bg-image"></div>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label> Username</label>
        <input type="text" name="uname" placeholder="Username"><br>
        <label> Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Login</button>
        <?php include './inc/footer.inc'; ?>
    </form>
  </body>
</div>
</html>