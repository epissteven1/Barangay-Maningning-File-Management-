<?php
// Start or resume the session
// session_start();


// Include the database connection
include('connection.php');

// Assuming you have a valid session_id or file_id
$file_id = $_GET['file_id']; // Change this to your actual session variable

// Prepare and execute a query to get file name based on file_id
$sql = "SELECT file_uploads FROM documents WHERE file_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $file_id);
$stmt->execute();
$stmt->bind_result($file_name);

// Fetch the result
if ($stmt->fetch()) {
    // Close the database connection
    $stmt->close();
    $conn->close();

 


    // Construct the file path
    $file_path = __DIR__ . DIRECTORY_SEPARATOR . "file_uploads" . DIRECTORY_SEPARATOR . $file_name;

   
            
    echo 'File Path: ' . $file_path;
    // Check if the file exists and its extension is allowed
    $allowedExtensions = array("pdf", "doc", "docx", "txt");
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    if (in_array($file_extension, $allowedExtensions) && file_exists($file_path)) {
        // Read the contents of the file
        $file_contents = file_get_contents($file_path);

        if ($file_contents === false) {
            // Error reading the file
            echo 'Error reading the file.';
        } else {
            // Check if it's a Word document (assuming it's a ZIP file)
            if ($file_extension === 'docx') {
                // Unzip the content
                $zip = new ZipArchive;
                if ($zip->open($file_path) === true) {
                    // Extract the content of "word/document.xml"
                    $xml_content = $zip->getFromName('word/document.xml');

                    // Close the ZIP archive
                    $zip->close();

                    // Parse and output the extracted text
                    $xml = simplexml_load_string($xml_content);
                    if ($xml !== false) {
                        $text = '';
                        foreach ($xml->xpath('//w:t') as $textNode) {
                            $text .= (string) $textNode;
                        }
                        echo htmlspecialchars($text);
                    } else {
                        // Error loading XML
                        echo 'Error loading XML.';
                    }
                } else {
                    // Unable to open the ZIP archive
                    echo 'Unable to open the ZIP archive. ';
                    // Unable to open the ZIP archive
echo 'Unable to open the ZIP archive. ';

switch ($zip->status) {
    case ZipArchive::ER_EXISTS:
        echo 'File already exists.';
        break;
    case ZipArchive::ER_INCONS:
        echo 'Zip archive inconsistent.';
        break;
    case ZipArchive::ER_INVAL:
        echo 'Invalid argument.';
        break;
    case ZipArchive::ER_MEMORY:
        echo 'Malloc failure.';
        break;
    case ZipArchive::ER_NOENT:
        echo 'No such file.';
        break;
    case ZipArchive::ER_NOZIP:
        echo 'Not a zip archive.';
        break;
    case ZipArchive::ER_OPEN:
        echo 'Can\'t open file.';
        break;
    case ZipArchive::ER_READ:
        echo 'Read error.';
        break;
    case ZipArchive::ER_SEEK:
        echo 'Seek error.';
        break;
    default:
        echo 'Unknown error.';
        break;
}

                }
            } else {
                // Display the contents for other file types (PDF, TXT, etc.)
                echo htmlspecialchars($file_contents);
            }
        }
    } else {
        // File not found or invalid extension
        echo 'File not found or invalid extension.';
    }
} else {
    // File information not found in the database
    echo 'File information not found.';
}
?>
