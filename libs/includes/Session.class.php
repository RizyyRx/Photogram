<?
class Session{
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

}
?>