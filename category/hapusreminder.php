<?php 
include 'config/koneksi.php';

$previous = $_SERVER['HTTP_REFERER'];

$kon -> query("UPDATE reminder SET status = 'done' WHERE id_reminder = '$_GET[id]'");

;

echo "<script>alert('Schedule Has Been Completed');</script>";
echo "<script>location='$previous';</script>";

?>