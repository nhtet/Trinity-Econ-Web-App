<?php
session_start();
$check = True;
$fname=$_POST['fname'];
if($fname==''){
        $check = False;
        header("location:signup.php");
        
}
//echo $fname;
$user= $_POST['username'];
if($user==''){
        $check = False;
        header("location:signup.php");
        
}
//echo $user;
$pass= $_POST['password'];
if($pass==''){
        $check = False;
        header("location:signup.php");        
}
$repass= $_POST['repassword'];
if($repass==''){
        $check = False;
        header("location:signup.php");        
}
if($pass!=$repass){
        $check = False;
        header("location:signup.php");
        
}
//echo $pass;
$dob = $_POST['dob'];
if($dob==''){
        $check = False;
        header("location:signup.php");
        
}
//echo $dob;
$email = $_POST['email'];
if($email==''){
        $check = False;
        header("location:signup.php");        
}

if ((!ereg(".+\@.+\..+", $email)) || (!ereg("^[a-zA-Z0-9_@.-]+$", $email))){
        $check = False;
        header("location:signup.php");
}

//echo $email;
$sex = $_POST['sex'];
//echo $sex;
//$sql="SELECT * FROM Students";
try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->prepare("SELECT * FROM Students WHERE username=:username");
$stmt->bindParam(':username',$user,PDO::PARAM_STR);
if (!($stmt->execute()))
  {
  throw new Exception('SQL query failed');
  }
$row = $stmt->fetch( PDO::FETCH_BOTH , PDO::FETCH_ORI_NEXT);
if ($row!=null){
        //print_r($row);
  	echo 'Username already exit';
  	header("location:login.php");
  	exit;  	
}else
{
if($check==True){  
        $insert=$dbh->prepare("INSERT INTO Students (sid,fullname,username,password,email,dob,sex) VALUES (?,?,?,?,?,?,?)");
}
if($check==False){
        header("location:signup.php");
}
if (!$insert){
throw new Exception('SQL query failed1\n');
exit;
}
$insert->execute(array(NULL,$fname,$user,$pass,$dob,$email,$sex));
if(!$insert){
throw new Exception('SQL query failed2');
}
else{

 $select=$dbh->prepare("SELECT * FROM Students WHERE username=:username");
 $select->bindParam(':username',$user,PDO::PARAM_STR);
        if (!$select->execute())
        {
                throw new Exception('SQL query failed selection');
        }
        $row=$select->fetchAll();
        $sid=$row[0][0];
        session_start();
    	$_SESSION['sid']=$sid['sid'];
        $_SESSION['username']=$user;
        $_SESSION['loggedin']=True;        
        $insert=$dbh->prepare("INSERT INTO Elimination (sid,gid,elimination) VALUES (?,?,?)");
        if (!$insert){
                throw new Exception('SQL query failed1\n');
        exit;
        }
        #print $sid;
        $insert->execute(array($sid,1,'False'));
        if(!$insert){
                throw new Exception('SQL query failed2');
        }
        header("location:profile.php");
}

}
}
catch(Exception $e){
	echo $e->getMessage();
}

?>
