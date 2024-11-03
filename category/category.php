 <?php include "config/koneksi.php"; ?>

<div class="text-center">
    <h1 class="text-gray">Category</h1>
</div>
<br>

<div class="card mb-4">
    <div class="card-header">
        <button type="button" id="btn-tambah-category" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><span class="text"><i class="glyphicon glyphicon-plus"></i> Create Category</span></button>
        <?php
            $_SESSION['id'];
        ?>
    </div>
    <div class="card-body col-lg-6">
        <table class="table table-bordered text-dark fixed" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center" width="250px">Category</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
                // include database
                include 'config/koneksi.php';
                // perintah sql 
                $id_users = $_SESSION['id'];
                $sql="select * from category inner join users on users.id=category.id_user where users.id='$id_users' order by id desc";
                $hasil=mysqli_query($kon,$sql);
                $no=0;
                //Menampilkan data dengan perulangan while
                while ($data = mysqli_fetch_array($hasil)):
                $no++;
            ?>
            <tr>
                <td class="text-center"><?php echo $no; ?></td>
                <td><?php echo  $data['category'];  ?></td>
                
                <td class="text-center">  
                    <a href="index.php?halaman=reminder&category=<?php echo $data['id_category'];?>"><button class="btn btn-success">Detail</button></a> 
                    <a href="index.php?halaman=hapuscategory&id=<?php echo $data['id_category'];?>"><button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category reminder list?')">Delete</button></a>
                </td>
            </tr>
            <!-- bagian akhir (penutup) while -->
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<!-- Button trigger modal -->
<!-- Modal tambah -->
<div id="tambahModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_category" id="id_category">
            <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id']; ?>">
            <div class="form-group">
                <label for="category">Category :</label>
                <input class="form-control" type="text" name="category" id="category" placeholder="Enter Category Name" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="save" class="btn btn-primary waves-effect waves-light">Add Category</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<?php
if (isset($_POST['save'])) {   
    $id_user = $_POST['id_user'];
    $category = $_POST['category'];

    $query = $kon->query("INSERT INTO category(category, id_user) 
    VALUES('$category', '$id_user')");

    if($query){
        echo "<script>alert('Saved Data');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=category'>";
    }
}
?>

<!-- Footer -->
<footer class="sticky-footer fixed">
    <div class="container my-auto">
        <div class="copyright text-center ml-5 my-auto">
            <span>Copyright &copy; Aplikasi Reminder Sederhana (Integrasi Slack)</span>
        </div>
    </div>
</footer>
