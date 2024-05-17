<?

include_once 'libs/includes/Session.class.php';
include_once 'libs/includes/Database.class.php';
include_once "libs/includes/User.class.php";
include_once 'libs/includes/Mic.class.php';
include_once '/home/rizwankendo/htdocs/app/libs/includes/UserSession.class.php';

global $__site_config;
//$__site_config_path = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']).'/photogramconfig.json';
if(is_link($_SERVER['DOCUMENT_ROOT'])){//is_link checks if the given directory is a symbolic link 
    $__site_config_path=dirname(readlink($_SERVER['DOCUMENT_ROOT'])).'/photogramconfig.json';//readlink returns the target of the link.dirname() removes the last content in a directory path.(exa: dirname(var/www/html) gives var/www as output)
}
else{
    $__site_config_path=dirname($_SERVER['DOCUMENT_ROOT']).'/photogramconfig.json';
}
$__site_config = file_get_contents($__site_config_path);


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


