<?php
$sql="SELECT * FROM test";
echo "linked here";

try{
$dbh = new PDO("sqlite:test3.db");
$stmt = $dbh->query($sql);
if (!$stmt)
  {
  throw new Exception('SQL query failed');
  }

$row = $stmt->fetchAll();
print_r($row);
  
}
catch(Exception $e){
	echo $e->getMessage();
}

echo "shit code";
?>
