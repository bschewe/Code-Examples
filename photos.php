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
    <title>Blake Schewe's Webpage Graphic Design</title>
</head>
<body>
    <section id="top">
        <?php
            $fName = basename(__FILE__);
            include("header.php");
        ?>
    </section>
    <div class="container">
        <p>Graphic Design is a great way for one to express their creativity.  Using Adobe Illustrator, ideas are put to the screen in hopes of turning out a visually appealing product.
			Being the Team Leader of the Graphic Design team of Kappa Theta Pi, I can attest that one can truly start from no knowledge of a foreign computer program like Illustrator, 
			and rise to the ranks where the deliverables you create grab onlookers attention.  I do designs for Kappa Theta Pi, but also personal designs based off popular culture &amp; music.
			Below, some of my random creations are displayed.</p>
        <p>All of these were created by Blake Schewe, in Adobe Illustrator!</p>
        <div class="col-xs-12 col-md-4">
            <img src="img/michigan.png" alt="blockM" class="photoimg">
            <p>The University of Michigan is the place I call home.  Being a Michigan resident all of my life, it is truly a dream come true to attend such a prestigious
                   University.  This design incorporates classes maize &amp; blue! It is an honor to a be a member of the Leaders and the Best.
                   Forever and always. GO BLUE!
               </p>
        </div>
        <div class="col-xs-12 col-md-4">
            <img src="img/N1.png" alt="LakeshoreLancers" class="photoimg">
            <p>
                Lakeshore High School in Stevensville, Michigan is where I grew up!  All of my childhood memories are here, from Friday Nights playing high school
                football under the lights especially.  My younger brother, Nate, was a senior and playing his last season of football this year.  I made him this design to commemorate
				his experiences!
				</p>
		</div>
        <div class="col-xs-12 col-md-4">
            <img src= "img/Inspiration.jpg" alt="ActionBronson" class="photoimg">
            <p>
				Music has, and always will be, a large part of my life.  Pictured are some of the artists I listen to, along with me, all posing for a selfie picture.  From left:
				Skizzy Mars, Blackbear, Machine Gun Kelly, Post Malone, and last but not least, Blake Schewe, holding the camera.  This is laid over-top a beautiful Stevensville, Michigan sunset,
				that was also redrawn in illustrator.
            </p>
        </div>
    </div>
     <?php
        $fName2 = basename(__FILE__);
        include("footer.php");
    ?>
</body>