<?php
if(isset($_POST['delete'])){
    $delete = implode('", "', $_POST['delete']);
    deleteFromDB($delete);
}

function deleteFromDB($items)
{
    //SQL Connection
    $servername = "localhost";
    $db_username = "jbeneski_images";
    $db_password = "cjcW4e!Uo*bH";
    $dbname = "jbeneski_images";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = 'DELETE FROM `images` WHERE `url` IN ("' .$items.'")';

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
