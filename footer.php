<div class="container">
    <section>
    <div class="col-xs-12" id="sm_buttons">
        <div class="col-xs-4">
        <a href="https://instagram.com/_blakemichigan/">
            <p style="display:none;">Instagram</p>
            <i class="fa fa-instagram fa-3x" ></i>
        </a>
        </div>
        <div class="col-xs-4">
        <a href="https://twitter.com/_blakemichigan">
            <p style="display:none;">Twitter</p>
            <i class="fa fa-twitter fa-3x"></i>
        </a>
        </div>
        <div class="col-xs-4">
        <a href="https://www.facebook.com/blake.schewe">
            <p style="display:none;">Facebook</p>
            <i class="fa fa-facebook fa-3x"></i>
        </a>
        </div>
    </div>
    </section>
	</div>
    <div class="col-xs-12" id="footer">
        <p>
        <?php
        date_default_timezone_set('America/Detroit');
        echo "It's currently " . date("h:iA") ;
        echo "<br>File last modified: " . date("F d Y H:i:s.", filemtime($fName2));
        echo "<br>";
        ?>
        &copy; Blake Schewe 2016, University of Michigan
    </div>