

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Reminder Me | Reset Password</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block "><a href="index.html"><img src="img/Logo2.png"></a></div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">RESET YOUR PASSWORD</h1>
                                    </div>

                                    <?php  
                                    if ($_GET['key'] && $_GET['reset']) {
                                        include('config/koneksi.php');
                                        $email = $_GET['key'];
                                        $pass = $_GET['reset'];

                                        $select = mysqli_query($kon, "SELECT email, password FROM users WHERE email='$email' AND md5(password)='$pass'");
                                        if (mysqli_num_rows($select)==1) {
                                        
                                    ?>
                                    <form class="user" method="post">


                                        <div class="form-group">
                                            <input class="form-control form-control-user" type="password" name="password" id="password" onkeyup='check();' placeholder="New Password" autofocus="">
                                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                                            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
                                        </div>

                                        <div class="form-group">
                                            <input class="form-control form-control-user" type="password" name="konfirmasi" id="confirm_password" onkeyup='check();' placeholder="Repeat Password">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block mt-4" type="submit" name="submit_password" id="btnSubmit">RESET</button>
                                        <hr>

                                        <div class="text-center">
                                        <a class="small" href="login.php">Not you? Return Login</a>
                                        </div>
                                    </form>
                                    <?php  
                                } else {
                                    echo "Data tidak ditemukan";
                                }
                            }
                                    ?>

                                    <?php  
                                    if (isset($_POST['submit_password'])) {
                                        include('config/koneksi.php');
                                        $email=$_POST['email'];
                                        $pass=md5($_POST['password']);

                                        $select=mysqli_query($kon, "UPDATE users SET password='$pass' WHERE email='$email'") or die(mysqli_error());
                                        if ($select) {
                                            echo "<script> alert('Reset Password Success'); window.location = 'login.php'; </script>";
                                        } else {
                                            echo "<script> alert('Failed To Save'); window.location = 'reset_password.php'; </script>";
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>