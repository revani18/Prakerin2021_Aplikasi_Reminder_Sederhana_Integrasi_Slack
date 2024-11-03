<?php  
// koneksi 
require('config/koneksi.php');

// memulai session
session_start();

$error = '';


// cek apakah session email tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['email'])) header('Location: index.php');

// cek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // cek apakah data yg diinputkan pada form ada yg kosong atau tidak
    if (!empty(trim($email)) && !empty(trim($password)) ) {

        // select data berdasarkan email dari db
        $query = "SELECT * FROM users WHERE email = '$email' and password='$password'";
        $result = mysqli_query($kon, $query);
        $row = mysqli_fetch_assoc($result);
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['foto'] = $row['foto'];


                if (isset($_POST['remember'])) {
                    $time = time();

                    setcookie('email', $email, $time = 3600);
                }


                header('Location: index.php');

        // jika gagal maka akan menampilkan pesan error
        } else {
            $error = 'User Registration Failed !!';
        }
    } else {
        $error = 'Data cannot be empty !!'; 
    }

    $error = 'Wrong email or password !!';
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


    <title>Reminder Me | Login</title>

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
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <?php if ($error != '') { ?>
                                            <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                                        <?php } ?>


                                        <div class="form-group">
                                            <input class="form-control form-control-user" type="email" name="email" placeholder="Email" autofocus="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-user" type="password" name="password" placeholder="Password"value="">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" value="true">
                                                <label class="custom-control-label" for="remember">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                        <a class="small" href="lupa_password.php">Forgot Password?</a>
                                    </div>
                                        
                                        <button class="btn btn-primary btn-user btn-block mt-4" type="submit" name="submit">Login</button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="signup.php">Create an Account! Sign Up!</a>
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