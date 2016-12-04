<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");

if($mysqli->connect_error){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}



$cid = $_POST['CommunityID'];
$user = $_POST['AccountName'];
$pass = $_POST['psw'];
$rawdate1 = htmlentities($_POST['startDate']);
$date1 = date('Y-m-d', strtotime($rawdate1));
$rawdate2 = htmlentities($_POST['endDate']);
$date2 = date('Y-m-d', strtotime($rawdate2));



if(!($stmt = $mysqli->prepare(SELECT `AccountID` FROM `Account` WHERE `UserName` = $user AND `Password` = $pass))){
echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($aid)){
echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
$stmt->close();


if(!($stmt = $mysqli->prepare("INSERT INTO `Account_Community`(`AccountID`, `CommunityID`, `Skill`, `StartDate`, `EndDate`) VALUES (?,?,?,?,?)"))){
    	echo "cid: " . $cid . ", user: " . $user . ", pass: " . $pass . ", skill: " . $_POST['CommunitySkill'] . ", start: " .  $date1 . ", end: " . $date2;
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("iisss", $aid, $cid, $_POST['CommunitySkill'], $date1, $date2))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
   echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Added volunteer to community.";    
}

$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
header("Location: {$redirect}/community.php?id=" . $cid, true);
die();
    
?>
