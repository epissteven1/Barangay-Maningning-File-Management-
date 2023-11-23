<?php
// Include your database connection file
include 'connection.php';

// Get the search query from Ajax
$searchQuery = $_POST['search'];

// Query the database to get the filtered list of documents
$query = "SELECT * FROM documents WHERE file_uploads LIKE '%$searchQuery%' OR upload_date LIKE '%$searchQuery%'";
$result = mysqli_query($conn, $query);

if ($result) {
   while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
            <td>{$row['file_uploads']}</td>
            <td>{$row['upload_date']}</td>
            <td>
               <a href='download_file.php?action=download&file_id={$row['file_id']}'class='btn btn-success'>Download</a>
               <a href='read.php?action=view&file_id={$row['file_id']}'class='btn btn-primary'>Read</a>
            </td>
         </tr>";
   
   }
   // Free the result set
   mysqli_free_result($result);
} else {
   echo "<tr>
           <td colspan='3'>No Record Found</td>
         </tr>";
}
?>


