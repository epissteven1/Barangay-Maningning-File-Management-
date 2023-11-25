<?php   include 'connection.php';  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Document</title>
</head>
<body>
<footer class="main-footer">
<div class="float-right d-none d-sm-block">

</div>
<strong>Copyright:FIlEMANAGEMENT: ADDB By: GROUP 5 @AY 20223-2024</a>.</strong> All rights reserved.
</footer>

</div>
              <!-- /.card -->
            </div>
            </div>
        </div>
            <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="change_pass.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input class="form-control" type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input  class="form-control" type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password:</label>
                <input class="form-control" type="password" name="confirm_new_password" required>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</body>
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script>
   function openChangePasswordModal() {
    $('#modal-default').modal('show');
}

</script>
</html>