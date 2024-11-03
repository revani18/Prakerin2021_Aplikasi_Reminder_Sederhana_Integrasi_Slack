<?php  
include 'config/koneksi.php';
include 'SlackWebHook.php';
?>

<div class="card mb-4">
    <div class="card-body">
        <div class="modal-header">
        <h5 class="modal-title">Edit Reminder</h5>
      </div>
      <div class="modal-body">
        <?php
            include 'config/koneksi.php';

            //mengquery data dengan query
            $id_reminder=$_GET['id_reminder'];
            $query = "SELECT * FROM reminder WHERE id_reminder='$id_reminder'";
            $jabar = mysqli_query($kon,$query);
            $e = mysqli_fetch_assoc($jabar);
         ?>
        <form method="post">
            <input type="hidden" name="id_reminder" id="id_reminder" value="<?php echo $e["id_reminder"]; ?>">
            <div class="form-group">
                <label for="title">Task :</label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $e["title"]; ?>">
            </div>
            <div class="form-group">
                <label for="start">Start Time :</label>
                <input type="text" id="date-format" name="start" class="form-control floating-label" value="<?php echo $e["start_time"]; ?>">
            </div>
            <div class="form-group">
                <label for="end">End Time :</label>
                <input type="text" id="date-format" name="end" class="form-control floating-label" value="<?php echo $e["end_time"]; ?>">
            </div>
            <div class="form-group">
                <label for="category">Category :</label>
                <select name="category" class="form-control" value="<?php echo $e["category"]; ?>">
                     <?php
                    $id_category=$_GET['id'];
                    include 'config/koneksi.php';
                    $sql="select * from category where id_category='$id_category' limit 1";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                    <option value="<?php echo $data['id_category']; ?>"><?php echo $data['category']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <?php  
            $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
        ?>
        <a href="<?php echo $url ?>" class="btn btn-secondary">Back</a>
        <?php
        $id_category = $_GET['id'];
        ?>
        <button type="submit" name="ubah" class="btn btn-info text-white waves-effect waves-light">Update</button>
      </div>
      </form>
    </div>
</div>

<!-- fungsi edit -->
 <?php
// cek apakah tombol submit sudah dipencet atau belum?
if ( isset($_POST["ubah"]) ) {
    $id = $_POST["id_reminder"];
    $title = $_POST["title"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $category = $_POST["category"];
    $id_user = $_POST['id_user'];
    $status = 'schedule';

  $query = "UPDATE reminder SET
                          title = '$title',
                          start_time = '$start',
                          end_time = '$end',
                          id_category = '$category'
                          WHERE id_reminder = $id";
  $u = mysqli_query($kon, $query);

  if($u){
    echo "<script>alert('Update Data Success');</script>";

    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=reminder&category=".$_POST['category']."'>";
  } else{
    echo $id, $title, $start, $end, $category;
  }

  // Slack Web Hook
    $template_slack = "
    ".$user= $_SESSION['name']." Update Reminder :
    Task: ".$title."
    Start Time: ".date('d F Y H:i', strtotime($start))."
    End Time: ".date('d F Y H:i', strtotime($end))."
    ";

    SlackWebHook::notify_reminder($template_slack);
 
}
 
?>
