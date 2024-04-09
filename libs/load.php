<?
/*loads a template file if called.....
file name should be given as a parameter*/
function load_template($name)
{
    //print("including ".$_SERVER['DOCUMENT_ROOT']." $name.php");
    include $_SERVER['DOCUMENT_ROOT'] . "/app/_templates/$name.php";
}

function credential_validation($username, $password)
{
    if ($username == "rizwan@gmail.com" and $password == "password") {
        return true;
    } else {return false;
    }
}
//object oriented
function signup($user, $email, $pass, $phone)
{
    $servername = "<sever name here>";
    $username = "<usrname here>";
    $password = "<password here>";
    $dbname = "<db name here>";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `photogram credentials` (`username`, `password`, `email`, `phone no`, `blocked`, `active`)
    VALUES ('$user','$pass','$email','$phone','0','1')";
    $result = false;
    if ($conn->query($sql) === TRUE) {
        $result=true;        
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $result = false;
    }

    $conn->close();
    return $result;
}

//procedural 
function signupP($user, $email, $pass, $phone)
{
    $servername = "<sever name here>";
    $username = "<usrname here>";
    $password = "<password here>";
    $dbname = "<db name here>";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `photogram credentials` (`username`, `password`, `email`, `phone no`, `blocked`, `active`)
    VALUES ('$user','$pass','$email','$phone','0','1')";
    $error=false;
    if (mysqli_query($conn, $sql)) {
        $error=false;
    } else {

        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        $error=mysqli_error($conn);
    }

    mysqli_close($conn);
}

