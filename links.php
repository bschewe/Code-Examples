<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Poller+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <title>Blake Schewe's Webpage LINKS</title>
</head>
<body>
    <section id="top">
        <?php
            $fName = basename(__FILE__);
            include("header.php");
        ?>
    </section>
    <div class="container">
        <p class="spacing">These are a few links that I enjoy going to in my free time!</p>
        <div class="col-xs-12 col-md-4">
            <p><a href="http://www.worldstarhiphop.com">WORLDSTARHIPHOP</a></p>
                <p> 
                    <i class="fa fa-video-camera fa-4x" ></i>
                </p>
            <p>WorldstarHipHop.com is one of the craziest sites on the internet.  It offers a range of anything from relevant hip-hop culture news articles, all the way to up-and-coming
                    artists' brand new music videos.  However, some content may be a little much for viewers, so this is your discretion warning!
            </p>
        </div>
        <div class="col-xs-12 col-md-4">
            <p><a href="http://www.espn.com">ESPN</a></p>
            <p><i class="fa fa-futbol-o fa-4x"></i></p>
            <p>ESPN really is the Worldwide Leader in Sports&trade;.  They supply all of my favorite sport team updates, whether it be a roster change or the final score of a game I missed.  
                    Fantasy sports season is the time of year that I spend most of my time on this site, but checking in at least once a week on Michigan football is a must!
            </p>
        </div>
        <div class="col-xs-12 col-md-4">
            <p><a href="http://www.google.com">GOOGLE</a></p>
            <p><i class="fa fa-search fa-4x"></i></p>
            <p> Oh Google.  The famous search engine that seems to read our mind with their prediction algorithms!  Google is by far the most visited site on my computer, because I'm always
            looking for information or trying to learn something new!  Making all the information on the web accessible from one search database is simply fascinating.
        </div>
    </div>
         <?php
            $fName2 = basename(__FILE__);
            include("footer.php");
        ?>
</body>