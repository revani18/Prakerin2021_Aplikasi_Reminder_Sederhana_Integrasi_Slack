<?php
    $query=$kon->query("SELECT * FROM users WHERE id='$_GET[id]'");
    $row=$query->fetch_assoc();
?>

<div class="card mb-4">
    <div class="card-body">
        <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="" id="">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Old Photo</label>
              <div class="col-sm-10">
                  <img src="img/<?php echo $row['foto']; ?>" width="300px">
              </div>
            </div>
            <div class="form-group">
                <label for="file">Photo</label>
                <input class="form-control" type="file" name="foto" id="file">
            </div>
      </div>
      <div class="modal-footer">
        <?php  
            $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
        ?>
        <a href="<?php echo $url ?>" class="btn btn-secondary">Back</a>
        <button type="submit" name="ubah" class="btn btn-primary text-white waves-effect waves-light">Update</button>
      </div>
      </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $name = $_POST['name'];
    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    if (!empty($lokasi)) {
        move_uploaded_file($lokasi,"img/".$foto);
        $kon->query("UPDATE users SET name='$_POST[name]',foto='$foto'  WHERE id='$_GET[id]'");
    }else{
        $kon->query("UPDATE users SET name='$_POST[name]' WHERE id='$_GET[id]'");
    }
    echo "<script>alert('Update Data Success...!');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=profile'>";
}
?>


