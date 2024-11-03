<?php 
include '../config/koneksi.php';

if (isset($_POST['id_reminder'])) {
	$id = $_POST['id_reminder'];
	mysqli_query($kon, "DELETE FROM reminder WHERE id_reminder = '$id' ");
}

?>