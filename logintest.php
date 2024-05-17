<?php
include 'libs/load.php';
$user="maeve";
$pass="yoyoboi";
$result=null;
if(isset($_GET['logout'])){
    Session::destroy();
    die("session destroyed,<a href='logintest.php'>login again</a>");
}

if(Session::get('is_loggedin')){//initially false,so else part will execute
    $username=Session::get('session_username');//username from DB is set to $username
    $userobj=new User($username);
    print("Welcome back, ".$userobj->getFirstname());
    print("<br>".$userobj->getBio());
    $userobj->setBio("oh sorry....im the best writer");
    print("<br>".$userobj->getBio());
    print("<br>".$userobj->getLastname());
    $userobj->yoNotAFunction();

}
else{
    print("No session found,trying to login...");
    $result=User::login($user,$pass);//the User::login will return username which is retrieved
    //from database.The username value is saved inside $result variable
    if($result){
        $userobj=new User($user);//username given as a parameter i.e to the __construct()
        echo "login success, ",$userobj->getUsername();
        Session::set('is_loggedin',true);//since is_loggedin set true,if part will execute next time
        Session::set('session_username',$result);//the username is saved to session_username variable in $_SESSION[] 
    }
    else{
        echo "login failed";
    }
}
echo <<<EOL
<br><a href="logintest.php?logout">logout</a>
EOL;