<?php
$tbl_name="students";
//$host="localhost";//Host name
$myusername='gchen';	//$_POST['myusername'];
$mypassword='gchen123';	//$_POST['mypassword'];
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
//$sql="SELECT * FROM $tbl_name WHERE students='$myusername' and password='$mypassword'";
try{
   $dbh=new PDO("sqlite:test.db");
   $stmt=$dbh->query($sql);
   if(!$stmt) {
	throw new Exception('SQL query failed');
	}
   //$count=$stmt->rowCount();	// will always be zero
   $count=count($stmt->fetchAll());
   if($count==1){
        $_SESSION['myusername']=$myusername;
        header("location:login_sucess.php");
        }else{
                echo "Wrong Username or Password";
       }     
   }
catch (Exception $e){
        echo $e->getMessage();
}

?>
