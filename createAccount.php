<?php
include 'storedInfo.php';
// Group 15
// Oregon State University
// CS 361
// Project B
// Fall 2016

//  Need to update the db info here too
$connectDB = new mysqli("oniddb.cws.oregonstate.edu","??-db",$myPassword,"??-db") or die("Failed to connect to MySQL");

$un = $_POST['username'];
$pw = $_POST['password'];
$ed = $_POST['educator'];
$fn = $_POST['firstName'];
$ln = $_POST['lastName'];

if(!$stmt = $connectDB->prepare("INSERT INTO Account(UserName, Password, Educator, FirstName, LastName) VALUES (?, ?, ?, ?, ?)")) {
  echo "Prepare failed.";
}
if(!$stmt->bind_param("ssiss", $un, $pw, $ed, $fn, $ln)) {
  echo "Bind Param failed.";
}
if(!$stmt->execute()) {
  echo "Execute failed.";
}
echo "Your new account was created. Click the Login button to Login.";
mysqli_close($connectDB);
?>