<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?PHP
        $message = 'Hello World';

        function print_center($var){
            echo "<p style=\"text-align: center; color: red;\"> $var </p>";
        }

        function print_loop($num){
            for($i = 0; $i < $num; $i++){
                echo "<p style=\"color: green;\"> We love to code! </p>";
            }
        }

        function do_math($num1, $num2){
            echo "<p> The Sum is: ", ($num1 + $num2) , "</p>";
            echo "<p> The Difference is: ", ($num1 - $num2), "</p>";
            echo "<p> The Product is: ", ($num1 * $num2), "</p>";
            echo "<p> The Modulus is: ", ($num1 % $num2), "</p>";
        }

        function array_utils($array){
            var_dump($array);

            echo "<p> The Average of the array: ", (array_sum($array) / count($array)), "</p>";

            sort($array);

            $middle = floor((count($array)-1)/2);

            echo "<p> The Median of the array: ", $array[$middle] , "</p>";
        }

        function alignment_array($array){
            for($i = 0; $i<count($array); $i++){
                
            }
        }

        print_center($message);

        echo "<br>";
        echo "<br>";

        print_loop(5);

        echo "<br>";
        echo "<br>";

        do_math(3, 8);

        echo "<br>";
        echo "<br>";

        $arrayName = array(4,7,1,9,0,2,6,9,8);

        array_utils($arrayName);

        ?>
    </body>
</html>