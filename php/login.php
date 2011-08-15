<?php
session_start();
$user=$_POST['username'];
$pass=$_POST['password'];
$sql = "SELECT * FROM students WHERE username = '$user' and password='$pass'";
try{
	$dbh=new PDO("sqlite:test3.db");
   	$stmt=$dbh->query($sql);
   	if(!$stmt) {
    	throw new Exception('SQL query failed');
    }
        $row=$stmt->fetchAll();
	$count=count($row);
   	if($count==1){
    	$_SESSION['username']=$user;
    	$_SESSION['loggedin']=True;
    	//echo $_SESSION['username'];
    	$sid=$row[0];
    	$_SESSION['sid']=$sid['sid'];
    	//echo $_SESSION['sid'];
	if($user != aschneider){
        header("location:profile.php");
        }
	else{
	header("location:admin.php");
	}
	}else{
              header("location:login_err.php");
    } 

}
catch(Exception $e){
	echo $e->getMessage();
}
?>
