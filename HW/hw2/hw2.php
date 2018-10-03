<!DOCTYPE html>
<html>
    <head>
    <title>Jacob Beneski - About Me</title>
    <link rel="stylesheet" href="./hw2.css">
    </head>
    <body>
        <div id='content'>
            <?php
            print_headers();

            print_content();

            print_images();
            ?>
        </div>
        <?php
        function print_headers(){
            echo '<h1>Jacob Beneski - Class of 2019</h1>
            <h3><a href="/web_programming/hw/hw1/hw1.html">HW1 Here</a></h3>';
        }

        function print_content(){
            echo '<p>
            &emsp; I have been programming for about 7 years now; Since my Junior year of high school. I enjoy coding in Java, Javascript, Python, Node.js, HTML, <a href="https://getbootstrap.com/">Bootstrap</a>, BASH and several other programming / scripting languages. I have worked on several WebApps, Java projects, and Node.js projects as a contracter, as well as many personal projects.
            <br>
            <br>
            </p>
            <p>
            &emsp; Outside of school I enjoy building computers and working with technology. I work at the Geek Squad, so I get to play with the latest tech all the time. I also enjoy playing video games, primarily on PC, but also on Nintendo Switch. Reddit is probably my biggest timesink currently.
            </p>';
        }

        function print_images(){
            echo '<div id="images" style="margin-left:auto;margin-right:auto;">
            <figure>
                <a href="https://www.wired.com/story/how-to-build-a-pc/"><img src="images/cpu.jpg" alt="Image of Wrong Way to Install CPU" width="45%"></a>
                <figcaption>One of my hobbies is building computers.</figcaption>
            </figure>

            <figure>
                <a href="https://en.wikipedia.org/wiki/History_of_video_games"><img src="images/video_games.webp" alt="Image of Video Games" width="45%"></a>
                <figcaption>Video Games are a Fun Hobby</figcaption>
            </figure>
        </div>';
        }
        ?>
    </body>
</html>