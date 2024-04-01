<?
/*loads a template file if called.....
file name should be given as a parameter*/
function load_template($name){
    //print("including ".$_SERVER['DOCUMENT_ROOT']." $name.php");
    include $_SERVER['DOCUMENT_ROOT']."/app/_templates/$name.php";
}

function credential_validation($username,$password){
    if($username=="rizwan@gmail.com" and $password=="password"){
        return true;
    }
    else{
        return false;
    }
}
?>