<?php
session_start();//NEED to Change
$_SESSION['Student']=1;//NEED to Change
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
          <li class="active"><a href="index.php"><span>Home Page</span></a></li>
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
		<div class="bhead"><h3> Welcome to Bistro Game! </h3></div>
		
		<div class="history">
			<table border="0">
			<caption><h4>Review Your Recent Price History</h4></caption>
			<tr><th>Round</th><th>Meal Price($)</th><th>Advertising Cost($)</th><th>Profit($)</th></tr>
			<tr><td align="center"><a href="#">1</a></td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
			<tr><td align="center"><a href="#">2</a></td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
			<tr><td align="center"><a href="#">3</a></td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
			<tr><td align="center"><a href="#">4</a></td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
			</table>
		</div>
		
		<div class="game-submit">
		<form action="../php/insertvalue.php" action="post">
		<table border="0">
		<caption><h3>Your current profit: $ 500</h3></caption>
		<tr><th colspan="2">Currnt Round: 5</th></tr>
		<tr><td>Price for meal:</td><td><span class="tt"><label><input type="text" name="mealprice" size="30"/></label></span></td></tr>
		<tr><td>Price for advertisement:</td><td><span class="tt"><label><input type="text" name="adprice" size="30"/></label></span></td></tr>
		<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit"/></td></tr>		</table>
		</form>
		</div>
		
		
		<div class="result">
		<table border="2" bgcolor="#ececec">
		<caption><h4> Round 4 Result </h4></caption>
		<tr><th>Name</th><th>Meal Price($)</th><th>Advertising Cost($)</th><th>Profit($)</th></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		<tr><td align="center">Homer</td><td align="center">400</td><td align="center">3000</td><td align="center">-400</td></tr>
		
		</table>
		</div>
		
		
    </div>
</div>
</body>
</html>
