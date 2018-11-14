<!doctype HTML>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Mad Libs</title>
        <!-- jQuery, and Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>
        <!-- Page Heading -->
        <div class="jumbotron">
            <h1 class="display-4">Mad Libs!</h1>
            <p class="lead">Pick a Title From the List Below to Generate a Fun Custom Story!</p>
            <hr class="my-4">
            <p class="lead">
            <!--Form to select the story -->
            <form class="form-inline">
                <div class="form-group">
                    <select class="form-control" name="story" id="story-select">
                        <option value="one">Story One</option>
                        <option value="two">Story Two</option>
                        <option value="three">Story Three</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary form-control ml-3">Select Story</button>
                </div>
            </form>
            </p>
        </div>

        <!--Javascript to set select form to current story-->
        <script>
            var urlParams = new URLSearchParams(window.location.search);

            let story = urlParams.get('story');

            switch(story){
                case 'one':
                    $('#story-select').val('one');
                    break;
                case 'two':
                    $('#story-select').val('two');
                    break;
                case 'three':
                    $('#story-select').val('three');
                    break;
            }

            console.log(urlParams.get('story'));
        </script>

        <!--The Main Container-->
        <div class="container-fluid" id="container" style="background-color: #f2f2f2; margin-top: -35px; min-height: 80vh;">
            <div class="row justify-content-center mt-3 pt-3">
            <div class="col-6">
                <div>
                <?php
                /*Generate the correct inputs for the requested story */
                    if(isset($_GET['story'])){
                        $story = $_GET['story'];
                        switch ($story) {
                            case "one":
                                loadInputs(1);
                                break;
                            case "two":
                                loadInputs(2);
                                break;
                            case "three":
                                loadInputs(3);
                                break;
                        }
                    }
                ?>
                </div>           
            </div>
            <div class="col-6">
                <p id="story">
                    <?php
                        /*Generate the correct unmodified story */
                        if(isset($_GET['story']) && ($_SERVER['REQUEST_METHOD'] !== 'POST')){
                            $story = $_GET['story'];
                            switch ($story){
                                case "one":
                                    echo loadStory(1);
                                    break;
                                case "two":
                                    echo loadStory(2);
                                    break;
                                case "three":
                                    echo loadStory(3);
                                    break;
                            }
                        /*Generate the MadLib */    
                        } else  if(isset($_GET['story'])){
                            $story = $_GET['story'];
                            switch ($story){
                                case "one":
                                    echo loadMadLib(1);
                                    break;
                                case "two":
                                    echo loadMadLib(2);
                                    break;
                                case "three":
                                    echo loadMadLib(3);
                                    break;
                            }
                        }
                    ?>
                </p>
            </div>
        </div>



        <?php

            /*Load the unmodified story, and for each --*VALUE*-- return an <input name='value'> */
            function loadInputs($storyNumber){
                if($storyNumber === 1){
                    $file = fopen('story1.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story1.txt"));
                } elseif ($storyNumber === 2){
                    $file = fopen('story2.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story2.txt"));
                } elseif ($storyNumber === 3){
                    $file = fopen('story3.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story3.txt"));
                }

                fclose($file);

                preg_match_all("/(--\S+--)/", $contents, $out);

                echo "<form method='post'>";

                for($i = 0; $i < count($out[0]); $i++){
                    $str = str_replace("--", "", $out[0][$i]);
                    echo "<div class='form-group'>";
                    echo "<input type='text' class='form-control' name='$str' placeholder='$str'>";
                    echo "</div>";
                }

                echo "<button class='btn btn-primary' type='submit'>Submit</button>";
                echo "</form>";
            }

            /*Load the unmodified story, and replace --*VALUE*-- with _______________ */
            function loadStory($storyNumber){

                if($storyNumber === 1){
                    $file = fopen('story1.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story1.txt"));
                } elseif ($storyNumber === 2){
                    $file = fopen('story2.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story2.txt"));
                } elseif ($storyNumber === 3){
                    $file = fopen('story3.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story3.txt"));
                }

                

                fclose($file);

                return preg_replace("/--\S+--/", "___________", $contents);
            }

            /*Load the unmodified story, and replace --*VALUE*-- with the POST */
            function loadMadLib($storyNumber){
                if($storyNumber === 1){
                    $file = fopen('story1.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story1.txt"));
                } elseif ($storyNumber === 2){
                    $file = fopen('story2.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story2.txt"));
                } elseif ($storyNumber === 3){
                    $file = fopen('story3.txt', 'r+') or die("Unable to open the file");
                    $contents = fread($file,filesize("story3.txt"));
                }

                fclose($file);

                foreach($_POST as $key => $value){
                    $contents = preg_replace("/--$key--/", $value, $contents);
                }

                return $contents;
            }
        ?>
    </body>
</html>