
<header> 
    <div class="container">
        <h1 id="headtext" class="hovertown">Welcome!</h1>
        <script type="text/javascript">
            $("#headtext").fitText(1.0, {'minFontSize': '25px', 'maxFontSize': '80px' });
        </script>
    <div class="container">
        <h1 id="titletext">Blake Schewe's Webpage Portfolio</h1>
        <script type="text/javascript">
            $("#titletext").fitText(1.0, {'minFontSize': '20px', 'maxFontSize': '66px' });
        </script>
    </div>
        </div>
    <div class="container"> 
        <div class="col-xs-12">
                <img src="img/sunset.JPG" alt="sunset" id="headerpic">
        </div>
    </div>
        <div class="container">
        <nav class ="hidden-xs hidden-sm" >
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" <?php if($fName == "index.php") echo "class=\"current\""; ?>>
                    <a href="index.php">Home</a>
                </li>

                <li role="presentation" <?php if($fName == "aboutme.php") echo "class=\"current\""; ?>>
                    <a href="aboutme.php">About Me</a>
                </li>
        

                <li role="presentation" <?php if($fName == "music.php") echo "class=\"current\""; ?>>
                <a href="music.php">Web Development</a>
                </li>

                <li role="presentation" <?php if($fName == "photos.php") echo "class=\"current\""; ?>>
                <a href="photos.php">Graphic Design</a>
                </li>

                <li role="presentation" <?php if($fName == "links.php") echo "class=\"current\""; ?>>
                    <a href="links.php">Links</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container">
    </div>
        <nav class="hidden-md hidden-lg">
            <ul class="nav nav-pills nav-stacked"> 
                <li role="presentation" <?php if($fName == "index.php") echo "class=\"current\""; ?> >
                    <a href="index.php">Home</a>
                </li>

                <li role="presentation" <?php if($fName == "aboutme.php") echo "class=\"current\""; ?> >
                    <a href="aboutme.php">About Me</a>
                </li>

                <li role="presentation" <?php if($fName == "music.php") echo "class=\"current\""; ?> >
                <a href="music.php">Web Development</a>
                </li>

                <li role="presentation" <?php if($fName == "photos.php") echo "class=\"current\""; ?> >
                <a href="photos.php">Graphic Design</a>
                </li>

                <li role="presentation" <?php if($fName == "links.php") echo "class=\"current\""; ?> >
                    <a href="links.php">Links</a>
                </li>
            </ul>
        </nav>
</header> 