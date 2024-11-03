<?php  
	// mulai session
	session_start();
	// menghapus session
	if (session_destroy()) {
	// cek cookie
	if (isset($_COOKIE['email'])) {
		$time = time();

		setcookie('email', $time - 3600);
	}
		
		// jika berhasil maka akan diredirect ke file index.php
		header("Location: index.php");
		exit();
	}
?>