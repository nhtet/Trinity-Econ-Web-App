<?php
session_start();
if(!isset($_SESSION['username'])){
header("loation:login.php");
}
if($_SESSION['loggedin'] != True){
header("location:index.php");
}else{
$sid=$_SESSION['sid'];
try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->prepare("SELECT max(gid) FROM Gameround");
if (!($stmt->execute()))
  {
  throw new Exception('SQL query failed');
  }
$row = $stmt->fetchAll();
$gid=$row[0][0];
$_SESSION['gid']=$gid;

if($gid>1){
$stmt = $dbh->prepare("SELECT tprofit FROM Profit WHERE sid=:sid AND gid=:gid");
$tempgid=$gid-1;
$stmt->bindParam(':sid',$sid,PDO::PARAM_INT);
$stmt->bindParam(':gid',$tempgid,PDO::PARAM_INT);
if (!($stmt->execute()))
  {
  throw new Exception('SQL query failed');
  }
$row_t = $stmt->fetchAll();
$tprofit=$row_t[0][0]; 
}
else{
$tprofit=0;
}

/*Get the elimination*/
$stmt_elimination= $dbh->prepare("SELECT elimination FROM Elimination where sid=:sid");
$stmt_elimination->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_elimination->execute()))
  {
  throw new Exception('SQL select elimination query failed');
  }
$row_elimination=$stmt_elimination->fetchAll();
$elimination=$row_elimination[0][0];
}
catch(Exception $e){
	echo $e->getMessage();
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.js"></script>
	<link rel="stylesheet" href="../css/econ-style.css" type="text/css" media="screen" 
		  charset="utf-8"/></head>
		  <title>Trinity Game Theory - Bistro Game</title>
<script type="text/javascript" src="../js/dropdowntabs.js">
</script>
<script type="text/javascript">
        function priceCheck(){
                var meal = $('#mealprice').val();
                var ad   = $('#adprice').val();
                var profit = $('#profit').val();
                if(meal > 400){
                        alert('Warning: You cannot meal price cannot be over $400!');
                        return;
                }
                if(gid==1 && ad != 0){
                        alert('Warning: You cannot put Advertisemnet Price for Round 1!');
                        return;
                }
                if(gid >1 && ad>profit){
                        alert('Warning: You advertisement cost is higher than your total profit!');
                }
                else{
                        return;
                }
        }
        
        
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
		<div class="bhead"><h3> Welcome to Bistro Game! </h3></div>
		 <?php
		 
                $str = '<tr><td>'+ROUND+'</td><td>'+MealPrice+'</td><td>'+AdPrice+'</td><td>'+Profit+'</td></tr>';
                          
   
                ?> 
		<div class="history">
			<table border="0">
			<caption><h4>Review Your Recent Price History</h4></caption>
			<tr><th>Round</th><th>Meal Price($)</th><th>Advertising Cost($)</th><th>Profit($)</th></tr>
			<?php
		        $newgid = $gid-1; 
		        while($newgid >0){
		        $str = '<tr><td><a href="gentab.php?game='.$newgid.'"></a></td><td></td><td></td><td></td>';
		        echo $str;
		        $newgid = $newgid-1; 
		}
		?>
			</table>
		</div>	
			
			
		<?php
		$go  = '<div class="game-submit"><form name="go" onsubmit="return priceCheck('.$gid.');" action="insertvalue.php" method="post"><table border="0"><caption><h3>Your current profit: $ ';
		$go .= $tprofit;
		$go .= '</h3></caption><tr><th colspan="2">Currnt Round: '.$gid.'</th></tr><tr><td>Price for meal:</td><td><span class="tt"><label><input type="text" id="mealprice" name="mealprice" size="30"/></label></span></td></tr>
		<tr><td>Price for advertisement:</td><td><span class="tt"><label><input type="text" id ="adprice" name="adprice" size="30"/></label></span></td></tr>
		<tr><td colspan="2" align="center">';
		$go .= '<input type="submit"  name="submit" value="Submit"/></td></tr></table></form></div>';
		$sad = '<div id="eliminated"><img id="face" src="../images/sad.jpg" height="180" width="200"><span class="el">You have been eliminated!</span>		
		</div>';
		echo $POST_["adprice"];
		if ($elimination == 'False'){	
			echo $go;
			}
		else
		        echo $sad;		
		$hid = '<input type="hidden" id="profit" value="'.$tprofit.'">';
		echo $hid;
		?>
			
		
		<div class="tablink">
		<h2> <span class="thl">Results from the Previous Rounds </span></h2>
		<?php
		$newgid=$gid-1;
		while($newgid >0){
		        $str = '<a href="gentab.php?game='.$newgid.'"> Round '. $newgid.'</a><br/>';
		        echo $str;
		        $newgid = $newgid-1; 
		}
		?>
		</div>
    </div>
</div>

</body>
</html>
