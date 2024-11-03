<?php
    $server="localhost";
    $user="root";
    $password="";
    $db="db_reminder";
    
    $kon = mysqli_connect($server,$user,$password,$db);
    if (!$kon){
          die("Koneksi gagal:".mysqli_connect_error());
    }
?>