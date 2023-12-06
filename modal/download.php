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
    
</div>
              <!-- /.card -->
            </div>
            </div>
        </div>
            <div class="modal fade" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Permission</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="inputField">  
            <div class="modal-body">
            <form action="search.php" method="post">
            <div class="form-group">
    <label for="current_password">Reason for requesting permission:</label>
    <div class="input-group">
    <input type="hidden" name="file_id" value="' . $file_id . '" required>
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleCurrentPassword"></i>
            </span>
        </div>
    </div>
</div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button input type="text"  name="reason" class="btn btn-primary">Save changes</button>
            </div>
        </form>
            </div>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
<script>
function viewFile() {
   $('#modal').modal('show');
}
</script>
</body>
</html>