<?php
$sid=
$rowid=$_POST['row']
$mealprice= $_POST['mealprice'];
$adprice= $_POST['adprice'];

try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->query($sql);
if (!$stmt)
  {
  throw new Exception('SQL query failed');
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
