<?php 
    include 'config/koneksi.php';
    if (isset($_POST['submit'])) :
        extract($_POST);
        if ($old_password!="" && $password!="" && $confirm_pwd!="") :
            $id = $_SESSION['id'];
            $old_pwd= md5($_POST['old_password']);
            $pwd= $_POST['new_password'];
            $c_pwd= $_POST['confirm_pwd'];
            if ($pwd == $c_pwd) :
                if ($pwd!=$old_pwd) :
                    $db_check=$kon->query("SELECT * FROM users WHERE id='$id' AND password='$old_pwd'");
                    $count=mysqli_num_rows($db_check);
                    if ($count==1) :
                        $pass = md5($pwd);
                        $fetch=$kon->query("UPDATE users SET password='$pass' WHERE id='$id'");
                        $old_password=''; $password=''; $confirm_pwd='';
                        $msg_sucess= "Your New Password Update Successfully.";
                    else :
                        $error = "The Password you gave is incorrect.";
                        endif;
                else :
                    $error = "Old Password New Password Same Please Try Again.";
                endif;
            else :
                $error = "New Password and Confirm Password Do Not Matched";
            endif;
        else:
            $error = "Please fil all the fields";
        endif;
    endif;
?>

<style type="text/css">
.error{
margin-top: 6px;
margin-bottom: 0;
color: #fff;
background-color: #D65C4F;
display: table;
padding: 5px 8px;
font-size: 11px;
font-weight: 600;
line-height: 14px;
  }
  .green{
margin-top: 6px;
margin-bottom: 0;
color: #fff;
background-color: green;
display: table;
padding: 5px 8px;
font-size: 11px;
font-weight: 600;
line-height: 14px;
  }
</style>

<div class="card mb-4">
    <div class="card-body">
        <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
      </div>
      <div class="modal-body">
        <form method="post" autocomplete="off" id="ubahpassword">
            <input type="hidden" name="id" id="id">
      <div class="form-group">
                <label for="passlama">Current Password </label>
                <input type="password" class="form-control" name="old_password" value="<?php @$old_password ?>">
            </div>
            <div class="form-group">
                <label for="passbaru">New Password </label>
                <input type="password" class="form-control" name="new_password" value="<?php @$password ?>">
            </div>
            <div class="form-group">
                <label for="konfpass">Repeat New Password</label>
                <input type="password" class="form-control" name="confirm_pwd" value="<?php @$confirm_pwd ?>">
            </div>
      </div>
      <div class="<?=(@$msg_sucess=="") ? 'error' : 'green' ; ?>" id="logerror">
          <?php echo @$error; ?><?php echo @$msg_sucess; ?>
      </div>
      <div class="modal-footer">
         <?php  
            $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
        ?>
        <a href="<?php echo $url ?>" class="btn btn-secondary">Back</a>
        <button type="submit" id="btn-pwd" name="submit" value="submit" class="btn btn-info text-white waves-effect waves-light">Save</button>
      </div>
      </form>
    </div>
</div>