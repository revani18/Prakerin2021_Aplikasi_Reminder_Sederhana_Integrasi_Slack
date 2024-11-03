<?php  
include 'config/koneksi.php';
?>

<div class="text-center">
    <h1 class="text-gray">Reminder</h1>
</div>
<br>

<div class="card mb-4">
    <div class="card-header">
        <?php
        $_SESSION['id'];
        $id_category=($_GET['category']);
        ?>
        <a href="index.php?halaman=tambahreminder&id=<?php echo $id_category ?>" id="btn-tambah-reminder" class="btn btn-primary"><span class="text"><i class="glyphicon glyphicon-plus"></i> Create Reminder</span></a>
    </div>
    <div class="card-body">

        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Task</th>
                    <th class="text-center">Start Time</th>
                    <th class="text-center">End Time</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
                // include database
                include 'config/koneksi.php';
                // perintah sql untuk menampilkan daftar reminder

                $id_category=($_GET['category']);
                $sql="select * from reminder inner join category on category.id_category=reminder.id_category where category.id_category='$id_category' order by id_reminder desc";
        
                $hasil=mysqli_query($kon,$sql);
                $no=0;

                //Menampilkan data dengan perulangan while
                while ($data = mysqli_fetch_array($hasil)):
                $no++;
            ?>
            <tr>
                <td class="text-center"><?php echo $no; ?></td>
                <td><?php echo $data['title']; ?></td>
                <td><?php echo $data['start_time']; ?></td>
                <td><?php echo $data['end_time']; ?></td>
                <td><?php echo $data['category'];  ?></td>
                <td><?php echo $data['status'];  ?></td>
                
                <td class="text-center">   
                    <a href="index.php?halaman=editreminder&id=<?php echo $id_category ?>&id_reminder=<?php echo $data['id_reminder']; ?>" class="btn btn-info text-white" id="tombolUbah">Edit</a> 
                    <a href="index.php?halaman=hapusreminder&id=<?php echo $data['id_reminder']; ?>" class="btn btn-success text-white">Done</a>
                </td>
                
            </tr>
            <!-- bagian akhir (penutup) while -->
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Footer -->
<footer class="sticky-footer fixed">
    <div class="container my-auto">
        <div class="copyright text-center ml-5 my-auto">
            <span>Copyright &copy; Aplikasi Reminder Sederhana (Integrasi Slack)</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->