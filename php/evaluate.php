<?php
session_start();
if(!isset($_SESSION['username'])){
header("loation:login.php");
}else{
$gid=$_GET['game'];
#$gid=2;
try{
$dbh = new PDO("sqlite:test3.db");
        $stmt_lop = $dbh->prepare("SELECT sid FROM Students");
        if($gid==1){
                $stmt_lop->execute();
                $row = $stmt_lop->fetchAll();
                $c = count($row);
                $stmt_Average=$dbh->prepare("SELECT AVG(price) FROM Price where gid=:gid");
                $stmt_Average->bindParam(':gid',$gid,PDO::PARAM_INT);
                if (!($stmt_Average->execute())){
                        throw new Exception('SQL for Average Price query failed');
                }else{
                $row_Average = $stmt_Average->fetchAll();

                $average_price=$row_Average[0][0];

                $average_price=round($average_price,0); 
                }
                for ($i=1; $i<$c; $i++) {
                $sid=$row[$i][0];//correct
                $stmt_Price = $dbh->prepare("SELECT price FROM Price where gid=:gid and sid=:sid");
                $stmt_Price->bindParam(':gid',$gid,PDO::PARAM_INT);
                $stmt_Price->bindParam(':sid',$sid,PDO::PARAM_INT);
                if (!($stmt_Price->execute())){
                        throw new Exception('SQL for Cost query failed');
                }else{
                $row_Price = $stmt_Price->fetchAll();
                $Price=$row_Price[0][0];
                }
                /* Ndemand*/
                $Ndemand=400-4*$Price+2*$average_price;
                $Ndemand=floor($Ndemand);
                
                /*Revenue*/
                $Revenue=$Price*$Ndemand;
                $Revenue=round($Revenue,0);


                /*Cost*/
                $Cost=$Ndemand*60+5000;
                $Cost=round($Cost,0);
                
                /*Total Profit*/
                $Tprofit=$Revenue-$Cost;
                $Tprofit=round($Tprofit,0);
                
                /*Reserved Demand*/               
                $cffdemand=0.15*$Ndemand;                
                $cffdemand=floor($cffdemand);
                
                /*Insert INTO Demand*/
                $insert = $dbh->prepare("INSERT INTO Demand VALUES(?,?,?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Demand failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Ndemand,$Ndemand,0));
                if(!$insert){
                        throw new Exception('SQL INSERT Demand failed2\n');
                }
                /*Insert Into Revenue*/
                $insert = $dbh->prepare("INSERT INTO Revenue VALUES(?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Revenue failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Revenue));
                if(!$insert){
                        throw new Exception('SQL INSERT Revenue query failed2');
                }
                /*Insert into Cost*/
                $insert = $dbh->prepare("INSERT INTO Cost VALUES(?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Cost failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Cost));
                if(!$insert){
                        throw new Exception('SQL INSERT Cost query failed2');
                }
                
                /*Insert into Profit*/
                $insert = $dbh->prepare("INSERT INTO Profit VALUES(?,?,?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Profit failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Tprofit,0,$Tprofit));
                if(!$insert){
                        throw new Exception('SQL INSERT Profit query failed2');
                }
                /*Insert into Reserved*/
                $insert = $dbh->prepare("INSERT INTO Reserved VALUES(?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Profit failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$cffdemand));
                if(!$insert){
                        throw new Exception('SQL INSERT Profit query failed2');
                }
        }
                /*Total Advertising*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(adprice) FROM Price where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Advertising query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_adprice=$row_Sum[0][0];
                }
        
                /*Total New Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(ndemand) FROM Demand where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total New Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_ndemand=$row_Sum[0][0];
                }
                
                /*Total Total Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(tdemand) FROM Demand where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_tdemand=$row_Sum[0][0];
                }
                
                /*Total Adv Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(ademand) FROM Demand where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Adv Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_ademand=$row_Sum[0][0];
                }
                
                /*Total Current Round Reserved Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(reserved) FROM Reserved where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Current Round Reserved Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_rdemand=$row_Sum[0][0];
                }
                
                /*prevouse round reserved Demand
                $stmt_Sum=$dbh->prepare("SELECT SUM(reserved) FROM Reserved where gid=:game");
                $newgid=$gid-1;
                $stmt_Sum->bindParam(':game',$newgid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for total previouse reserved Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_prdemand=$row_Sum[0][0];
                }*/
                
                /*Total Revenue*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(trevenue) FROM Revenue where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Revenue query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Revenue=$row_Sum[0][0];
                }
                
                /*Sum Cost*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(cost) FROM Cost where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Sum Cost query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Cost=$row_Sum[0][0];
                }
                
                /*Sum Current Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(cprofit) FROM Profit where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Current Profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Cprofit=$row_Sum[0][0];
                }
                
                /*Sum Previous Profit
                $stmt_Sum=$dbh->prepare("SELECT SUM(tprofit) FROM Profit where gid=:game");
                $newgid=$gid-1;
                $stmt_Sum->bindParam(':game',$newgid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Previous Profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Pprofit=$row_Sum[0][0];
                }*/
                
                /*Sum Total Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(tprofit) FROM Profit where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Tprofit=$row_Sum[0][0];
                }
                
                /*Sum Total Adv_Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(adprofit) FROM Profit where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Average Adv_profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Aprofit=$row_Sum[0][0];
                }
                
                /*Insert these Into Average Table*/
                $insert = $dbh->prepare("INSERT INTO Avtotal VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Avtotal failed1\n');
                               
                }
                $insert->execute(array($gid,round($average_price,0),round($Sum_adprice,0),round($Sum_ndemand,0),round($Sum_ademand,0),0,round($Sum_tdemand,0),round($Sum_Revenue,0),round($Sum_Cost,0),0,round($Sum_Cprofit,0),round($Sum_Tprofit,0),round($Sum_rdemand,0),round($Sum_Aprofit,0)));
                if(!$insert){
                        throw new Exception('SQL INSERT Demand failed2\n');
                } 
                
                /*Automatic increment one game*/
                $insert = $dbh->prepare("INSERT INTO Gameround VALUES(?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Gameround failed1\n');
                               
                }
                $insert->execute(array(NULL));
                if(!$insert){
                        throw new Exception('SQL INSERT Gameround failed2\n');
                }   
                
                header('location:admin.php'); 
        }
        else{
                $stmt_lop->execute();
                $row = $stmt_lop->fetchAll();
                $c = count($row);
                /*Select the average Price*/
                $stmt_Average=$dbh->prepare("SELECT AVG(price) FROM Price where gid=:gid");
                $stmt_Average->bindParam(':gid',$gid,PDO::PARAM_INT);
                if (!($stmt_Average->execute())){
                        throw new Exception('SQL for Average Price query failed');
                }else{
                $row_Average = $stmt_Average->fetchAll();

                $average_price=$row_Average[0][0];

                $average_price=round($average_price,0); 
                }
                
                                
                /*Select the Total Advertisment Price*/
                $stmt_Sumad=$dbh->prepare("SELECT SUM(adprice) FROM Price where gid=:gid");
                $stmt_Sumad->bindParam(':gid',$gid,PDO::PARAM_INT);
                if (!($stmt_Sumad->execute())){
                        throw new Exception('SQL for Average Price query failed');
                }else{
                $row_Sumad = $stmt_Sumad->fetchAll();

                $sum_adprice=$row_Sumad[0][0];
                  $sum_adprice=round($sum_adprice,0); 
                }
                
                /*How many student inside , $c controles this*/
                for ($i=1; $i<$c; $i++) {
                $sid=$row[$i][0];//correct
                
                
                
                
                /*Select elimination or not */
                $stmt_elimination = $dbh->prepare("SELECT elimination FROM Elimination where sid=:sid");
                $stmt_elimination->bindParam(':sid',$sid,PDO::PARAM_INT);
                if (!($stmt_elimination->execute())){
                        throw new Exception('SQL for Cost query failed');
                }else{
                $row_elimination = $stmt_elimination->fetchAll();
                $elimination=$row_elimination[0][0];
                }
                
                if($elimination=='False'){
                /*Select the meal price from the table*/
                $stmt_Price = $dbh->prepare("SELECT price FROM Price where gid=:gid and sid=:sid");
                $stmt_Price->bindParam(':gid',$gid,PDO::PARAM_INT);
                $stmt_Price->bindParam(':sid',$sid,PDO::PARAM_INT);
                if (!($stmt_Price->execute())){
                        throw new Exception('SQL for Cost query failed');
                }else{
                $row_Price = $stmt_Price->fetchAll();
                $Price=$row_Price[0][0];
                $Price=round($Price,0);
                }
                
                /*Select the advertisment price from the table*/
                $stmt_adprice = $dbh->prepare("SELECT adprice FROM Price where gid=:gid and sid=:sid");
                $stmt_adprice->bindParam(':gid',$gid,PDO::PARAM_INT);
                $stmt_adprice->bindParam(':sid',$sid,PDO::PARAM_INT);
                if (!($stmt_adprice->execute())){
                        throw new Exception('SQL for Cost query failed');
                }else{
                $row_adprice = $stmt_adprice->fetchAll();
                $adprice=$row_adprice[0][0];
                $adprice=round($adprice,0);
                }
                
                /*Select the Reserved Demand from the table*/
                $stmt_reserved = $dbh->prepare("SELECT reserved FROM Reserved where gid=:gid and sid=:sid");
                $newgid=$gid-1;
                $stmt_reserved->bindParam(':gid',$newgid,PDO::PARAM_INT);
                $stmt_reserved->bindParam(':sid',$sid,PDO::PARAM_INT);
                if (!($stmt_reserved->execute())){
                        throw new Exception('SQL for Cost query failed');
                }else{
                $row_reserved = $stmt_reserved->fetchAll();
                $reserved=$row_reserved[0][0];
                $reserved=floor($reserved);
                }
                
                /*Select the prevouse round total Profit*/
                $stmt_tprofit = $dbh->prepare("SELECT tprofit FROM Profit where gid=:gid and sid=:sid");
                $newgid=$gid-1;
                $stmt_tprofit->bindParam(':gid',$newgid,PDO::PARAM_INT);
                $stmt_tprofit->bindParam(':sid',$sid,PDO::PARAM_INT);
                if (!($stmt_tprofit->execute())){
                        throw new Exception('SQL for Cost query failed');
                }else{
                $row_tprofit = $stmt_tprofit->fetchAll();
                $tprofit=$row_tprofit[0][0];
                $tprofit=round($tprofit,0);
                }
                
                /*Get the new Demand*/
                $Ndemand=400-4*$Price+2*$average_price;
                $Ndemand=floor($Ndemand);
                if($Ndemand<=0){
                $Ndemand=0;
                }

                /*Get the Adv Demand*/
                $Advdemand=($adprice/$sum_adprice)*400;
                $Advdemand=floor($Advdemand);
                
                /*Get the total Demand*/
                $Tdemand=$reserved+$Advdemand+$Ndemand;
                $Tdemand=floor($Tdemand);
                
                /*Revenue*/
                $Revenue=$Price*$Tdemand;
                $Revenue=round($Revenue,0);

                
                /*Cost*/ 
                $Cost=$Tdemand*60+5000+$adprice;
                $Cost=round($Cost,0);
                
                /*Current Profit*/
                $Cprofit=$Revenue-$Cost;
                $Cprofit=round($Cprofit,0);
                
                /*Advertisment Profit*/
                $Aprofit=$Advdemand*($Price-60)-$adprice;
                $Aprofit=round($Aprofit,0);
                
                /*Total Profit*/
                $Tprofit=$Cprofit+$tprofit;
                $Tprofit=round($Tprofit,0);
                /*if($Tprofit<0){
                        $insert = $dbh->prepare("UPDATE Elimination SET elimination=? WHERR sid=?");
                        if (!$insert){
                                throw new Exception('SQL INSERT Demand failed1\n');
                               
                        }
                        $insert->execute(array('True',$sid));
                        if(!$insert){
                               throw new Exception('SQL INSERT Demand failed2\n');
                        }
                        
                }*/
                        
                $cffdemand=0.15*$Ndemand;                
                $cffdemand=floor($cffdemand);

                /*Insert INTO Demand*/
                $insert = $dbh->prepare("INSERT INTO Demand VALUES(?,?,?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Demand failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Ndemand,$Tdemand,$Advdemand));
                if(!$insert){
                        throw new Exception('SQL INSERT Demand failed2\n');
                }
                
                /*Insert Into Revenue*/
                $insert = $dbh->prepare("INSERT INTO Revenue VALUES(?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Revenue failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Revenue));
                if(!$insert){
                        throw new Exception('SQL INSERT Revenue query failed2');
                }
                
                /*Insert into Cost*/
                $insert = $dbh->prepare("INSERT INTO Cost VALUES(?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Cost failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Cost));
                if(!$insert){
                        throw new Exception('SQL INSERT Cost query failed2');
                }
                
                /*Insert into Profit*/
                $insert = $dbh->prepare("INSERT INTO Profit VALUES(?,?,?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Profit failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$Tprofit,$Aprofit,$Cprofit));
                if(!$insert){
                        throw new Exception('SQL INSERT Profit query failed2');
                }
                
                /*Insert into Reserved*/
                $insert = $dbh->prepare("INSERT INTO Reserved VALUES(?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Profit failed1\n');
                               
                }
                $insert->execute(array($sid,$gid,$cffdemand));
                if(!$insert){
                        throw new Exception('SQL INSERT Profit query failed2');
                }
                }
        }
                /*Total Advertising*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(adprice) FROM Price where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Advertising query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_adprice=$row_Sum[0][0];
                }
        
                /*Total New Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(ndemand) FROM Demand where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total New Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_ndemand=$row_Sum[0][0];
                }
                
                /*Total Total Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(tdemand) FROM Demand where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_tdemand=$row_Sum[0][0];
                }
                
                /*Total Adv Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(ademand) FROM Demand where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Adv Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_ademand=$row_Sum[0][0];
                }
                
                /*Total Current Round Reserved Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(reserved) FROM Reserved where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Current Round Reserved Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_rdemand=$row_Sum[0][0];
                }
                
                /*prevouse round reserved Demand*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(reserved) FROM Reserved where gid=:game");
                $newgid=$gid-1;
                $stmt_Sum->bindParam(':game',$newgid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for total previouse reserved Demand query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_prdemand=$row_Sum[0][0];
                }
                /*Total Revenue*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(trevenue) FROM Revenue where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Revenue query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Revenue=$row_Sum[0][0];
                }
                
                /*Sum Cost*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(cost) FROM Cost where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Sum Cost query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Cost=$row_Sum[0][0];
                }
                
                /*Sum Current Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(cprofit) FROM Profit where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Current Profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Cprofit=$row_Sum[0][0];
                }
                
                /*Sum Previous Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(tprofit) FROM Profit where gid=:game");
                $newgid=$gid-1;
                $stmt_Sum->bindParam(':game',$newgid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Previous Profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Pprofit=$row_Sum[0][0];
                }
                
                /*Sum Total Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(tprofit) FROM Profit where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Total Profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Tprofit=$row_Sum[0][0];
                }
                
                /*Sum Total Adv_Profit*/
                $stmt_Sum=$dbh->prepare("SELECT SUM(adprofit) FROM Profit where gid=:game");
                $stmt_Sum->bindParam(':game',$gid,PDO::PARAM_INT);
                if (!($stmt_Sum->execute())){
                        throw new Exception('SQL for Average Adv_profit query failed');
                }else{
                $row_Sum = $stmt_Sum->fetchAll();
                $Sum_Aprofit=$row_Sum[0][0];
                }
                
                /*Insert these Into Average Table*/
                $insert = $dbh->prepare("INSERT INTO Avtotal VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Avtotal failed1\n');
                               
                }
                $insert->execute(array($gid,round($average_price,0),round($Sum_adprice,0),floor($Sum_ndemand),floor($Sum_ademand),floor($Sum_prdemand),floor($Sum_tdemand),round($Sum_Revenue),round($Sum_Cost),round($Sum_Pprofit),round($Sum_Cprofit),round($Sum_Tprofit),round($Sum_rdemand),round($Sum_Aprofit)));
                if(!$insert){
                        throw new Exception('SQL INSERT Demand failed2\n');
                }   
                
                /*Automatic increment one game*/
                $insert = $dbh->prepare("INSERT INTO Gameround VALUES(?)");
                if (!$insert){
                        throw new Exception('SQL INSERT Gameround failed1\n');
                               
                }
                $insert->execute(array(NULL));
                if(!$insert){
                        throw new Exception('SQL INSERT Gameround failed2\n');
                }
                
                /*Eliminate the students with the lowest profit*/
                if($gid>=4){
                        $stmt_minimum=$dbh->prepare("SELECT MIN(tprofit) FROM Profit where gid=:game");
                        $stmt_minimum->bindParam(':game',$gid,PDO::PARAM_INT);
                        if (!($stmt_minimum->execute())){
                                throw new Exception('SQL for selecting the minimum tprofit query failed');
                        }else{
                                $row_minimum = $stmt_minimum->fetchAll();
                                $minimum_tprofit=$row_minimum[0][0];
                        }
                        
                        $stmt_sid=$dbh->prepare("SELECT sid FROM Profit where tprofit=:minimum");
                        $stmt_sid->bindParam(':minimum',$minimum_tprofit,PDO::PARAM_INT);
                        if (!($stmt_sid->execute())){
                                throw new Exception('SQL for slecting eliminated sid query failed');
                        }
                        else{                        
                                $row_sid = $stmt_sid->fetchAll();
                                #print $row_sid;
                                $eliminate_sid=$row_sid[0][0];
                        }                       
                        $update_elimination = $dbh->prepare("UPDATE Elimination SET elimination='True',gid=? WHERE sid=?");
                        if(!($update_elimination->execute(array($gid,$eliminate_sid)))){
                                throw new Exception('Elimination Fails');
                        }
                }   
                
                header('location:admin.php'); 
              
              #echo("SQL error. Please remove the SngletonLock[5478xiwejsdfjewjjraeifjsdfas;fjsd;l]: ERROR_CODE 2342");                
        }
        }
catch(Exception $e){
echo $e;
}
}
?>
