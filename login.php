<?
include 'libs/load.php';

if(Session::isAuthenticated()){
    $redirect_url=get_config('base_path');
    //  // Redirect to the homepage
    header("Location: $redirect_url");
    die();
}

Session::renderPage();
?>

