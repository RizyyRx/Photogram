<?php
global $__site_config;

class WebAPI
{

    public function __construct()
    {
        if (php_sapi_name() == "cli") {
            global $__site_config;
            $__site_config_path="/home/rizwankendo/photogram_config.json";
            $__site_config = file_get_contents($__site_config_path);
        } 
        else if (php_sapi_name() == "apache2handler") {
            global $__site_config;
            //$__site_config_path = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']).'/photogramconfig.json';
            if (is_link($_SERVER['DOCUMENT_ROOT'])) { //is_link checks if the given directory is a symbolic link 
                $__site_config_path = dirname(readlink($_SERVER['DOCUMENT_ROOT'])) . '/photogram_config.json'; //readlink returns the target of the link.dirname() removes the last content in a directory path.(exa: dirname(var/www/html) gives var/www as output)
            } else {
                $__site_config_path = dirname($_SERVER['DOCUMENT_ROOT']) . '/photogram_config.json';
            }
            $__site_config = file_get_contents($__site_config_path);
        }
        Database::getConnection();
    }

    public function initiateSession()
    {
        Session::start();
        if (Session::isset_session("session_token")) {
            try {
                /**
                 * The authorize() in UserSession::authorize(Session::get('session_token'))  sets Session::$user = $session->getUser() if all conditions on authorize() satisfies.
                 * The getUser() creates new User class object. So an User class object is assigned to  Session::$user.
                 * And the authorize() also returns $session which is an UserSession class object. 
                 * So finally, now a UserSession class object is assigned to Session::$usersession and an User object is assigned to Session::$user
                 */
                Session::$usersession = UserSession::authorize(Session::get('session_token')); 
            } 
            catch (Exception $e){
                //TODO: Handle error
            }
        }

    }
}
