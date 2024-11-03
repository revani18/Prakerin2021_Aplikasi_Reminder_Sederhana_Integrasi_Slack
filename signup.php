<?php  
// koneksi 
require('config/koneksi.php');

// memulai session
session_start();

$error = '';

// cek apakah form sign up di submit atau tidak
if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $foto = 'users.jpg';

    // cek apakah data yg diinputkan pada form ada yg kosong atau tidak
    if (!empty(trim($name)) && !empty(trim($email)) && !empty(trim($password))) {
        
        // memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
        if (cek_nama($name, $kon) == 0) {
            
            // hashing password sebelum disimpan didatabase
            $pass = md5($password);

            // insert data ke db
            $query = "INSERT INTO users (name,email,password,foto) VALUES ('$name', '$email', '$pass', '$foto')";
            $result = mysqli_query($kon, $query);

            {
                header('Location: login.php');
            }

            
            // jika gagal maka akan menampilkan pesan error
            } else {
                $error = 'User Registration Failed !!';
            }
        } else {
            $error = 'Email already registered !!';
        }
    
    $error = 'Data cannot be empty !!'; 
}


// fungsi untuk mengecek email apakah sudah terdaftar atau belum
function cek_nama($email, $kon){
    $nama = mysqli_real_escape_string($kon, $email);
    $query = "SELECT * FROM users WHERE email = '$nama' ";
    if ($result = mysqli_query($kon, $query)) 
        return mysqli_num_rows($result);
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

    <title>Reminder Me | Sign Up</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="assets/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                 <div class="row">
                            <div class="col-lg-6 d-none d-lg-block d-flex"><a href="index.html"><img src="img/Logo2.png"></a></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">SIGN UP</h1>
                            </div>
                            <form class="user" action="" method="post">
                                <?php if ($error != '') { ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                                <?php } ?>
                                <div class="form-group">
                                    <input class="form-control form-control-user"  type="text" name="name" placeholder="Full Name" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-user"  type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-user" type="password" name="password" placeholder="Password">
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit" name="register">Sign Up</button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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