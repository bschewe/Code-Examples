<?php

require_once 'pdo.php';
require_once 'util.php';

session_start();

if ( ! isset($_SESSION['user_id']) ) {
    die("ACCESS DENIED");
    return;
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}


if ( isset($_POST['first_name']) && isset($_POST['last_name']) &&
     isset($_POST['email']) && isset($_POST['headline']) &&
     isset($_POST['summary']) ) {

    $msg = validateProfile();
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    $msg = validatePos();
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    $msg = validateEdu();
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    $stmt = $pdo->prepare('INSERT INTO Profile(first_name, last_name, email, headline, summary, user_id) VALUES
        (:fn, :ln, :em, :he, :su, :id)');
    $stmt->execute(array(
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'],
        ':id' => $_SESSION['user_id'])
    );

    $stmt = $pdo->prepare('SELECT profile_id FROM Profile 
        WHERE first_name = :fn');
    $stmt->execute(array(':fn' => $_POST['first_name']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $profile_id = $row['profile_id'];

    $rank = 1;
    for($i=1; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;
        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];

        $stmt = $pdo->prepare('INSERT INTO Position
            (profile_id, rank, year, description)
        VALUES ( :pid, :rank, :year, :desc)');
        $stmt->execute(array(
            ':pid' => $profile_id,
            ':rank' => $rank,
            ':year' => $year,
            ':desc' => $desc)
        );
        $rank++;
    }

    $rank=1;
    for($i=1; $i<=9; $i++){
        if( ! isset($_POST['edu_year'.$i]) ) continue;
        if( ! isset($_POST['edu_school'.$i]) ) continue;
        $year = $_POST['edu_year'.$i];
        $school = $_POST['edu_school'.$i];

        $institution_id = false;
        $stmt = $pdo->prepare('SELECT institution_id FROM 
            Institution WHERE name=:name');
        $stmt->execute(array(':name' => $school));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if( $row !== false ) $institution_id = $row['institution_id'];

        if( $institution_id === false ) {
            $stmt = $pdo->prepare('INSERT INTO Institution(name)
                VALUES (:name)');
            $stmt->execute(array(':name' => $school));
            $institution_id = $pdo->lastInsertId();
        }

        $stmt = $pdo->prepare('INSERT INTO Education(profile_id, rank, year, institution_id)
            VALUES ( :pid, :rank, :year, :iid)');
        $stmt->execute(array(
            ':pid' => $profile_id,
            ':rank' => $rank,
            ':year' => $year,
            ':iid' => $institution_id)
        );
        $rank++;
    }

    $_SESSION['success'] = "Profile added";
    header("Location: index.php");
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
<title> Blake Schewe's Profile Edit</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Adding Profile for <?= htmlentities($_SESSION['name']); ?></h1>
<?php
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
?>
<form method="post" action="add.php">
<p>First Name:
<input type="text" name="first_name" size="60"
value=""
/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"
value=""
/></p>
<p>Email:
<input type="text" name="email" size="30"
value=""
/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"
value=""
/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80">
</textarea>


<?php

$countEdu = 0;

echo('<p>Education: <input type="submit" id="addEdu" value="+">'."\n");
echo('<div id="edu_fields">'."\n");
echo("</div></p>\n");

$pos = 0;
echo('<p>Position: <input type="submit" id="addPos" value="+">'."\n");
echo('<div id="position_fields">'."\n");
echo("</div></p>\n");
?>

<p>
<input type="submit" value="Add">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script   src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"   integrity="sha256-0vBSIAi/8FxkNOSKyPEfdGQzFDak1dlqFKBYqBp1yC4="   crossorigin="anonymous"></script>

<script>
countPos = <?= $pos ?>;
countEdu = <?= $countEdu ?>;


// http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
$(document).ready(function(){
    window.console && console.log('Document ready called');
    $('#addPos').click(function(event){
        // http://api.jquery.com/event.preventdefault/
        event.preventDefault();
        if ( countPos >= 9 ) {
            alert("Maximum of nine position entries exceeded");
            return;
        }
        countPos++;
        window.console && console.log("Adding position "+countPos);
        $('#position_fields').append(
            '<div id="position'+countPos+'"> \
            <p>Year: <input type="text" name="year'+countPos+'" value="" /> \
            <input type="button" value="-" \
            onclick="$(\'#position'+countPos+'\').remove();return false;"></p> \
            <textarea name="desc'+countPos+'" rows="8" cols="80"></textarea>\
            </div>');
    });


    $('#addEdu').click(function(event){
        event.preventDefault();
        if ( countEdu >= 9 ) {
            alert("Maximum of nine education entries exceeded");
            return;
        } 
        countEdu++;
        window.console && console.log("Adding education "+countEdu);

        //Grab some HTML with hot spots and insert into DOM
        var source = $('#edu-template').html();
        $('#edu_fields').append(source.replace(/@COUNT@/g,countEdu));

        //Add the event handler to the new ones
        $('.school').autocomplete({
            source: "school.php"
        })
    });
});
</script>
<!-- HTML with Substitution hot spots -->
<script id="edu-template" type="text">
    <div id="edu@COUNT@">
        <p>Year: <input type="text" name="edu_year@COUNT@" value="" />
        <input type="button" value="-" onclick="$('#edu@COUNT@').remove();return false;"><br>
        <p>School: <input type="text" size="80" name="edu_school@COUNT@" class="school" value="" />
        </p>
    </div>
</script>
</div>
</body>
</html>