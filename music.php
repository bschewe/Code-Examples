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
    <title>Blake Schewe's WebDEV</title>
</head>
<body>
    <section id="top">
            <?php
                $fName = basename(__FILE__);
                include("header.php");
            ?>
    </section>
    <div class="container">
        <p></p>
        <p>
        Web Development has recently become a passion of mine.  Learning through courses taken at the University of Michigan and Codeacademy, I feel as if I have learned some pretty
		neat things using many different programming languages.  Below are descriptions of the types of code I am using on my site!  If you have any questions implementing any of these
		techniques, there are many helpful techniques at Codeacademy.com and the ever-so-handy 
        <a href="https://www.youtube.com/">
            <i class="fa fa-youtube-square fa-2x" id="youtubebutton"></i>
        </a>
        </p>
        <div class="container">
            <div class="col-xs-12 col-md-4">
                <h1 class="h1h1"> HTML/CSS </h1>
                <p>
					This site is primarily coded in HTML, and styled in CSS (or Cascading Style Sheets). Learning from SI 206 primarily, the basics of HTML are the foundation 
					for most websites and this was my first step in learning web development.  Interweaving other languages of code within the HTML infrastructue makes for
					a very sleek design that is also responsive.  CSS sheets have the ability to change the color schemes, layout, font sizes, and 
					many other vaisually appealing elements on the page.
                </p>
            </div>
            <div class="col-xs-12 col-md-4">
				<h1  class="h1h1"> PHP/Javascript </h1>
                <p>
					PHP and Javascript are two other languages in use on this site, which allow the site to have additional functionality outside of what just HTML and CSS can do.
					For example, the footer of this site displays the time, and also the date and time the last time the site was editing or updated.  The PHP code pulls this information
					from the files and allows it to be displayed.  The Good Morning/Good Afternoon/Good Night header on the index page is a combination of PHP and Javascript
					to disappear when hovered over, and also dynamically changing the header based on what time of day the user is viewing the page.
                </p>
            </div>
            <div class="col-xs-12 col-md-4">
				<h1 class="h1h1"> Outside functionality: </h1>
                <p>
					On the home page, there are examples of many other combinations of outside functionality.  The multicolor sunset display is a javascript command using an outside color scheme from
					an external website.  It then cycles through the colors for a rainbow effect.  The entire layout management is completed by bootstrap, an outside style sheet to make a website
					format on multiple screens.  For example, viewing each page of this website through a phone, tablet, and computer bring about changes in the display to keep things organized.  This 
					also can be achieved by adjusting the size of your browser on a computer.
                </p>
					<br>
        </div>
	<p> Other programming skills that are not displayed on this site are mySQL, C++, and Python.  These other languages are used for more computation and data analysis.
	
	Eventually, snippets of code and data visualization projects using Tableau and iPython notebook with pandas will be uploaded.</p>
	<br>
	<p> Validation is a necessary component of the web design process. This helps promote accessibility to those who may not be able to use the standard functions on the computer, such
		as a mouse or keyboard.  To ensure full range accesibility to all visitors, all pages of this site have been validated at http://wave.webaim.org/ and http://validator.w3.org/</p>
	<br>
    </div>
     <?php
        $fName2 = basename(__FILE__);
		include("footer.php");
        ?>
</body>