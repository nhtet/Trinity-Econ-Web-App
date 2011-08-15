<?
session_start();
if(!isset($_SESSION['username'])){
header("loation:login.php");
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
        <h1><a href="index.html">Trinity Game<span> Theory Website</span> <small><span>Trinity Game Theory Beta</span></small></a></h1>
      </div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="profile.php"><span>Home Page</span></a></li>
          <li><a href="rules.php"><span>Game Rules</span></a></li>
          <li><a href="#"
          	onmouseover="mopen('m1')"
          	onmouseout="mclosetime()"><span>Games</span></a>
          	<div id="m1"
          		onmouseover="mcancelclosetime()"
          		onmouseout="mclosetime()">
          	<a href="bistro.php">Bistro Game</a>
       
          	</div>
                   
          
          </li>
          <li><a href="#"><span>Blog</span></a></li>
          <li><a href="contact.php"><span>Contact Us</span></a></li>
        </ul>
      </div>
      

      </div>
    </div>
    
    <span class = "logout">Logout</span>
    <div class="content">
    
		<div class="table">
		<table border="0">
		<caption><h3>Welcome back <?php echo$_SESSION['username']?></h3></caption>
		<tr><td>Player Name:</td><td><span class="tt"><?php echo$_SESSION['username']?></span></td></tr>
		<tr><td>Last time logged in:</td><td><span class="tt">March 20, 2011, 11:33:22 PM</span></td></tr>
		<tr><td>Games enrolled: </td><td><span class="tt">Bistro Gmae</span></td></tr>
		</table>
		</div>
    </div>
</div>
</body>
</html>
