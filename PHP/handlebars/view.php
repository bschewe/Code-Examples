<?php
// No pdo.php
require_once 'util.php';
session_start();

// Make sure the REQUEST parameter is present
if ( ! isset($_GET['profile_id']) ) {
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile View</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Profile information</h1>
<div id="view-area"><img src="spinner.gif"></div>
<a href="index.php">Done</a>
</p>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.11.4.js"></script>
<script src="js/handlebars.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script id="profile-template" type="text/x-handlebars-template">
  <p>First Name: {{profile.first_name}}</p>
  <p>Last Name: {{profile.last_name}}</p>
  <p>Email: {{profile.email}}</p>
  <p>Headline:<br/>{{profile.headline}}</p>
  <p>Summary:<br/>{{profile.summary}}</p>
  <p>
  {{#if schools.length}}
    <p>Education</p><ul>
    {{#each schools}}
      <li>{{year}}: {{name}}</li>
    {{/each}}
    </ul>
  {{/if}}
  {{#if positions.length}}
    <p>Postions</p><ul>
    {{#each positions}}
      <li>{{year}}: {{description}}</li>
    {{/each}}
    </ul>
  {{/if}}
</script>

<script>
$(document).ready(function(){
    $.getJSON('profiles.php?profile_id=<?= htmlentities($_GET['profile_id']) ?>', function($profiles) {
        window.console && console.log($profiles);
        source  = $("#profile-template").html();
        template = Handlebars.compile(source);
        $('#view-area').replaceWith(template($profiles));
    }).fail( function() { alert('getJSON fail'); } );
});
</script>
</div>
</body>
</html>
