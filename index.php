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
    <title>Blake Schewe's Webpage HOME</title>
</head>
<body>
    <section id="top">
        <?php
            $fName = basename(__FILE__);
            include("header.php");
        ?>
    </section>
    <div class="container">
        <?php
            include("js/BlurredText/index.html");
        ?>
        <div class="col-xs-12">
            <h2 class="hovertown" id="greeting">Hello
            <script type="text/javascript">
                updateHeader();
                $("#greeting").fitText(1.0, {'minFontSize': '2em', 'maxFontSize': '6em' });
            </script>
            </h2>
            <p class="indextext"> Hello, thanks for visiting my site!  My name is Blake Schewe, and I am currently a
                        Junior at the University of Michigan.  I am studying User Interface/User Experience (UI/UX) Design in the School of Information, while attempting to secure a
                        minor in the Science, Technology, and Society (STS) program here, focusing in Society and Technology.  I am a member of the 
                        Kappa Theta Pi Professional Technology Fraternity on campus.  Being the President of the Design Team for Kappa Theta Pi, our groups job is to create deliverables that are
						Kappa Theta Pi related, and also create deliverables for outside student organizations on campus we have formed partnerships with.  We operate usinng Adobe Illustator, Adobe PhotoShop,
						and Sketch.
            </p> 
        </div>
    </div>
    <div class="container">
        <div id="col-xs-12">
	
	 <p>Below is a coloring transition effect I am trying, using the sunset image above! Let me know what you think!</p>
     <section id="animate">
        <img src="img/sunset2.png" alt="sunset" id="sunsetcolor">
     </section>
    </div>
	</div>
    <?php
    $fName2 = basename(__FILE__);
    include("footer.php");
    ?>
</body>