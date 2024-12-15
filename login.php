<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['passworda'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['passworda']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND passworda='$pass'";
        $result = $conn->query($sql);

        if ($result->rowCount() === 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['namea'] = $row['namea'];
            $_SESSION['id'] = $row['id'];
            ?>
            
       <a href='profile.php'>login</a>
<?php


            exit();
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
