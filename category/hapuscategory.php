<?php 

$kon -> query("DELETE FROM category WHERE id_category='$_GET[id]'");

echo "<script>alert('Data Deleted');</script>";
echo "<script>location='index.php?halaman=category';</script>";
?>
