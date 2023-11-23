
<?php
include('connection.php');

if (isset($_GET['tableName'])) {
    $selectedTable = $_GET['tableName'];

    // Modify the SQL query based on the selected table
    $query = "SELECT * FROM $app_activity_log ORDER BY timestamp DESC";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<h2>' . $app_activity_log . '</h2>';
        echo '<table>
                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['timestamp'] . '</td>
                    <td>' . $row['activity'] . '</td>
                  </tr>';
            // Add more columns as needed
        }

        echo '</tbody></table>';
        mysqli_free_result($result);
    }

    mysqli_close($conn);
}
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dropdown Navigation</title>
        <style>
            body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.tables-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

table {
    width: 50%;
    border-collapse: collapse;
    margin: 0 10px 20px 0;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

h2 {
    margin-bottom: 10px;
}

.dropdown {
    position: fixed;
    left: 20%; /* Adjust the left position as needed */
    top: 40px; /* Adjust the top position as needed */
    display: inline-block;
    height: 60vh;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}


        </style>
    </head>

    <body>
        <div class="dropdown">
            <button class="dropbtn">Select Table</button>
            <div class="dropdown-content">
                <a href="#" onclick="navigateToTable('table1')">Applicant Activity Logs</a>
                <a href="#" onclick="navigateToTable('table2')">My Activity Logs</a>
                <!-- Add more table options as needed -->
            </div>
        </div>

        <div class="tables-container" id="tableContainer">
         
        </div>

        <script>
           function navigateToTable(tableName) {
    const tablesContainer = document.getElementById('tableContainer');

    // Use AJAX to load data from the PHP script associated with the selected table
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the tablesContainer with the data received from the server
            tablesContainer.innerHTML = xhr.responseText;
        }
    };

    // Specify the correct PHP script based on the selected table
    let phpScript;
    if (tableName === 'table1') {
        phpScript = 'dos_table.php';
    } else if (tableName === 'table2') {
        phpScript = 'dos_table2.php';
    }

    // Open the request with the appropriate PHP script
    xhr.open('GET', phpScript + '?tableName=' + tableName, true);
    xhr.send();
}


        </script>
    </body>

    </html>
