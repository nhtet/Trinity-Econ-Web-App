<?php

try{
$dbh = new PDO("sqlite:test3.db");  
$insert=$dbh->prepare("INSERT INTO test (sid) VALUES(?)");
if (!$insert){
throw new Exception('SQL query failed1\n');
}
$insert->execute(array(100000));
if(!$insert){
throw new Exception('SQL query failed2');
}



}
catch(Exception $e){
	echo $e->getMessage();
}


?>
