<?php
    session_start();
?>
<?php
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $_SESSION['authenticated'] = false;
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        window.location.replace('/web_programming/hw/hw5/');
    </script>
</head>
<body>
</body>
</html>
