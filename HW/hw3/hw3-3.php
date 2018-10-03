<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div style="background-color: <?php echo $_POST['bg_color'];?>; color: <?php echo $_POST['txt_color'];?>;")>
        <?php
            if(isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            echo "<div>Congratulations $username, you are now registered! </div>";
            }
        ?>
        <form id="userdata" method="post">
            <label for="bg_color">Background Color</label>
            <input type="color" value="#ffffff" name="bg_color" id="bg_color"> <br>
            <label for="txt_color">Text Color</label>
            <input type="color" value="#000000" name="txt_color" id="txt_color"> <br>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required> <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required> <br>

            <button type="submit">Submit</button>
        </form>
        </div>
    </body>
</html>