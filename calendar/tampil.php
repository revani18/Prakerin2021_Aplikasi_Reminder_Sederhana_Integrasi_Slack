<?php  

session_start();

include '../config/koneksi.php';

$id_users=$_SESSION['id'];
$tampil = mysqli_query($kon, "SELECT * FROM reminder WHERE id_user='$id_users' order by id_reminder");

$dataArr = array();
while ($data = mysqli_fetch_array($tampil)) {
	
	$dataArr[] = array(
		'id_reminder' => $data['id_reminder'],
		'title' => $data['title'],
		'start' => $data['start_time'],
		'end' => $data['end_time'],
		'category' => $data['id_category'],
		'id_user' => $data['id_user']
	);
}

echo json_encode($dataArr);

?>
