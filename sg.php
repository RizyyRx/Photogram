<pre>
<?
include "libs/load.php";

print("_SESSION \n");
print_r($_SESSION);
print("_SERVER \n");
print_r($_SERVER);
print("_FILES \n");
print_r($_FILES);
print("_COOKIE \n");
print_r($_COOKIE);
print("_REQUEST \n");
print_r($_REQUEST);
print("_GET \n");
print_r($_GET);
print("_POST \n");
print_r($_POST);
print("_ENV \n");
print_r($_ENV);
print("_GLOBALS \n");
print_r($GLOBALS);
print("getallheaders() \n");

if(isset($_POST)){
    Post::registerPost($_POST['post_text'],$_FILES['post_image']['tmp_name']);
}



// if(Session::isset_get('clear')){
//     print("clearing...");
//     Session::unset();
// }
// if (Session::isset_session('a')) {
//     print("A already exists....val is".Session::get('a')."\n");
// } else {
//     Session::set('a',time());
//     print("assigning value to a...val is".Session::get('a')."\n");
// }

// if(Session::isset_get("destroy")){
//     print("Destroying...");
//     Session::destroy();
// }
// print_r($_SESSION);



?>
</pre>