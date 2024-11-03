<?php  
include 'config/koneksi.php';
include 'SlackWebHook.php';
?>

<link rel="stylesheet" type="text/css" href="assets/fullcalendar.css">
<link rel="stylesheet" type="text/css" href="assets/bootstrap.css">


<div class="text-center">
    <h1 class="text-gray">Calendar</h1>
</div>
<br>
<div class="container">
    <div id="calendar"></div>
</div>

<div id="tambahModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Calendar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <?php
            $_SESSION['id'];
        ?>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_reminder" id="id_reminder">
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
                    echo $id_category=$_GET['category'];
                    $id_users = $_SESSION['id'];
                    $sql="select * from category inner join users on users.id=category.id_user where users.id='$id_users' order by id desc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                    <option value="<?php echo $data['id_category']; ?>"><?php echo $data['category']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="save" class="btn btn-primary waves-effect waves-light">Add Reminder</button>
      </div>
      </form>
    </div>
  </div>
</div>
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
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=calendar'>";

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

<!-- <script src="assets/jquery.js"></script> -->
<script src="assets/jquery.min.js"></script>
<script src="assets/jquery-ui.min.js"></script>
<script src="assets/bootstrap.min.js"></script>
<script src="assets/fullcalendar.min.js"></script>
<script src="assets/modal.min.js"></script>

<script>
    $(document).ready(function(){
        var calendar = $('#calendar').fullCalendar({
            // izinkan tabel bisa diedit
            editable: true,
            // atur header calendar
            header:{
                left : 'prev, next today',
                center : 'title',
                right : 'month, agendaWeek, agendaDay'
            },
            // tampilkan data dari database
            events : 'calendar/tampil.php', 
            // izinkan tabel/calendar bisa pilih/edit
            selectable : true,
            selectHelper : true,
            dayClick: function(calEvent, jsEvent, view) {
              new Modal({el: document.getElementById('tambahModal')}).show();

           },
           eventClick: function(event) {
                if (confirm("Are you sure you want to delete this activity?")) {
                    var id_reminder = event.id_reminder;
                    $.ajax({
                        url : "calendar/hapus.php",
                        type : "POST",
                        data :{
                            id_reminder : id_reminder
                        },
                        success : function(){
                            calendar.fullCalendar('refetchEvents');
                            alert('Delete Data Success...!');
                        }
                    });
                }
           }
        });
    });
</script>


<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Aplikasi Reminder Sederhana (Integrasi Slack)</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
