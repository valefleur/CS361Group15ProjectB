<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");

if($mysqli->connect_error){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$user = isset($_POST['AccountName']) ? $_POST['AccountName'] : '';
$pass = isset($_POST['psw']) ? $_POST['psw'] : '';

if(!($stmt = $mysqli->prepare("INSERT INTO `Account_Community`(`AccountID`, `CommunityID`, `Skill`, `StartDate`, `EndDate`) VALUES ((SELECT `AccountID` FROM `Account` WHERE `UserName` = $user AND `Password` = $pass),?,?,?,?)"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("isss",$_POST['CommunityID'],$_POST['CommunitySkill'],$_POST['startDate'],$_POST['endDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
   echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added volunteer to community.";    
}
    
?>
