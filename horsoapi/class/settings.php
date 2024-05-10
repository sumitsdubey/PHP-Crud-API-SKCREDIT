<?php

//This is Setting file

################ All Constants ##########################
define('HOST','localhost:3306');
define('USER','root');
define('PASSWORD','');
define('DBNAME','tanu12');
define('BASE_URL','http://localhost/api/');

################ All Constants ##########################

return [
	
	'db:config'=>[
		
		'host'=>'localhost:3306', //localhost 3306 : sql port
		'user'=>'root', //username: root
		'password'=>'', // Blank
		'dbname'=>'horsodata', 
	],
	'connection:debug'=>false,

];
