<?

include_once 'libs/includes/Session.class.php';
include_once 'libs/includes/Database.class.php';
include_once "libs/includes/User.class.php";
include_once 'libs/includes/Mic.class.php';

global $__site_config;
$__site_config= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../photogram_config.json');//file_get_contents() is the preferred way to read the contents of a file into a string


Session::start();

/**
 * used to read a config file and get the contents by providing a key
 */
function get_config($key,$default=null){
    global $__site_config;
    $array=json_decode($__site_config,true);//json_decode decodes the json format into php value and saves it in $array string
    //2nd arg in json_decode when set true, it returns the decoded json as associative array
    if(isset($array[$key])){
        return $array[$key];
    } 
    else{
        return $default;
    }
}

/*loads a template file if called.....
file name should be given as a parameter*/
function load_template($name)
{
    //print("including ".$_SERVER['DOCUMENT_ROOT']." $name.php");
    include $_SERVER['DOCUMENT_ROOT'] . "/app/_templates/$name.php";
}

function credential_validation($username, $password)
{
    if ($username == "rizwan@gmail.com" and $password == "password") {
        return true;
    } else {return false;
    }
}


