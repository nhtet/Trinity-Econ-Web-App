<?php

session_start();
if(!isset($_SESSION['username'])){
header("loation:login.php");
}else{
$sid=$_SESSION['sid'];
$game=$_GET['game']; 
if ($game!=1){
$str='<div class="result"><table border="2" bgcolor="#ececec"><caption><h4> Round '. $game .' Result </h4></caption>
		<tr><th>Name</th><th>Price</th><th>Advertising</th><th>New Demand</th><th>Adv Demand</th><th>15% of R'
		.($game-1).'</th><th>Tot Demand</th><th>Revenue</th><th>Cost</th><th>Profit'.$game.'</th><th>Previous 
		Profit</th><th>Total Profit</th><th>15% of R'.$game.'</th><th>Adv Profit</th></tr>';
}else{

$str='<div class="result"><table border="2" bgcolor="#ececec"><caption><h4> Round '. $game .' Result </h4></caption>
		<tr><th>Name</th><th>Price</th><th>Advertising</th><th>New Demand</th><th>Revenue</th><th>Cost</th><th>Profit of Game'.$game.'</th><th>15% of R'.$game.'</th></tr>';
}
try{		
$dbh = new PDO("sqlite:test3.db");
$stmt_lop = $dbh->prepare("SELECT sid FROM Students");
$stmt_lop->execute();
$row = $stmt_lop->fetchAll();
$c = count($row);
#print_r('This is the row \n');
#print_r($row);

/*Select the sid with the highest profit*/
$stmt_phighest = $dbh->prepare("SELECT MAX(tprofit) FROM Profit where gid=:game");
$stmt_phighest->bindParam(':game',$game,PDO::PARAM_INT);
if (!($stmt_phighest->execute())){
      throw new Exception('SQL for Cost query failed');
}else{
      $row_phighest = $stmt_phighest->fetchAll();
      $highest_profit=$row_phighest[0][0];
      #print $elimination;
}
$stmt_shighest = $dbh->prepare("SELECT sid FROM Profit where tprofit=:highest");
$stmt_shighest->bindParam(':highest',$highest_profit);
if (!($stmt_shighest->execute())){
      throw new Exception('SQL for Cost query failed');
}else{
      $row_sid = $stmt_shighest->fetchAll();
      $high_sid=$row_phighest[0][0];
      #print $elimination;
}

for ($i=1; $i<$c; $i++) {
$sid=$row[$i][0];//correct
#print_r('gggd \n');
#print_r($sid);


 /*Select elimination or not */
$stmt_elimination = $dbh->prepare("SELECT elimination FROM Elimination where sid=:sid");
$stmt_elimination->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_elimination->execute())){
      throw new Exception('SQL for Cost query failed');
}else{
      $row_elimination = $stmt_elimination->fetchAll();
      $elimination=$row_elimination[0][0];
      #print $elimination;
}

/*Select Gid if Eliminate*/
$stmt_gameround = $dbh->prepare("SELECT gid FROM Elimination WHERE sid=:sid and elimination='True'");
$stmt_gameround ->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_gameround->execute())){
      throw new Exception('SQL for Cost query failed');
}else{
      $row_gameround = $stmt_gameround->fetchAll();
      $gameround=$row_gameround[0][0];
      #print $elimination;
}




if($elimination=='False' or $gameround>=$game){
$stmt_Cost = $dbh->prepare("SELECT cost FROM Cost where gid=:game and sid=:sid");
$stmt_Cost->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_Cost->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Cost->execute()))
  {
  throw new Exception('SQL for Cost query failed');
  }  
  
$stmt_Demand = $dbh->prepare("SELECT ndemand FROM Demand where gid=:game and sid=:sid");
$stmt_Demand->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_Demand->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Demand->execute()))
  {
  throw new Exception('SQL for Demand query failed');
  }
  
$stmt_tDemand = $dbh->prepare("SELECT tdemand FROM Demand where gid=:game and sid=:sid");
$stmt_tDemand->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_tDemand->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_tDemand->execute()))
  {
  throw new Exception('SQL for Demand query failed');
  }
  
$stmt_adDemand = $dbh->prepare("SELECT ademand FROM Demand where gid=:game and sid=:sid");
$stmt_adDemand->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_adDemand->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_adDemand->execute()))
  {
  throw new Exception('SQL for Demand query failed');
  }


$stmt_Price = $dbh->prepare("SELECT price FROM Price where gid=:game and sid=:sid");
$stmt_Price->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_Price->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Price->execute()))
  {
  throw new Exception('SQL for Price query failed');

  }

$stmt_adPrice = $dbh->prepare("SELECT adprice FROM Price where gid=:game and sid=:sid");
$stmt_adPrice->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_adPrice->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_adPrice->execute()))
  {
  throw new Exception('SQL for Price query failed');
  }
    
