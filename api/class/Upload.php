<?php
// Upload Class File

define('FILE_UPLOAD_PATH',__DIR__.'/../upload/');
define('FILE_MAX_SIZE',__DIR__.'2'); //MB

Class Upload{
	//Upload Manager

private $file = [];
private $name;
private $directory = FILE_UPLOAD_PATH; //default upload Folder
Private $max_size = FILE_MAX_SIZE;
private $error;
private $file_info = [];

	//Intialise the Setting
public function set($f){
		if(is_array($f)){
			$this->file = $f;
		}else{
			$this->error = " Invalid Upload File Format";
		}
		return $this;
	}

public function name($n){
		$this->name = $n;
		return $this; 
	}

public function max_size($s){
	if(is_int($s) and $s>0){
		$this->max_size = ($s*1024*1024);
		return $this;
	}else{
			$this->error = " Maximum Uploaded Size Must Integer and must be greater than zero";
	}
	return $this;
}


public function directory($d){
	$this->directory = $d;
	return $this;
}

//Get Extension
public function get_extension(){
	$this->fn = explode(".",$this->file['name']);
	$this->ext = end($this->fn);
	return $this->ext;
}

public function allow_extension($e){

	$this->extension=explode("|",$e);

	if(!in_array($this->get_extension(),$this->extension)){

		$this->error = $this->get_extension();
		$this->error.= " Extension Not Allowed"; 

	}
	return $this;
}
	
public function get_size(){
	return $this->file['size'];
}

public function get_dir(){
	
	if(!is_dir($this->directory)){
		mkdir($this->directory);
	}
	return $this->directory;

}	

public function get_name(){
	if(empty($this->name)){
		$this->name = date("YmdHis");
	}

	$this->fc = $this->get_dir()
		.DIRECTORY_SEPARATOR.$this->name.".".$this->get_extension();

	if(file_exists($this->fc)){
		//Generate the new name
		$this->i = 0;
		do{
			$this->name = $this->name.$this->i;
			$this->fc= $this->get_dir()
				.DIRECTORY_SEPARATOR.$this->name.".".$this->get_extension();

			$this->i++;
		
		}while (file_exists($this->fc));
	}

	$this->name = $this->name;
	return $this->name;
}

public function destination(){

	$this->d = "";
	$this->d .= $this->get_dir().DIRECTORY_SEPARATOR;
	$this->d .= $this->get_name();
	$this->d .= ".".$this->get_extension(); // Here is the Error
	
	return $this->d;
}

public function do_upload(){

	//check for size
	if($this->get_size()>$this->max_size){

		$this->error=" File size is ".round($this->get_size()/(1024*1024),2)."MB, maximum to Upload is ".round($this->max_size/(1024*1024),2)." MB";

	}

	if(empty($this->error)){

		$name = $this->get_name();
		if(move_uploaded_file($this->file['tmp_name'], $this->destination())){
			
			$this->info=[
				
				'file_name' =>$name,
				'status' => 'uploaded',
				'uploaded_date' =>date('Y-m-d'),
				'uploaded_time' => date('H:i:s'),
				'type' => $this->get_extension(),
				// 'size' => round($this->get_size()/(1024*1024),2)."MBs",
				'size'=>display_filesize($this->get_size()),
				'error' => $this->error,
			];

			$this->file_info = $this->info;
			return true;
		}
	}else{
		return false;
	}
}

public function report(){
	return $this->error;
}

public function file_info(){
	return $this->file_info;
}

	//To get the definition
public static function getProperties(){

		return [

			'file'=>(new Upload)->file,
			'name'=>(new Upload)->name,
			'directory'=>(new Upload)->directory,
			'max_size'=>(new Upload)->max_size,
			'error'=>(new Upload)->error,
		];
	}

}










