<?php // Do not put any HTML above this line
// Note - no need to include pdo.php
require_once 'util.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile Registry</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Blake Schewe's Profile Registry</h1>
<?php 
flashMessages();

if ( isset($_SESSION['user_id']) ) {
   echo('<p><a href="logout.php">Logout</a></p>'."\n");
} else {
   echo('<p><a href="login.php">Login</a></p>'."\n");
}
?>
<div id="list-area"><img src="spinner.gif"></div>
<?php
if ( isset($_SESSION['user_id']) ) {
   echo('<p><a href="form.php">Add</a></p>'."\n");
} 
?>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.11.4.js"></script>
<script src="js/handlebars.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script id="list-template" type="text/x-handlebars-template">
  {{#if profiles.length}}
    <p><table border="1">
      <tr><th>Name</th><th>Headline</th>
      {{#if ../loggedin}}<th>Action</th>{{/if}}</tr>
      {{#each profiles}}
        <tr><td><a href="view.php?profile_id={{profile_id}}">
        {{first_name}} {{last_name}}</a>
        </td><td>{{headline}}</td>
        {{#if ../loggedin}}
          <td>
          <a href="form.php?profile_id={{profile_id}}">Edit</a> 
          <a href="delete.php?profile_id={{profile_id}}">Delete</a>
          </td>
        {{/if}}
        </tr>
      {{/each}}
    </table></p>
  {{/if}}
</script>

<script>
$(document).ready(function(){
    $.getJSON('profiles.php', function(profiles) {
        window.console && console.log(profiles);
        var source  = $("#list-template").html();
        var template = Handlebars.compile(source);
        var context = {};
        context.loggedin = 
            <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
        context.profiles = profiles;
        $('#list-area').replaceWith(template(context));
    }).fail( function() { alert('getJSON fail'); } );
});
</script>
</div>
</body>
