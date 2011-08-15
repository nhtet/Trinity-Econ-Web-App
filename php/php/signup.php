<?php
$user= $_POST['username'];
$pass= $_POST['password'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$sql="SELECT * FROM Students";
echo "linked here";

try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->query($sql);
if (!$stmt)
  {
  throw new Exception('SQL query failed');
  }

$row = $stmt->fetch( PDO::FETCH_BOTH , PDO::FETCH_ORI_NEXT);
while($row!=null){
  if ($row['username'] == $user){
  	echo 'Username already exit';
  	//header ("Location: ../html/login.php");
  	exit;  	
  }
  else{
  	$row = $stmt->fetch( PDO::FETCH_BOTH , PDO::FETCH_ORI_NEXT);
  }
  }
  
$insert=$dbh->prepare("INSERT INTO Students (sid,username,password,email,dob,sex) VALUES (?,?,?,?,?,?)");
if (!$insert){
throw new Exception('SQL query failed1\n');
}
$insert->execute(array(NULL,$user,$pass,$dob,$email,$sex));
if(!$insert){
throw new Exception('SQL query failed2');
}
$yellow=$insert->fetchAll();
$newrow=count($yellow);
echo $newrow;


}
catch(Exception $e){
	echo $e->getMessage();
}

echo "shit code";
?>
