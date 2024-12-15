<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <form action="loginAdmin.php" method="post">
        <h2>LOGIN<img src="Nabeul.png" alt="" width="100px"> </h2>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit"><a href="profileA.php" >
        
          <span class="links_name">login</span>
          <i class='bx bx-log-in'></i>
        </a>
        </button>
    </form>
</body>
</html>
