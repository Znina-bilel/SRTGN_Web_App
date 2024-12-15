<?php
session_start();
include_once 'function.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style1.css" />
  <!-- Boxicons CDN Link -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <div class="sidebar" style="background-color: #a89415;">
    <div class="logo-details">
    <i class='bx bx-home' ></i>
      <span class="logo_name">MyGRE</span>
    </div>
    <ul class="nav-links">
      <li>
        <style>
          .sidebar .nav-links li a:hover {
            background: #584f16;
          }

          .sales-boxes .box .button a {
            color: #fff;
            background: #584f16;
            padding: 4px 12px;
            font-size: 15px;
            font-weight: 400;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
          }

          .home-content .box .cart.three {
            color: #584f16;
            background: #ffe8b3;
          }

          .sidebar .nav-links li a.active {
            background: #584f16;
          }

          .sidebar .nav-links li a:hover {
            background: #584f16;
          }
        </style>
        <a href="#" class="active">
        <i class='bx bx-user' ></i>
          <span class="links_name">profile</span>
        </a>
        <a href="index.php" >
        <i class='bx bx-log-out'></i>
          <span class="links_name">logout</span>
        </a>
      </li>
      
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        
        <!--<span class="dashboard">Dashboard</span>-->
        
        <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>
    <h4>Bonjour, <?php echo $_SESSION['user_name']; ?></h4>
<?php 
} else {
    header("Location: index.php");
    exit();
}
?>



      </div>
      <!--<div class="search-box">
        <input type="text" placeholder="Recherche..." />
        <i class="bx bx-search"></i>
      </div>
      <div class="profile-details">
        <img src="images/profile.jpg" alt="">
        <span class="admin_name">Komche</span>
        <i class="bx bx-chevron-down"></i>-->
      </div>
    </nav>