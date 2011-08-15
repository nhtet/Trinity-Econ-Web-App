<?php
session_start();
if(!isset($_SESSION['username'])){
header("loation:login.php");
}else{
$sid=$_SESSION['sid'];
$gid=$_SESSION['gid'];
if($gid>1){
/*Total Adv Demand*/
$dbh = new PDO("sqlite:test3.db");
$stmt_tprofit=$dbh->prepare("SELECT tprofit FROM Profit WHERE gid=:game and sid=:sid");
$stmt_tprofit->bindParam(':game',$gid,PDO::PARAM_INT);
$stmt_tprofit->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_tprofit->execute())){
        throw new Exception('SQL for Total Profit query failed');
}else{
         $row_tprofit = $stmt_tprofit->fetchAll();
         $tprofit=$row_tprofit[0][0];
}
           }     


$check = True;
$mealprice=$_POST['mealprice'];
$adprice=$_POST['adprice'];

if($gid ==1 && $adprice!=0){
        $check = False;
        header("location:bistro.php");
}
if($mealprice>400){
        $check = False;
        header("locatoin:bistro.php");

}
/*if($gid !=1 && $adprice > $tprofit){
        $check = False;
        header("location:bistro.php");
}*/

if($check==True){
try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->prepare("SELECT max(gid) FROM Gameround");
if (!($stmt->execute()))
  {
  throw new Exception('SQL query failed');
  }
$row = $stmt->fetchAll();
$gid=$row[0][0];

$insert = $dbh->prepare("INSERT INTO Price VALUES(?,?,?,?)");
if (!$insert){
throw new Exception('SQL query failed1\n');
exit;
}
$insert->execute(array($sid,$gid,$mealprice,$adprice));
if(!$insert){
throw new Exception('SQL query failed2');
}else{
header('location:profile.php');
}
}
catch(Exception $e){
	echo $e->getMessage();
}
}
else{
        header('location:bistro.php');
}
}
?>
