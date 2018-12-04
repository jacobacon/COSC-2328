<?php
session_start();
//Start the php session
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Image Upload</title>
    <!-- External Sources -->
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/bootstrap-grid.css">
    <link rel="stylesheet" href="public/css/bootstrap-reboot.css">
    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="app.css">
</head>
<body class="pb-3">
<!-- Page Jumbotron Header -->
<div class="jumbotron mx-3 mt-3">
    <h1 class="display-4"><img src="public/upload.png" width="10%" height="10%"> Upload an Image!</h1>
    <!-- Input for Filtering what category to display on the table -->
    <form>
        <div class="form-group">
            <select class="form-control mt-3" name="category" id="category-select">
                <option value="All">All</option>
                <option value="Memes">Memes</option>
                <option value="Family">Family</option>
                <option value="Other">Other</option>
            </select>
            <button class="btn btn-secondary mt-3">Select</button>
        </div>
    </form>
</div>
<!-- Main Container -->
<div class="container pt-3">
    <?php
    //If the user is not logged in, show the login screen
    if (($_SERVER['REQUEST_METHOD'] === 'GET') && ($_SESSION['authenticated'] !== true)) {
        echo returnLogin();
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //Otherwise show the main body with requested category
        $category_filter = $_GET['category'];
        echo returnBody($category_filter);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['authenticated'] !== true) {
        //Verify Username and Password

        if (verifyLogin($_POST['username'], $_POST['password'])) {
            //If the username is correct show the main body
            $_SESSION['authenticated'] = true;
            $category_filter = $_GET['category'];
            echo returnBody($category_filter);
        } else {
            //If the username or password is wrong, show the login page and an alert.
            echo returnLogin();
            echo '<script>alert("Invalid Username or Password");</script>';
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Form handler
        $description = $_POST['description'];
        $category = $_POST['category'];
        //Accept the file upload
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_explode = explode('.', $file_name);
            $file_ext = strtolower(end($file_explode));
            $expensions = array("jpeg", "jpg", "png");


            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be 2 MB or less';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "public/" . $file_name);

                saveToDB('public/' . $file_name, $description, $category);
            } else {
                print_r($errors);
            }
            //Set the category in the filter
            $category_filter = $_GET['category'];

            echo returnBody($category_filter);
        }
    }
    ?>
</div>


<?php
//Save the data to the database
function saveToDB($url_ext, $description_ext, $category_ext)
{
    //PHP settings
    $db_server = "localhost";
    $db_username = "jbeneski_images";
    $db_password = "cjcW4e!Uo*bH";
    $db_name = "jbeneski_images";

    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO images () VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $url, $category, $description);


    // set parameters and execute
    $url = $url_ext;
    $category = $category_ext;
    $description = $description_ext;
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

//Return the main body with a table generated using the requested category
function returnBody($category)
{
    $returnString = '<div class="col">';
    $returnString .= '<div class="card">';
    $returnString .= '<h5 class="card-header">Images</h5>';
    $returnString .= '<div class="card-body">';
    $returnString .= generateTable($category);
    $returnString .= '<button type="button" class="btn btn-sm btn-danger mt-3" id="delete-btn">Delete Selected</button>';
    $returnString .= '</div>';
    $returnString .= '</div>';
    $returnString .= '<div class="card mt-3">';
    $returnString .= '<h5 class="card-header">Add Image</h5>';
    $returnString .= '<div class="card-body">';
    $returnString .= '<form method="post" enctype="multipart/form-data">';
    $returnString .= '<input type="file" accept="image/*" name="image" required>';
    $returnString .= '<select name="category">';
    $returnString .= '<option value="Memes">Memes</option>';
    $returnString .= '<option value="Family">Family Photos</option>';
    $returnString .= '<option value="Other">Other</option>';
    $returnString .= '<select>';
    $returnString .= '<div class="form-group"><label for="description">Description</label><textarea class="form-control" rows="5" id="description" name="description" required></textarea></div>';
    $returnString .= '<button type="submit" class="btn btn-primary">Submit</button>';
    $returnString .= '</form>';
    $returnString .= '</div>';
    $returnString .= '</div>';
    $returnString .= '</div>';

    $returnString .= '<a href="logout.php" class="btn btn-danger mt-3">Logout</a>';


    return $returnString;
}

function returnLogin()
{
    //Generate login page.
    $returnString = '<div class="card"><div class="card-body pt-3"><form method="post">';
    $returnString .= '<img src="public/upload.png" class="rounded mx-auto d-block" alt="Upload Image" height="25%" width="25%">';
    $returnString .= '<div class="form-group">';
    $returnString .= '<label for="">Username</label><input id="username" class="form-control" type="text" name="username"></div><div class="form-group"><label>Password</label><input id="password" class="form-control" type="password" name="password">';
    $returnString .= '</div><button type="submit" class="btn btn-primary">Login</button></form></div></div>';

    return $returnString;
}

function verifyLogin($username, $password)
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

    $sql = "SELECT * FROM `users` WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //Verify username and password
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] === $username && $row['password'] === $password) {
                $conn->close();
                return true;
            }
        }
        $conn->close();
        return false;
    } else {
        $conn->close();
        return false;
    }
}

function generateTable($category)
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

    //Create SQL query based on category
    switch ($category){
        case "All":
            $sql = "SELECT * FROM images";
            break;
        case "Memes":
            $sql = "SELECT * FROM images WHERE category = 'Memes'";
            break;
        case "Family":
            $sql = "SELECT * FROM images WHERE category = 'Family'";
            break;
        case "Other":
            $sql = "SELECT * FROM images WHERE category = 'Other'";
            break;
        default:
            $sql = "SELECT * FROM images";
            break;
    }
    $result = $conn->query($sql);

    //Generate a table based on the SQL data
    $returnString = '<table style="width: 100%" id="image-table"><thead><th></th><th>Link</th><th>Description</th><th>Category</th></thead><tbody>';

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $returnString .= '<tr><td><input type="checkbox" name="selected" value="' . $row['url']. '"></td><td><a target="_blank" href="' . $row['url'] . '">' . $row['url'] . '</a></td><td>' . $row['description'] . '</td><td>' . $row['category'] . '</td></tr>';
        }
        $conn->close();
    }

    $returnString .= '</tbody></table>';

    return $returnString;
}

?>

<script>
    //Handle the url parameters to set the select object.
    var urlParams = new URLSearchParams(window.location.search);

    let category = urlParams.get('category');

    switch (category) {
        case 'All':
            $('#category-select').val('All');
            break;
        case 'Memes':
            $('#category-select').val('Memes');
            break;
        case 'Family':
            $('#category-select').val('Family');
            break;
        case 'Other':
            $('#category-select').val('Other');
            break;

    }

    $(document).ready(()=>{
       $('#delete-btn').click(function (){
          let deleteValues = [];

          $('#image-table input:checked').each(function () {
              deleteValues.push($(this).val());
          });

          $.post(window.location.pathname + '/delete.php', {'delete': deleteValues}).done(function (data) {
              alert('Deleted Image');
              window.location.replace(window.location.pathname);
          });

       });
    });

</script>
</body>
</html>