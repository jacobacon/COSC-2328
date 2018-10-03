<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method='post'>
            <label for='num1'>Number 1</label>
            <input type='number' id='num1' name='num1' step=0.1> <br>
            <label for='num2'>Number 2</label>
            <input type='number' id='num2' name='num2' step=0.1> <br>
            <label for='email'>Email</label>
            <input type='email' id='email' name='email'> <br>
            <button type='submit'>Submit</button>
        </form>



        <?PHP
            if(is_numeric($_POST['num1'])){
                echo $_POST['num1'], "<br>";
            } else {
                echo "Number 1 is Not a Number <br>";
            }

            if(is_numeric($_POST['num2'])){
                echo $_POST['num1'], "<br>";
            } else {
                echo "Number 2 is Not a Number <br>";
            }

            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                echo $_POST['email'], ' is an email <br>';
            } else {
                echo 'Entered Email is Not Valid <br>';
            }
        ?>
    </body>
</html>