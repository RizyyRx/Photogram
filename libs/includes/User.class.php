<?
class User{
    public static function signup($user, $email, $pass, $phone){
        $pass=strrev(md5($pass));
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
        $pass=strrev(md5($pass));
        $conn=Database::getConnection();
        $query= "SELECT * FROM `photogram credentials` WHERE `username` = '$user'";
        $result=$conn->query($query);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
            if($row['password']==$pass){
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