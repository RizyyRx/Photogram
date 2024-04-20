<?php
include 'libs/load.php';
$user="maeve";
$pass="yoyoboi";
$result=null;
if(isset($_GET['logout'])){
    Session::destroy();
    die("session destroyed,<a href='logintest.php'>login again</a>");
}

if(Session::get('is_loggedin')){
    $userdata=Session::get('session_user');
    print("Welcome back, $userdata[username]");
    $result=$userdata;
}
else{
    print("No session found,trying to login...");
    $result=User::login($user,$pass);
    if($result){
        echo "login success,$result[username]";
        Session::set('is_loggedin',true);
        Session::set('session_user',$result);
    }
    else{
        echo "login failed";
    }
}
echo <<<EOL
<br><a href="logintest.php?logout">logout</a>
EOL;