

<div class="card" style="max-width: 550px;">
	<div class="row no-gutters">
		<div class="col-md-4">
			<?php
				$id = $_SESSION['id'];
			    $query=$kon->query("SELECT * FROM users WHERE id = '$id'");
			    $row=$query->fetch_assoc();
			?>
			<img src="img/<?php echo $row['foto']; ?>" class="card-img" alt="...">
		</div>
		<div class="col-md-8">
			<div class="card-body">
				<h2 class="card-title">Profile</h2>
				<p class="card-text">
					<?php  
						include 'config/koneksi.php';
						
						$id = $_SESSION['id'];
						$query= "SELECT * FROM users WHERE id = '$id' ";
						$result= mysqli_query($kon, $query);

						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_array($result)) {
								"id :". $row['id']."<br>";
								echo "Name : " . $row['name']. "<br>";
								echo "Email : " . $row['email']. "<br>";
								"foto :" . $row['foto']."<br>";
							}
						}
					?>
				</p>
			</div>
		</div>
	</div>
</div>
<br>

<br>
<div>
	<a href="index.php?halaman=editprofile&id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary text-white" id="tombolUbah">Edit Profile</a>
	<a href="index.php?halaman=ubahpassword&id=<?php echo $_SESSION['id']; ?>" class="btn btn-info text-white" id="tombolPass">Change Password</a>
</div>
