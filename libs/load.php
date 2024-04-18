<?

include_once 'libs/includes/Session.class.php';
include_once 'libs/includes/Database.class.php';
include_once "libs/includes/User.class.php";
Session::start();
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


