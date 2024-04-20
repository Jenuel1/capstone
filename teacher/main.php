<?php
include '../assets/controller/conn.php';
session_start();
date_default_timezone_set('Asia/Manila'); 

if (empty($_SESSION['teacher'])) {
 
  header("Location: ../error-page-404.php");

} else {

  $teacher_id = $_SESSION['teacher'];

  $getname = mysqli_query($conn, "SELECT * FROM teacheraccount WHERE id ='$teacher_id' ");
  while ($row = mysqli_fetch_object($getname)) {
    $name = $row->name;
    $lastname = $row->lastname;
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-DocuPro Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

  <!-- Favicons -->
  <link href="../assets/img/titlelogo.png" rel="icon">
  <link href="../assets/img/titlelogo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">



  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!--JQUERY-->
  <script src="../assets/js/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/css/jquery-ui.min.css">
  <script src="../assets/js/jquery-ui.min.js"></script>

  <!-- DATA TABLE CSS -->
  <link rel="stylesheet" href="../assets/datatables/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="../assets/datatables/css/responsive.bootstrap5.css">

  <!--DATE RANGE CSS-->
  <link rel="stylesheet" href="../assets/daterangepicker/daterangepicker.css"></script>

  <link rel="stylesheet" href="../assets/calendar/fullcalendar.min.css"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logonew.png" alt="">
        <span class="d-none d-lg-block">DocuPro</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <aside id="sidebar" class="sidebar">
  
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span></a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="folders.php">
          <i class="bi bi-folder"></i>
          <span>File Category</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="documents.php">
        <i class="bi bi-file-earmark-text-fill"></i>
          <span>All documents</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="archives.php">
        <i class="bi bi-archive"></i>
          <span>Archive</span></a>
      </li>

 
      <li class="nav-heading">Account Settings</li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#profile-nav" data-bs-toggle="collapse" href="#" id="navPic">
          <?php
          $selectPic = mysqli_query($conn, "SELECT * FROM teacheraccount WHERE id = '$teacher_id' ");
          $fetchpic = mysqli_fetch_array($selectPic);
          $pic = $fetchpic['pic'];

          if (empty($pic)) {
            ?>
            <img src="../assets/profileimg/default.jpg">
            <?php

          } else {
            ?>
            <img src="../assets/profileimg/<?php echo $pic; ?>">
            <?php
          }
          ?>
          <span class="text-capitalize">
            <?php echo $name." ".$lastname; ?>
          </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="profile-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="profile.php">
              <span>My Profile</span>
            </a>
          </li>

          <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#logout">
              <span>Sign Out</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->


    </ul>

  </aside><!-- End Sidebar-->
  <!-- MODAL LOG OUT -->
  <div class="modal" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Logout <i class="bi bi-lock"></i></h5>
        </div>
        <div class="modal-body">
          <h6>Are you sure you want to logout?</h6>
        </div>
        <div class="modal-footer">
          <li><a href="#" id="close" data-bs-dismiss="modal">Close</a></li>
          <li><a href="../signout.php" id="confirm">Logout</a></li>
        </div>
      </div>
    </div>
  </div>