$stmt_Profit = $dbh->prepare("SELECT cprofit FROM Profit where gid=:game and sid=:sid");
$stmt_Profit->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_Profit->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Profit->execute()))
  {
  throw new Exception('SQL for Profit query failed');
  }

$stmt_Revenue = $dbh->prepare("SELECT trevenue FROM Revenue where gid=:game and sid=:sid");
$stmt_Revenue->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_Revenue->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Revenue->execute()))
  {
  throw new Exception('SQL for Revenue query failed');
  }

$stmt_Name = $dbh->prepare("SELECT fullname FROM Students where sid=:sid");
$stmt_Name->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Name->execute()))
  {
  throw new Exception('SQL for Name query failed');
  }
  
$row_Cost = $stmt_Cost->fetchAll();
#print_r($row_Cost);
$row_Demand = $stmt_Demand->fetchAll();
$row_adDemand = $stmt_adDemand->fetchAll();
$row_tDemand = $stmt_tDemand->fetchAll();
$row_Price = $stmt_Price->fetchAll();
$row_adPrice = $stmt_adPrice->fetchAll();
$row_Profit = $stmt_Profit->fetchAll();
$row_Revenue = $stmt_Revenue->fetchAll();
$row_Name = $stmt_Name->fetchAll();  
$p_demand=0.15*$row_Demand[0][0];

$p_demand=floor($p_demand);

if($game!=1){
$stmt_Pprofit = $dbh->prepare("SELECT tprofit FROM Profit where gid=:game and sid=:sid");
$pgame=$game-1;
$stmt_Pprofit->bindParam(':game',$pgame,PDO::PARAM_INT);
$stmt_Pprofit->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_Pprofit->execute()))
  {
  throw new Exception('SQL for Pprofit query failed');
  } 

$stmt_tprofit = $dbh->prepare("SELECT tprofit FROM Profit where gid=:game and sid=:sid");
$stmt_tprofit->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_tprofit->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_tprofit->execute()))
  {
  throw new Exception('SQL for Pprofit query failed');
  }

$stmt_cReserved = $dbh->prepare("SELECT reserved FROM Reserved where gid=:game and sid=:sid");
$stmt_cReserved ->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_cReserved ->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_cReserved->execute()))
  {
  throw new Exception('SQL for cReserved query failed');
  }
  
$stmt_aprofit = $dbh->prepare("SELECT adprofit FROM Profit where gid=:game and sid=:sid");
$stmt_aprofit ->bindParam(':game',$game,PDO::PARAM_INT);
$stmt_aprofit ->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_aprofit->execute()))
  {
  throw new Exception('SQL for aprofit query failed');
  }

$stmt_pReserved = $dbh->prepare("SELECT reserved FROM Reserved where gid=:game and sid=:sid");
$newgame=$game-1;
$stmt_pReserved ->bindParam(':game',$newgame,PDO::PARAM_INT);
$stmt_pReserved ->bindParam(':sid',$sid,PDO::PARAM_INT);
if (!($stmt_pReserved->execute()))
  {
  throw new Exception('SQL for cReserved query failed');
  }
  
  
$row_Pprofit=$stmt_Pprofit->fetchAll();
$row_tprofit=$stmt_tprofit->fetchAll();  
$row_cReserved=$stmt_cReserved->fetchAll();
$row_aprofit=$stmt_aprofit->fetchAll();
$row_pReserved=$stmt_pReserved->fetchAll();
}



if($sid!=1){ 
if ($game!=1){
$str .= '<tr><td>'.$row_Name[0][0].'</td><td>'.$row_Price[0][0].'</td><td>'.round($row_adPrice[0][0]).'</td><td>'.round($row_Demand[0][0]).
        '</td><td>'.round($row_adDemand[0][0]).'</td><td>'.round($row_pReserved[0][0]).'</td><td>'.round($row_tDemand[0][0]).'</td><td>'.round($row_Revenue[0][0]).
        '</td><td>'.round($row_Cost[0][0]).'</td><td>'.round($row_Profit[0][0]).'</td><td>'.round($row_Pprofit[0][0]).'</td><td>'.round($row_tprofit[0][0]).'</td><td>'
        .round($row_cReserved[0][0]).'</td><td>'.round($row_aprofit[0][0]).'</td></tr>';
}else{
$str .= '<tr><td>'.$row_Name[0][0].'</td><td>'.$row_Price[0][0].'</td><td>'.round($row_adPrice[0][0]).'</td><td>'.round($row_Demand[0][0]).
        '</td><td>'.round($row_Revenue[0][0]).'</td><td>'.round($row_Cost[0][0]).'</td><td>'.round($row_Profit[0][0]).'</td><td>'.round($p_demand).'</td></tr>';
}
}
}
}
echo $str;
#echo $row_tDemand[0][0];
}
catch(Exception $e){
	echo $e->getMessage();
}
}


?>
