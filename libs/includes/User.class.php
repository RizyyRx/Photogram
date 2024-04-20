<?
class User{
    public static function signup($user, $email, $pass, $phone){
        $options = ['cost' => 9];
        $pass=password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn=Database::getConnection();
        $sql = "INSERT INTO `photogram credentials` (`username`, `password`, `email`, `phone no`, `blocked`, `active`)
        VALUES ('$user','$pass','$email','$phone','0','1')";
        $error = false;
        if ($conn->query($sql) === true) {
            $error = false;
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $error = $conn->error;
        }
    
        $conn->close();
        return $error;
    }

    public static function login($user,$pass){
        $conn=Database::getConnection();
        $query= "SELECT * FROM `photogram credentials` WHERE `username` = '$user'";
        $result=$conn->query($query);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
            if(password_verify($pass,$row['password'])){
                return $row;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}
?>