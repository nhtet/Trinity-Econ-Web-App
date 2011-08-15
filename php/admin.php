<?php
session_start();
if(!isset($_SESSION['username'])){
header("loation:index.php");
}
if($_SESSION['username'] != 'aschneider'){
header("location:index.php");
}
try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->prepare("SELECT max(gid) FROM Gameround");
if (!($stmt->execute()))
  {
  throw new Exception('SQL query failed');
  }
$row = $stmt->fetchAll();
$gid=$row[0][0];
}
catch(Exception $e){
	echo $e->getMessage();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="../css/econ-style.css" type="text/css" media="screen" 
		  charset="utf-8"/></head>
		  <title>Trinity Game Theory - Bistro Game</title>
<script type="text/javascript" src="../js/dropdowntabs.js">
</script>
<body>
<div class="main">

  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.php">Trinity Game<span> Theory Website</span> <small><span>Trinity Game Theory Beta</span></small></a></h1>
      </div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="admin.php"><span>Home Page</span></a></li>
          <li><a href="rules.php"><span>Game Rules</span></a></li>
          <li><a href="bistro.php"><span>Bistro Game</span></a></li>
          <li><a href="blog.php"><span>Blog</span></a></li>
          <li><a href="contact.php"><span>Contact Us</span></a></li>
        </ul>
      </div>
      

      </div>
    </div>
    
    <a href="logout.php"><span class = "logout">Logout</span></a>
    <div class="content">
		<div class="bhead"><h3> Welcome <?php echo$_SESSION['username']?>! </h3></div>
		<div class= "adminbutt">
	<ul>
	<li><a href="#" onclick="lock()">LOCK THE GAME</a></li>
	<li><a href="#" onclick="unlock()">UNLOCK THE GAME</a></li>
	
	<?php
	$str='<li><a href="../php/evaluate.php?game='.$gid.'">EVALUATE THE CURRENT ROUND</a></li>';
	echo $str;
	?>
	
	</ul>
	</div>
		<br/><br/><br/><br/><br/><br/><br/><br/>
		<div class="tablink">
		<h2> <span class="thl">Results from the Previous Rounds </span></h2>
		<?php
		$gid = $gid; 
		while($gid >0){
		        $str = '<a href="gentab.php?game='.$gid.'"> Round '. $gid.'</a><br/>';
		        echo $str;
		        $gid = $gid-1; 
		}
		?>
		</div>
    </div>
</div>
</body>
<script type="text/javascript">
        var lock = function(){
                alert('The current game round has been successfully locked!')
        };
        var unlock = function(){
                alert('The current game round has been successfully locked!')
        };
</script>
</html>
