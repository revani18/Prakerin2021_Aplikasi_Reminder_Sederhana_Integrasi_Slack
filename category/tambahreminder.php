<?php  
include 'config/koneksi.php';
include 'SlackWebHook.php';
?>

<div class="card mb-4">
    <div class="card-body">
        <div class="modal-header">
        <h5 class="modal-title">Create Reminder</h5>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_reminder" id="id_reminder" >
            <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id']; ?>">
            <div class="form-group">
                <label for="title">Task :</label>
                <input class="form-control" type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="start">Start Time :</label>
                <input class="form-control" type="datetime-local" name="start" id="start" required>
            </div>
            <div class="form-group">
                <label for="end">End Time :</label>
                <input class="form-control" type="datetime-local" name="end" id="end" required>
            </div>
            <div class="form-group">
                <label for="category">Category :</label>
                <select name="category" class="form-control">
                    <?php
                    echo $id_category=$_GET['id'];
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
        <button type="submit" name="save" class="btn btn-primary waves-effect waves-light">Add Reminder</button>
      </div>
      </form>
    </div>
</div>


<!-- fungsi tambah -->
<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $category = $_POST['category'];
    $id_user = $_POST['id_user'];
    $status = 'schedule';

    $kon->query("INSERT INTO reminder (title, start_time, end_time, id_category, id_user, status) 
    VALUES('$title', '$start', '$end', '$category', '$id_user', '$status')");
    echo "<script>alert('Saved Data');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=reminder&category=".$_POST['category']."'>";


   // Slack Web Hook
    $template_slack = "
    ".$user= $_SESSION['name']." Add Reminder :
    Task: ".$title."
    Start Time: ".date('d F Y H:i', strtotime($start))."
    End Time: ".date('d F Y H:i', strtotime($end))."
    ";

    SlackWebHook::notify_reminder($template_slack);
}
?>
