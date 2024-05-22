<?
use MongoDB\Driver\Session as DriverSession;


class Session{
    public static $isError = false;
    public static $user = null;
    public static $usersession = null;

    public static function start(){
        session_start();
    }
    public static function set($key,$value){ //sets a 'key=value' to the $_SESSION array 
        $_SESSION[$key]=$value;
    }
    public static function unset(){
        session_unset();
    }
    public static function destroy(){
        session_destroy();
    }
    public static function delete_session($key){  //deletes key by refering to the $_SESSION array
        unset($_SESSION[$key]);
    }
    public static function isset_get($key){ //checks if key is set on $_GET array
        return isset($_GET[$key]);
    }
    public static function isset_session($key){ //checks if key is set on $_SESSION array
        return isset($_SESSION[$key]);
    }
    public static function get($key,$default=false){
        if(Session::isset_session($key)){
            return($_SESSION[$key]); //returns the key
        }
        else{
            return $default; //returns false if no such key exists
        }
    }

    public static function loadTemplate($name)
    {
        $script = $_SERVER['DOCUMENT_ROOT'] . get_config('base_path'). "_templates/$name.php";
        if (is_file($script)) {
            include $script;
        } else {
            Session::loadTemplate('_error');
        }
    }

    public static function renderPage()
    {
        Session::loadTemplate('_master');
    }

    public static function currentScript()
    {
        return basename($_SERVER['SCRIPT_NAME'], '.php');
    }

    public static function getUser()
    {
        return Session::$user;
    }

    public static function getUserSession(){
        return Session::$usersession;
    }

    public static function isAuthenticated()
    {
        /**
         * If authorize() is executed correctly, the initiateSession() in WebAPI.class will assign an UserSession class object to Session::$usersession
         * is_object checks if Session::$usersession contains an object or not
         * If true, it gives the UserSession object to isValid() to check if 1hr has passed since creation on that object
         * Then the Boolean val of isValid() is returned
         * else false is returned 
         */
        if(is_object(Session::getUserSession())){
            return Session::getUserSession()->isValid();
        } 
        return false;
    }

    public static function ensureLogin(){
        if(!Session::isAuthenticated()){
            header("Location: /login.php");
            die();
        }
    }


}
?>