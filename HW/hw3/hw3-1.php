<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <form id="numbers" method="post">
            <label for="num1">Number One</label>
            <input type="number" step=0.01 id="num1" name="num1" min=0 max=100 value=0> <br>
            <label for="num2">Number Two</label>
            <input type="number" step=0.01 id="num2" name="num2" min=0 max=100 value=0> <br>
            <label for="num3">Number Three</label>
            <input type="number" step=0.01 id="num3" name="num3" min=0 max=100 value=0> <br>

            <button type="submit">Submit</button>
        </form>

        <?php
            if(isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['num3'])){
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $num3 = $_POST['num3'];

            echo "<div>Average: " , average($num1, $num2, $num3), "</div>";

            echo "<div>Minimum: ", min($num1, $num2, $num3), "</div>";
            echo "<div>Maximum: ", max($num1, $num2, $num3), "</div>";
            }
            
            function average($num1, $num2, $num3){
                return ($num1 + $num2 + $num3) / 3;
            }
        ?>
    </body>
</html>