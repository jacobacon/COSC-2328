<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    <?php
    
    $file = fopen('small_double_list.txt', 'r+') or die("Unable to open the file");

    domath($file);

    function domath($file){
        
        while(!eof($file)){
            $line = gets($file);
            echo $line;
        }
    }

    ?>
    </body>
</html>