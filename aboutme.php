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
    <title>Blake Schewe's Webpage ABOUT ME</title>
</head>
<body>
    <section id="top">
        <?php
            $fName = basename(__FILE__);
            include("header.php");
        ?>
    </section>
    <div class="container">
		<div class="col-xs-12 col-md-4">
			<img src="img/b.jpg" alt="bFam" id="bpic" class="photoimg">
		</div>
		<div class="col-xs-12 col-md-8">
		<p id="abtmefont">
			Hello! My name is Blake Schewe.  I am currently a senior at the University of Michigan.  I am in the School of Information, specializing in UI/UX Design with a minor in Science,
			Technology and Society.  Web Development and Graphic Design are also two interests of mine outside of interface design and human-computer interaction.  I feel as if web development
			and graphic design are much more enjoyable due to the creativity and freedom involved in these processes.  I really enjoy learning about technology and have a passion for such! Recently,
			I was able to check out the Oculus Rift Virtual Reality device, and it was one of the coolest things I have ever experienced.  Below are some more
			less professional, nonetheless intriguing, facts about myself.
			</p>
		</div>
        <p>A couple of facts about myself!
            My major interests are sports (football, soccer, &amp; basketball particularly).
            The Detroit Lions are my go-to football team, Manchester City FC are the colours I support on the pitch, and I continuously promise
            myself that my favorite basketball team, the Detroit Pistons, will once again rise to that '04 Championship caliber.
        </p>
        <div class="col-xs-12 col-md-4">
            <img src="img/lions.png" alt="lionsLogo" class="photoimg">
        </div>
        <div class="col-xs-12 col-md-4">
            <img src="img/ManCity.png" alt="manCityLogo" class="photoimg">
        </div>
        <div class="col-xs-12 col-md-4">
            <img src="img/pistons.gif" alt="pistonsLogo" class="photoimg">
        </div>
        <div class="col-xs-12">
        <p>
			I was born in St. Joseph, Michigan, a small town directly between Detroit and Chicago along I-94.  I grew up in Stevensville, the town 5 minutes south of St. Joseph.
			I have one older brother, Trace, and one younger brother, Nate. One interesting thing about me that some may not know is my love for shoes.  I love all shoes, particularly Nike, Jordan, Adidas,
            Vans, Timberland, Saucony, and Diadora!  Rap and hip hop is my preferred music of choice, however I also like other RnB music, and also older Alternative
            music like blink-182 &amp; Simple Plan.  Navigate above to check out other areas of the site, or view social media with the buttons below!
        </p>
        </div>
    </div>
    <?php
            $fName2 = basename(__FILE__);
            include("footer.php");
        ?>
</body>