<?php include 'config/koneksi.php'; ?>

<?php  
// session
session_start();

if (isset($_COOKIE['email'])) {
    if ($_COOKIE['email'] == $email) {
        $_SESSION['submit'] = TRUE;

        header('Location: login.php');
    }
}

// cek email pada session
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = 'you must login to access this page';
    header('Location: index.html');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reminder Me</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- custom template calendar -->
    <link rel="stylesheet" type="text/css" href="assets/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">

    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
               <img src="img/LOGO1.png" width="160px" height="45px">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php?halaman=dashboard">
                    <i class="fas fa-fw fa-desktop"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Calendar Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=calendar" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Calendar</span>
                </a>
            </li>

            <!-- Nav Item - Category Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=category"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Category</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Keluar
            </div>

            <!-- Nav Item - Logout Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-white">


            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">
                                    <?php
                                        $tgl = date('Y-m-d');
                                        $iduser = $_SESSION['id'];
                                        $data = mysqli_query($kon,"SELECT * FROM reminder WHERE date(start_time) LIKE '$tgl' AND id_user='$iduser'");
                                        echo mysqli_num_rows($data);
                                    ?>                                    
                                </span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notification
                                </h6>
                                <?php 
                                    include 'config/koneksi.php';
                                    $tgl = date('Y-m-d');
                                    $iduser = $_SESSION['id'];
                                        $data = mysqli_query($kon,"SELECT * FROM reminder WHERE date(start_time) LIKE '$tgl' AND id_user='$iduser'");
                                        while($a=mysqli_fetch_array($data)){
                                     ?>
                                <a class="dropdown-item d-flex align-items-center" href="index.php?halaman=calendar">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-bell text-white"></i>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <?= $a['title'] ?>
                                    </div>
                                    
                                </a>
                                <?php } ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Notification</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                    $id = $_SESSION['id'];
                                    $query=$kon->query("SELECT * FROM users WHERE id = '$id'");
                                    $row=$query->fetch_assoc();
                                ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/<?php echo $row['foto']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index.php?halaman=profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid bg-white">
                    <?php 
                    if (isset($_GET['halaman'])) {
                        $halaman = $_GET['halaman'];
                        switch ($halaman) {
                            case 'dashboard':
                                include "dashboard.php";
                                break;
                            case 'calendar':
                                include "calendar/index.php";
                                break;
                            case 'category':
                                include "category/category.php";
                                break;
                            case 'hapuscategory':
                                include "category/hapuscategory.php";
                                break;
                            case 'reminder':
                                include "category/index.php";
                                break;
                            case 'tambahreminder':
                                include "category/tambahreminder.php";
                                break;
                            case 'editreminder':
                                include "category/editreminder.php";
                                break;
                            case 'hapusreminder':
                                include "category/hapusreminder.php";
                                break;
                            case 'profile':
                                include "profile/index.php";
                                break;
                            case 'editprofile':
                                include "profile/editprofile.php";
                                break;
                             case 'ubahpassword':
                                include "profile/ubahpassword.php";
                                break;
                            default:
                            echo "<center><h3>Maaf, Halaman tidak ditemukan !</h3></center>";
                            break;
                        }
                    }else{
                        include "dashboard.php";
                    }
                    ?>
                </div>


                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>


<script>
    // $(document).on("click", "tombolUbah", function() {
    //     let title = $(this).data('title');
    //     $("#ubahtitle").val(title);
    //     console.log("OKEyu");
    // });
    // let tombolUbah = document.getElementById('tombolUbah');
    // tombolUbah.addEventListener('click', function() {
    //     let dataid = tombolUbah.getAttribute('data-id');
    //     let title = tombolUbah.getAttribute('data-title');
    //     let start = tombolUbah.getAttribute('data-start');
    //     let end = tombolUbah.getAttribute('data-end');

    //     console.log(title);

    //     document.getElementById("ubahid").value = dataid;
    //     document.getElementById("ubahtitle").value = title;
    //     document.getElementById("ubahstart").value = start;
    //     document.getElementById("ubahend").value = end;

    // });
</script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <!-- page calendar -->
    <script src="assets/jquery.min.js"></script>
    <script src="assets/jquery-ui.min.js"></script>
    <script src="assets/moment.min.js"></script>
    <script src="assets/fullcalendar.min.js"></script>

</body>

</html>
