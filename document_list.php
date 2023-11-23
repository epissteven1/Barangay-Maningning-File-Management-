<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Downloadable Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
          
           
                }
           .container {
            width: 1000px;
            height: 1000px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
           }   

        h1 {
            text-align: center;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: blanchedalmond !important;
            font-family: cambria!important;
            font-size: 12pt!important;
            margin-left: 20px;
       
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px!important;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            color: #1e87db;
        }        

    .input-group {
        padding: 20px;
        display: flex;
        justify-content: end;
    } 

    
   
    </style>
</head>
<body>

  
<div class="container">
<div class="card">
<div class="card-header">
<section class="content">

        <div class="row">
            <div class="container-fluid">
                <div class="col-md-7 offset-md-4">
                        <div class="input-group">
                            <input type="search" id="searchInput"  class="form-control form-control-lg" placeholder="Type your keywords here">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>

</div>
<h3 class="card-title">Documents</h3>
<div class="card-body">
    <table id="example1" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date Uploaded</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Dynamic search results will be inserted here -->
            
        </tbody>
    </table>
</div>
</tfoot>
</table>
</div>

</section>

</div>

<footer class="main-footer">
<div class="float-right d-none d-sm-block">

</div>
<strong>Copyright:FIlEMANAGEMENT: ADDB By: GROUP 5 @AY 20223-2024</a>.</strong> All rights reserved.
</footer>

</div>


<script src="assets/plugins/jquery/jquery.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="assets/dist/js/adminlte.min.js?v=3.2.0"></script>

<script>
   $(document).ready(function () {
      // Listen for changes in the search input
      $("#searchInput").on("input", function () {
         // Get the search query
         var searchQuery = $(this).val();

         // Make an Ajax request to search.php with the search query
         $.ajax({
            url: "search.php",
            type: "POST",
            data: { search: searchQuery },
            success: function (response) {
               // Update the table body with the search results
               $("#tableBody").html(response);
            }
         });
      });
   });
</script>

</body>
</html>