<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <form id="userdata" method="post">
            <input type="text" id="name" name="name" placeholder="Name" required> <br>
            <input type="email" id="email" name="email" placeholder="E-Mail" required> <br>
            <input type="text" id="address" name="address" placeholder="Address" required> <br>
            <input type="text" id="phone" name="phone" placeholder="Phone Number" required> <br>

            <select name="classification" required>
                <option value="freshman">Freshman</option>
                <option value="sophomore">Sophomore</option>
                <option value="junior">Junior</option>
                <option value="senior">Senior</option>
            </select>

            <select name="class[]" size=3 required multiple>
                <option value="COSC-2328">COSC-2328</option>
                <option value="COSC-3325">COSC-3325</option>
                <option value="COSC-3327">COSC-3327</option>
                <option value="COSC-4333">COSC-4333</option>
                <option value="MATH-2315">MATH-2315</option>
            </select>

            <button type="submit">Submit</button>
        </form>

        <?php
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['classification']) && isset($_POST['class'])){
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address= $_POST['address'];
            $phone = $_POST['phone'];
            $classification = $_POST['classification'];
            $class = $_POST['class'];
            

            echo "<div>Name: " , $name, "</div>";
            echo "<div>Email: ", $email, "</div>";
            echo "<div>Address: ", $address, "</div>";
            echo "<div>Phone: ", $phone, "</div>";
            echo "<div>Classification: ", $classification, "</div>";
            echo "<div>Class: ";
            foreach ($class as $key => $val) {
                echo $val, "<br>";
            }
            echo "</div>";
            }
        ?>
    </body>
</html>