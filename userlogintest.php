<?php
include 'libs/load.php';
$user="maeve";
$pass="yoyoboi";
$result=null;
if(isset($_GET['logout'])){
    Session::destroy();
    die("session destroyed,<a href='logintest.php'>login again</a>");
}



if(Session::isset_session("session_token")){
    if(UserSession::authorize(Session::get('session_token'))){
        print("Welcome back, ".$user);
    }
    else {
        Session::destroy();
        die("<h1>Invalid Session, <a href='userlogintest.php'>Login Again</a></h1>");
    }
}
else{
    print("No session found,trying to login...");
    $token=UserSession::authenticate($user,$pass);
    if($token){
        echo "login success, ",$user;
    }
    else{
        echo "login failed ",$user;
    }
}
echo <<<EOL
<br><a href="userlogintest.php?logout">logout</a>
EOL;