<?php

require_once __DIR__.'/Db.php';

//This is Query Connection File
class Query extends DB{
	
	public $sql;
	private $rs;
	private $lastpk_id = 0;
	private $data;

	public function insert($tablename,$formdata=[]){
	$columns = implode(",",array_keys($formdata));
	$values = implode("','",array_values($formdata));
	$SQL = "INSERT INTO {$tablename}($columns) values('$values');";
	$this->sql = $SQL;
	if($this->runQuery()){
		$this->lastpk_id = mysqli_insert_id($this->getConnection());
		return true;
	}else{
		return false;
	}
	
	}

	public function getId(){
		return $this->lastpk_id;
	}

	public function getQuery(){
		return $this->sql;
	}	
	
	
public function select($columns='*'){
	$sql = "SELECT $columns FROM ";
	$this->sql = $sql;
	return $this;
}

public function table($tablename){

$this->sql = $this->sql."$tablename";
return $this;

}

public function where($column='',$operator='=',$value=''){
	
	$count = func_num_args();
	if($count == 2){
		$value = $operator;
		$column = $column;
		$this->sql = $this->sql. " WHERE $column = '$value'";
	}
	
	if($count == 3){
		
		$operator = $operator;
		$value = $value;
		$column = $column;
		
		$this->sql = $this->sql. " WHERE $column $operator '$value'";
	}
	if($count==1 and is_array($column)){
		$condition_arr = $column;
		
		$str = '';
		foreach($condition_arr as $key => $value){
			$str = $str . " {$key} = '{$value}' AND"; 
		}
		$str = substr($str,0,-4);
		$this->sql = $this->sql. " WHERE ".$str ;
	}
	
	return $this;
	
}

public function update($tablename,$formdata=[]){
	
	$sql = "UPDATE {$tablename} SET";
	$str = '';
	foreach($formdata as $column => $value){
		$str = $str.$column = $value;
	}
	$str = substr($str,0,-1);
	$this->sql = "".$sql." ".$str;
	return $this;
}



public function delete($tablename){
	
	$this->sql = "DELETE FROM {$tablename} ";
	return $this;
}

public function TRUNCATE($tablename){
	
	$this->sql = "TRUNCATE TABLE {$tablename} ";
	return $this;
}

public function concate($query=''){
	
	$this->sql = $this->sql." $query ";
	return $this;
	
}

public function toArray(){
	return  json_decode(json_encode($this->data),true);
}

public function allRecords(){
	if($this->runQuery()){
		$data = array();
		while($row = mysqli_fetch_object($this->rs)){
			$data[] = $row;
	   }
	   $this->data = $data;
	   return $data;
	}
	return false;
	
}

public function commit(){
	if($this->runQuery()){
		return true;
	}else{
		return false;
	}
}

public function first(){
	if($this->runQuery()){
		$data = array();
		while($row = mysqli_fetch_object($this->rs)){
			$data[] = $row;
	   }
	   $this->data = $data[0];
	   return $data[0];
	}
	return false;
	
}

public function next(){
	if($this->runQuery()){
		$data = array();
		while($row = mysqli_fetch_object($this->rs)){
			$data[] = $row;
	   }
	   $this->data = $data[1];
	   return $data[1];
	}
	return false;
	
}

public function orderBy($key='id',$order='asc'){
	$this->sql = $this->sql." ORDER BY $key $order";
	$this->sql = $this->sql;
	return $this;
}
public function limit($limit,$offset='0'){
	$this->sql = $this->sql." LIMIT $offset,$limit";
	$this->sql = $this->sql;
	return $this;
}

public function last(){
	if($this->runQuery()){
		$data = array();
		while($row = mysqli_fetch_object($this->rs)){
			$data[] = $row;
	   }
	   $this->data = $data[count($data)-1];
	   return $data[count($data)-1];
	}
	return false;
	
}
public function row($i){
	if($this->runQuery()){
		$data = array();
		while($row = mysqli_fetch_object($this->rs)){
			$data[] = $row;
	   }
	   $this->data = $data[$i];
	   return $data[$i];
	}
	return false;
	
}
private function runQuery(){

$result_set = mysqli_query($this->getConnection(),$this->sql) or die(mysqli_error($this->getConnection()));

if(is_object($result_set)){
	if(mysqli_num_rows($result_set)>0){
		$this->rs = $result_set;
		return true;
	}else{
		return false;
	}
}else{
	$count = mysqli_affected_rows($this->getConnection());
	if($count>0){
		return true;
	}else{
		return false;
	}
}

}


}





