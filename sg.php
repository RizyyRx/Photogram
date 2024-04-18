<pre>
<?
include "libs/load.php";


if(Session::isset_get('clear')){
    print("clearing...");
    Session::unset();
}
if (Session::isset_session('a')) {
    print("A already exists....val is".Session::get('a')."\n");
} else {
    Session::set('a',time());
    print("assigning value to a...val is".Session::get('a')."\n");
}

if(Session::isset_get("destroy")){
    print("Destroying...");
    Session::destroy();
}
print_r($_SESSION);


?>
</pre>