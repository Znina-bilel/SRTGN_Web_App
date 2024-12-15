<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: indexA.php?error=Both User Name and Password are required");
        exit();
    } else {
        // Use backticks (`) for column names containing special characters
        $stmt = $conn->prepare("SELECT * FROM adminn WHERE `user_name` = :uname");
        $stmt->bindParam(':uname', $uname);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            // Update session variables with the correct column names
            $_SESSION['user_name'] = $user['user-name'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['id'] = $user['id'];
            header("Location: profileA.php");
            exit();
        } else {
            header("Location: indexA.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
