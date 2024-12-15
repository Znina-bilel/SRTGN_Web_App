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
        <a href="gererUtilisateur.php" <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'gererUtilisateur.php') ? 'class="active"' : ''; ?>>
        <i class='bx bx-user' ></i>
          <span class="links_name">Gérer utilisateur</span>
        </a>
        <a href="gererAdministrateur.php" <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'gererAdministrateur.php') ? 'class="active"' : ''; ?>>
        <i class='bx bx-user' ></i>
          <span class="links_name">Gérer administrateur</span>
        </a>
        <a href="gererEquipement.php" <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'gererEquipement.php') ? 'class="active"' : ''; ?>>
        <i class='bx bx-desktop bx-flashing' ></i>
          <span class="links_name">Gérer equipement</span>
        </a>
        <a href="notification.php" <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'notification.php') ? 'class="active"' : ''; ?>>
        <i class='bx bx-bell bx-tada' ></i>
          <span class="links_name">Notification</span>
        </a>
        <a href="intervention.php" <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'notification.php') ? 'class="active"' : ''; ?>>
        <i class='bx bxs-widget bx-flip-vertical bx-spin' style='color:white'  ></i>
          <span class="links_name">Intervention</span>
        </a>
        <a href="indexA.php" >
        <i class='bx bx-log-out'></i>
          <span class="links_name">logout</span>
        </a>
      </li>
      
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        
        <?php
        if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
          echo "<h4>Bonjour, Admin</h4>";
        } else {
          header("Location: indexA.php");
          exit();
        }
        ?>
      </div>
    </nav>
    <!-- Remaining HTML content of your file -->
  </section>
</body>

</html>
