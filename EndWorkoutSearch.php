<?php
$mysqli = new mysqli("localhost", "user", "itws", "konamifitness");
if($mysqli->connect_error) {
  exit('Could not connect');
} 

$sql = "SELECT code, mets, category_id,description
FROM activity WHERE code = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($code, $mets, $catid, $desc);
$stmt->fetch();
$stmt->close();
echo "Your workout has been recorded.";


$sql2 = "INSERT INTO usertoworkout(userid, code, duration) VALUES(1,". $code . ",30)"; 
$stmt = $mysqli->query($sql2);



?>

