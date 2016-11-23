<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");
// Displays errors
if($mysqli->connect_errno) {
  echo "Connection Error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/* Stores Community ID number*/
$idNum = isset($_GET['id']) ? $_GET['id'] : '';
?>
<!DOCTYPE html>
<html>
<!-- Copied from newaccount.php to keep consistent style *** Michael W. check to see if information is correct *** -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="I'll Go">
    <meta name="author" content="Group 15">
    <link rel="icon" href="../../favicon.ico">
    <!-- Could add php here to make the title the community name if we desire -->
    <title>I'll Go</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body>
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--Do we have a JPG logo?-->
          <a class="navbar-brand" href="index.php"><img src="images/logo.gif" width="75px" height="30px"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div>
            <ul class="nav navbar-nav">
              <li><a href="index.php">I'll Go</a></li>
              <li><a href="communities.php">Communities</a></li>
              <li><a href="something.php">Something</a></li>
              <li><a href="somethingelse.php">Something Else </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            	<!--This is where we can to update Login/Logout features, profile page link, etc.-->
              <?php
            //   if(isset($_SESSION['sessionActive'])) {
            //     echo "<li><a href='profile.php'><font color='#FDB829'>$_SESSION[firstname] $_SESSION[lastname]</font></a></li>";
            //     echo "<li><a href='logoutAction.php?action=end'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
            //   }
            //   else {
            //     echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
            //     echo "<li class='active'><a href='newaccount.php'><span class='glyphicon glyphicon-user'></span> Create Account</a></li>";
            //   }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
<?php
/* Retrieves Community location for Header*/
if(!($statement = $mysqli->prepare("SELECT `Name`, `State`, `Country` FROM `Community` WHERE `CommunityID`= $idNum "))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($name, $state, $country))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/* Spacing will likely be off without some styling */
while ($statement->fetch()) {
  echo "<h2>" . $name . "</h2>\n</div><div class='charInfo'><span>" . $state . "</span><p>" . $country . "</p></div>";
}
?>

<!-- Maybe put donate button up here and we can style it to be next to the name, state, country -->














<!--            Donate button above                -->
  <h4>Needs</h4>
   <div class="rosterDiv">
      <table border="1">
        <thead>
          <tr>
            <th>Need</th>
            <th>Comments</th>
          </tr>
        </thead>
<?php>
/* Retrieves Community needs to display*/
if(!($statement = $mysqli->prepare("SELECT `SkillNeeded`,`UserComments` FROM `Community` WHERE `CommunityID`= $idNum "))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($skill, $comment))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($statement->fetch()) {
    echo "\n<tr>\n<td>" . $skill . "</td>\n<td>" . $comment . "</td>\n</tr>";
}
?>
      </table>
    </div>
    
<!--         Sign up to volunteer time and training to a community            -->



    
    
    
    
    
    
    
    
    

<!--               Volunteer to community above               -->

        <footer class="footer">
        <div class="container">
          <div class="col-xs-6">
            <p class="text-muted">&copy; I'll Go, Inc.</p>
          </div>
        </div>
      </footer>
  </body>
</html>
