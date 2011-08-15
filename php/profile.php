<?php
session_start();
if(!isset($_SESSION['username'])){
header("loation:login.php");
}
if($_SESSION['loggedin'] != True){
header("location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="../css/econ-style.css" type="text/css" media="screen" 
		  charset="utf-8"/></head>
		  <title>Trinity Game Theory - Home</title>
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
          <li class="active"><a href="profile.php"><span>Home Page</span></a></li>
          <li><a href="rules.php"><span>Game Rules</span></a></li>
          <li><a href="bistro.php"><span>Bistro Game</span></a></li>
          <li><a href="#"><span>Blog</span></a></li>
          <li><a href="contact.php"><span>Contact Us</span></a></li>
        </ul>
      </div>
      

      </div>
    </div>
    
    <a href="logout.php"><span class = "logout">Logout</span></a>
    <div class="content">
    
		<div class="table">
		<table border="0">
		<caption><h3>Welcome <?php echo$_SESSION['username']?></h3></caption>
		<tr><td>Player Name:</td><td><span class="tt"><?php echo$_SESSION['username']?></span></td></tr>
		<tr><td>Games enrolled: </td><td><span class="tt">Bistro Gmae</span></td></tr>
		</table>
		</div>
    </div>
</div>
</body>
</html>
