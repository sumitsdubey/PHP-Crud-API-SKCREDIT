<?php

//Users: GET Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';


$query = new Query();
$result = $query->select('*')->table('users')->allRecords();
header("Content-Type:application/json");
echo json_encode($result,JSON_PRETTY_PRINT);
exit;









?>