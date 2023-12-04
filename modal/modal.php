<?php   
include 'includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <style>


.modal-header{
    background: #0d6efd;
    color: #fff;
}

.modal-bod form {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0;
}



.modal-bod form .imgholder{
    width: 200px;
    height: 200px;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
}

.imgholder .upload{
    position: absolute;
    bottom: 0;
    left: 10;
    width: 100%;
    height: 100px;
    background: rgba(0,0,0,0.3);
    display: none;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.upload i{
    color: #fff;
    font-size: 35px;
}

.imgholder:hover .upload{
    display: flex;
}

.imgholder .upload input{
    display: none;
}

.modal-bod form .inputField{
    flex-basis: 68%;
    border-left: 5px groove blue;
    padding-left: 20px;
}

form .inputField > div{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

form .inputField > div label{
    font-size: 20px;
    font-weight: 500;
}

#userForm form .inputField > div label::after{
    content: "*";
    color: red;
}

form .inputField > div input{
    width: 75%;
    padding: 10px;
    border: none;
    outline: none;
    background: transparent;
    border-bottom: 2px solid blue;
}

.modal-footer .submit{
    font-size: 18px;
}


#readData form .inputField > div input{
    color: #000;
    font-size: 18px;
}
  </style>

    <title>PROFILE</title>
</head>
<body>


</div>
              <!-- /.card -->
            </div>
            </div>
        </div>  
            <div class="modal fade" id="readData">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Profile</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-bod">
            <form action="profile_card.php" method="post">
         
            <div class="card imgholder">
             
      <img src="<?php echo $row['applicant_profile']; ?>" alt="" width="200" height="200" class="img " >
                        </div>
                      
         <div class="inputField">   
         <div class="form-group">
                <label for="firstname">firstname:</label>
                <input class="form-control" type="text" name="firstname"  value="<?php echo strtoupper($row['fullname']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="username">UserName</label>
                <input  class="form-control" type="text" name="username" value="<?php echo strtoupper($row['username']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" value="<?php echo strtoupper($row['email']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="civil_status">Civil Status:</label>
                <input class="form-control" type="text" name="civil_status" value="<?php echo strtoupper($row['civilstatus']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input class="form-control" type="text" minlength="11" maxlength="11" name="contact" value="<?php echo strtoupper($row['contact']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input class="form-control" type="text" name="gender" value="<?php echo strtoupper($row['gender']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="gender">Age:</label>
                <input class="form-control" type="number" name="age" value="<?php echo strtoupper($row['age']); ?>" disabled>
            </div>


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
     
            </div>
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

<script>
   function readInfo() {
    $('#readData').modal('show');
}



</script>
</html>