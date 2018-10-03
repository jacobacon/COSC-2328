</<!DOCTYPE html>
<html>
<head>
    <title>Example 3</title>
</head>
<body>
    <div>
        Welcome <?php echo $_POST['name'];?> <br>
        Your NickName: <?php echo $_POST['nname'];?>
    </div>

    <div>
        You are in <?php echo $_POST['class']; ?> 
    </div>

    <div>
        Your Major is <?php echo $_POST['major']; ?>
    </div>

    <div>
    Your Contact Info is <?php echo "Email: ", $_POST['email'], " Phone: ", $_POST['phone']; ?>
    </div>
    
</body>
</html>