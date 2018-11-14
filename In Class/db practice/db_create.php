<!doctype HTML>
<?php
    $db_username = 'jbeneski_class';
    $db_password = '!5lYE{-KrkNT';
    $db_server = 'localhost';
    $db_name = 'jbeneski_class';


    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (FName, LName, Email, Age, Major) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $firstname, $lastname, $email, $age, $major);


    // set parameters and execute
    $firstname = "Earl";
    $lastname = "Edwards";
    $email = "eedwards96@yahoo.com";
    $age = 18;
    $major = 'Math';
    $stmt->execute();

    // set parameters and execute
    $firstname = "Al";
    $lastname = "Alcantara";
    $email = "bigal9000@gmail.com";
    $age = 24;
    $major = 'Computer Science';
    $stmt->execute();


    // set parameters and execute
    $firstname = "Duane";
    $lastname = "Durrant";
    $email = "thisisanemail123@hotmail.com";
    $age = 32;
    $major = 'Communications';
    $stmt->execute();


    // set parameters and execute
    $firstname = "Ailene";
    $lastname = "Ashby";
    $email = "ailene@ashby.com";
    $age = 23;
    $major = 'Economics';
    $stmt->execute();

    // set parameters and execute
    $firstname = "Brunilda";
    $lastname = "Byrnes";
    $email = "bbyrnes@yahoo.com";
    $age = 46;
    $major = 'Psychology';
    $stmt->execute();

    echo "New records created successfully";
    $stmt->close();
    $conn->close();
?>
<html>
    <head>
    </head>
    <body>
    </body>
</html>