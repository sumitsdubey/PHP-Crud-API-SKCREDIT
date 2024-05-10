<?php

require_once __DIR__.'/class/init.php';
#echo BASE_URL;
function url($url=''){
 if($url=='')
 {
     return BASE_URL;
 }

    return BASE_URL.$url;

}
#post function
function post($key='')
{
    if($key=='')
    {
        return $_POST;
    }
    return $_POST[$key];
}

#request function
function request($key='')
{
    if($key=='')
    {
        return $_REQUEST;
    }
    return $_REQUEST[$key];
}

# get function
function get($key='')
{
    if($key=='')
    {
        return $_GET;
    }
    return $_GET[$key];
}

function handle_request(){


    if(@$_SERVER['HTTP_CONTENT_TYPE']=='text/plain'){
        //echo 'data sent again raw data <br/->';
    }else{
        //echo 'data sent from form data <br/>';
        if($_SERVER['REQUEST_METHOD']=='POST' and array_key_exists('_method',$_POST)){
                $_SERVER['REQUEST_METHOD'] = $_POST['_method'];
                unset($_POST['_method']);
                unset($_REQUEST['_method']);
                unset($_GET['_method']);
                return $_SERVER['REQUEST_METHOD'];
        }else if($_SERVER['REQUEST_METHOD']=='GET'){
            return $_SERVER['REQUEST_METHOD'];
        }else{
            exit('Invalid Request Type Add _method to Allow Request');
        }
    }

}    
function http_raw(){
    $data=json_decode(file_get_contents("php://input"),true);
    return $data;

}

function display_filesize($filesize){
   
    if(is_numeric($filesize)){
    $decr = 1024; 
	$step = 0;
    $prefix = array('Byte','KB','MB','GB','TB','PB');
       
    while(($filesize / $decr) > 0.9){
        $filesize = $filesize / $decr;
        $step++;
    }
    return round($filesize,2).' '.$prefix[$step];
    } else {

    return 'NaN';
    }
   
}
?>