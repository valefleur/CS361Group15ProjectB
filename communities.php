<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");
// Displays errors
if($mysqli->connect_errno) {
  echo "Connection Error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Opportunities</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <div class="header">
      
      <h1>Opportunities</h1>
    </div>
    <div class="rosterDiv">
      <table border="1">
        <thead>
          <tr>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Skill Needed</th>
            <th>Comments</th>
          </tr>
        </thead>
<?php
if(!($statement = $mysqli->prepare("SELECT `Name`,`State`, `Country`, `SkillNeeded`,`UserComments` FROM `Community` "))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($name, $state, $country, $skill, $comment))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($statement->fetch()) {
  echo "\n<tr>\n<td>" . $name . "</td>\n<td>" . $state . "</td>\n<td>" . $country . "</td>\n<td>" . $skill . "</td>\n<td>" . $comment . "</td>\n</tr>";
}
$statement->close();
 ?>
      </table>
    </div>
<div>
  <form method="post" action="AddOpportunity.php">
  
    <fieldset>
       <legend>Add Opportunity</legend>
        <p>City: <input type="text" name="Name"/></p>
        <p>State: <input type="text" name="State"/></p>
        <p>Country: <input type="text" name="Country"/></p>
        <p>Skill Needed: <input type="text" name="Skill"/></p>
        <p>Comments: <input type="text" name="Comment"/></p>  
        <p><input type="submit"/></p>
    </fieldset>  
  </form>
</div>  
<!-- End of important stuff -->




  </body>
</html>