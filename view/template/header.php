<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library | System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES."/lib/adminlte/"; ?>plugins/summernote/summernote-bs4.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo URL_RESOURCES.'/lib/adminlte/'; ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="public/css/estilo3.css">

  <style>
    /* Custom colors for Navbar */
    .main-header.navbar {
      background-color: #004D40; /* Dark Teal */
    }
    .main-header .navbar-nav .nav-link {
      color: #ffffff; /* White text */
    }
    .main-header .navbar-nav .nav-link:hover {
      color: #FFEB3B; /* Yellow on hover */
    }

    /* Sidebar */
    .main-sidebar {
      background-color: #00796B; /* Teal */
    }
    .main-sidebar .brand-link {
      background-color: #004D40; /* Dark Teal */
    }
    .main-sidebar .brand-text {
      color: #ffffff; /* White text */
    }
    .nav-sidebar .nav-link {
      color: #ffffff; /* White text */
    }
    .nav-sidebar .nav-link.active {
      background-color: #004D40; /* Dark Teal */
    }
    .nav-sidebar .nav-link:hover {
      background-color: #FFEB3B; /* Yellow on hover */
    }

    /* Sidebar User Panel */
    .user-panel .info a {
      color: #ffffff; /* White text */
    }
    .user-panel .info a:hover {
      color: #FFEB3B; /* Yellow on hover */
    }

    /* Custom logout color */
    .user-panel .info a.text-danger {
      color: #D32F2F; /* Red for logout */
    }
    .user-panel .info a.text-danger:hover {
      color: #FFEB3B; /* Yellow on hover */
    }

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo URL_RESOURCES.'/lib/adminlte/'; ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo HTTP_BASE; ?>/home" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo HTTP_BASE; ?>/web/bok/list" class="nav-link">General Register</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <img src="<?php echo URL_RESOURCES.'/lib/adminlte/'; ?>dist/img/librosApilados.png" alt="Library Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Library System</span>
      </a>

      <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo URL_RESOURCES.'/lib/adminlte/'; ?>dist/img/usuario3Bot.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['login']['username']; ?></a>
          </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['login']['email']; ?></a>
          </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="<?php echo HTTP_BASE; ?>/logout" class="d-block text-danger"> 
              <i class="fas fa-sign-out-alt nav-icon"></i> Logout
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Administration
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo HTTP_BASE; ?>/web/bok/list" class="nav-link">
                    <i class="fas fa-book-medical nav-icon"></i>
                    <p>Register Book</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
  </div>
</body>
</html>
