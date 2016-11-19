<?php
// include 'storedInfo.php';
// Group 15
// Oregon State University
// CS 361
// Project B
// Fall 2016
//  This page is used with an AJAX call on the newaccount.php.  It checks if the username being input already exists.

// Change DB info
$mysqli = new mysqli("db.com", "??_db", "password", "??_db");


if(isset($_POST["username"])) {
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
    $username =  strtolower(trim($_POST["username"]));
    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

    $results = mysqli_query($mysqli,"SELECT id FROM Account WHERE UserName='$username'");
    // # of times username occurs: 1 or 0
    $username_exists = mysqli_num_rows($results); //total records
    if($_POST['type'] === 'create') {
      if($username_exists) {
        echo "<span class='glyphicon glyphicon-alert'></span> This username is Taken";
      }else{
        echo "<span class='glyphicon glyphicon-ok'></span> This username is Available";
      }
    }
    if($_POST['type'] === 'login') {
      if($username_exists) {
        echo "<span class='glyphicon glyphicon-ok'></span> This username is legit.";
      }else{
        echo "<span class='glyphicon glyphicon-alert'></span> This username doesn't exist.";
      }
    }
    mysqli_close($connectDB);
}
?>
