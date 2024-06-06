<?
//TODO: Implement autoload of class files
include_once 'libs/includes/Session.class.php';
include_once 'libs/includes/Database.class.php';
include_once "libs/includes/User.class.php";
include_once 'libs/includes/Mic.class.php';
include_once '/home/rizwankendo/htdocs/app/libs/includes/UserSession.class.php';
include_once 'libs/includes/WebAPI.class.php';
include_once 'libs/app/Post.class.php';


$wapi=new WebAPI();
$wapi->initiateSession();

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
    include $_SERVER['DOCUMENT_ROOT'] . get_config('base_path')."_templates/$name.php";
}

function credential_validation($username, $password)
{
    if ($username == "rizwan@gmail.com" and $password == "password") {
        return true;
    } else {return false;
    }
}


