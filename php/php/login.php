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
    	//echo $_SESSION['username'];
    	$sid=$row[0];
    	$_SESSION['sid']=$sid['sid'];
    	//echo $_SESSION['sid'];
        header("location:profile.php");
        }else{
        
                echo "Wrong Username or Password";
    } 

}
catch(Exception $e){
	echo $e->getMessage();
}
?>
