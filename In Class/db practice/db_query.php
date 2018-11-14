<!doctype HTML>
<html>
    <head>
    </head>
    <body>

<?php
    $db_username = 'jbeneski_class';
    $db_password = '!5lYE{-KrkNT';
    $db_server = 'localhost';
    $db_name = 'jbeneski_class';


    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `users` WHERE `LName` LIKE 'M%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            var_dump($row);
            echo "<br>";
        }
    }


    $sql = "SELECT * FROM `users` WHERE Major='Math' AND Age BETWEEN 15 AND 40;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            var_dump($row);
            echo "<br>";
        }
    }

    $sql = "SELECT * FROM `users` WHERE Email LIKE '%@yahoo.com';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            var_dump($row);
            echo "<br>";
        }
        $conn->close();
    } else {
        $conn->close();
    }


?>
    </body>
</html>