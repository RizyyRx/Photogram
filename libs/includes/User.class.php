<?
require_once "Database.class.php";// check if the file has already been included, and if so, not include (require) it again.
include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";
class User{

    private $conn;
    use SQLGetterSetter;

    public static function signup($user, $email, $pass, $phone){

        $options = ['cost' => 9];
        $pass=password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn=Database::getConnection();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO `photogram credentials` (`username`, `password`, `email`, `phone no`, `blocked`, `active`)
        VALUES ('$user','$pass','$email','$phone','0','1')";
        $error = false;
        try{
            if ($conn->query($sql) === true) {
                $error = false;
            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
                $error = $conn->error;
            }
        }
        catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();  // Capture the exception message
        }
        finally {
            $conn->close();
        }
    
        return $error;
    }

    public static function login($user,$pass){
        $conn=Database::getConnection();
        $query= "SELECT * FROM `photogram credentials` WHERE `username` = '$user' OR `email` = '$user'";
        $result=$conn->query($query);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
            if(password_verify($pass,$row['password'])){
                return $row['username'];
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

//user id fetched in __construct() function with either username or id
    public function __construct($username){
        $this->conn=Database::getConnection();//$this refers to the name of object that is constructed
        $this->username=$username;//the username in $this->username is not defined as a property
        //so, it is basically being assigned to a value here...since it is undefined
        $this->id=null;
        $this->table = 'photogram credentials';
        $sql="SELECT `id` FROM `photogram credentials` WHERE `username` = '$username' OR `id` = '$username'";
        try{
            $result=$this->conn->query($sql);
            if($result->num_rows==1){
                $row=$result->fetch_assoc();//fetch_assoc returns the value in associative array format
                $this->id=$row['id'];//assigning id property to the object with the id value fetched from DB
            }
            else{
                throw new Exception("Username doesn't exist");
            }
        } catch (Exception $e) {
            // Handle the exception gracefully
            echo "An error occurred: " . $e->getMessage();
            // You can also log the error for debugging purposes
            error_log("Exception: " . $e->getMessage());
        }    
    }

    
//override func for DOB
    public function setDob($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) { //checkdate is a func to check if a date format is valid
            return $this->setData('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }
// //override func to get username
//     public function getUsername()
//     {
//         return $this->username;
//     }


    //ALL THESE get,set CODES ARE REPLACED BY __call PHP MAGIC FUNCTION.

     // public function setBio($bio)
    // {
    //     //TODO: Write UPDATE command to change new bio
    //     return $this->setData('bio', $bio);
    // }

    // public function getBio()
    // {
    //     //TODO: Write SELECT command to get the bio.
    //     return $this->getData('bio');
    // }

    // public function setAvatar($link)
    // {
    //     return $this->setData('avatar', $link);
    // }

    // public function getAvatar()
    // {
    //     return $this->getData('avatar');
    // }

    // public function setFirstname($name)
    // {
    //     return $this->setData("firstname", $name);
    // }

    // public function getFirstname()
    // {
    //     return $this->getData('firstname');
    // }

    // public function setLastname($name)
    // {
    //     return $this->setData("lastname", $name);
    // }

    // public function getLastname()
    // {
    //     return $this->getData('lastname');
    // }



    // public function getDob()
    // {
    //     return $this->getData('dob');
    // }

    // public function setInstagramlink($link)
    // {
    //     return $this->setData('instagram', $link);
    // }

    // public function getInstagramlink()
    // {
    //     return $this->getData('instagram');
    // }


}
?>