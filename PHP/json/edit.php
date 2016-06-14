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

if ( ! isset($_REQUEST['profile_id']) ) {
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
}

$stmt = $pdo->prepare('SELECT * FROM Profile
    WHERE profile_id = :prof AND user_id = :uid');
$stmt->execute(array( ':prof' => $_REQUEST['profile_id'],
    ':uid' => $_SESSION['user_id']));
$profile = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $profile === false ) {
    $_SESSION['error'] = "Could not load profile";
    header('Location: index.php');
    return;
}

if ( isset($_POST['first_name']) && isset($_POST['last_name']) &&
     isset($_POST['email']) && isset($_POST['headline']) &&
     isset($_POST['summary']) ) {

    $msg = validateProfile();
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }

    $msg = validatePos();
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }

    $msg = validateEdu();
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }

    $stmt = $pdo->prepare('UPDATE Profile SET
        first_name=:fn, last_name=:ln,
        email=:em, headline=:he, summary=:su
        WHERE profile_id=:pid AND user_id=:uid');
    $stmt->execute(array(
        ':pid' => $_REQUEST['profile_id'],
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'])
    );


    $stmt = $pdo->prepare('DELETE FROM Position
        WHERE profile_id=:pid');
    $stmt->execute(array( ':pid' => $_REQUEST['profile_id']));

	
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
            ':pid' => $_REQUEST['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':desc' => $desc)
        );
        $rank++;
    }


    $stmt = $pdo->prepare('DELETE FROM Education
        WHERE profile_id=:pid');
    $stmt->execute(array( ':pid' => $_REQUEST['profile_id'] ));

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
            ':pid' => $_REQUEST['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':iid' => $institution_id)
        );
        $rank++;
    }

    $_SESSION['success'] = "Profile updated";
    header("Location: index.php");
    return;
}

$positions = loadPos($pdo, $_REQUEST['profile_id']);
$schools = loadEdu($pdo, $_REQUEST['profile_id']);

?>
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile Edit</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Editing Profile for <?= htmlentities($_SESSION['name']); ?></h1>
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
<form method="post" action="edit.php">
<input type="hidden" name="profile_id"
value="<?= htmlentities($_GET['profile_id']); ?>"
/>
<p>First Name:
<input type="text" name="first_name" size="60"
value="<?= htmlentities($profile['first_name']); ?>"
/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"
value="<?= htmlentities($profile['last_name']); ?>"
/></p>
<p>Email:
<input type="text" name="email" size="30"
value="<?= htmlentities($profile['email']); ?>"
/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"
value="<?= htmlentities($profile['headline']); ?>"
/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80">
<?= htmlentities($profile['summary']); ?>
</textarea>


<?php

$countEdu = 0;

echo('<p>Education: <input type="submit" id="addEdu" value="+">'."\n");
echo('<div id="edu_fields">'."\n");
if ( count($schools) > 0 ) {
    foreach( $schools as $school ) {
        $countEdu++;
        echo('<div id="edu'.$countEdu.'">');
        echo 
        '<p>Year: <input type="text" name="edu_year'.$countEdu.'" value="'.$school['year'].'" />
        <input type="button" value="-" onclick="$(\'#edu'.$countEdu.'\').remove();return false;">
        <p>School: <input type="text" size="80" name="edu_school'.$countEdu.'" class="school"
        value="'.htmlentities($school['name']).'" />';
        echo "\n</div>\n";
    }
}
echo("</div></p>\n");

$pos = 0;

echo('<p>Position: <input type="submit" id="addPos" value="+">'."\n");
echo('<div id="position_fields">'."\n");
foreach( $positions as $position ) {
    $pos++;
    echo('<div id="position'.$pos.'">'."\n");
    echo('<p>Year: <input type="text" name="year'.$pos.'"');
    echo(' value="'.$position['year'].'" />'."\n");
    echo('<input type="button" value="-" ');
    echo('onclick="$(\'#position'.$pos.'\').remove();return false;">'."\n");
    echo("</p>\n");
    echo('<textarea name="desc'.$pos.'" rows="8" cols="80">'."\n");
    echo(htmlentities($position['description'])."\n");
    echo("\n</textarea>\n</div>\n");
}
echo("</div></p>\n");
?>

<p>
<input type="submit" value="Save">
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

        var source = $('#edu-template').html();
        $('#edu_fields').append(source.replace(/@COUNT@/g,countEdu));

        $('.school').autocomplete({
            source: "school.php"
        })
    });
});
</script>
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