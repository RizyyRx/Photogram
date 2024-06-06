<?php

include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";
class Post {
    use SQLGetterSetter;

    public static function registerPost($text, $image_tmp) {
        if(isset($_FILES['post_image'])) {
            $author = Session::getUser()->getEmail();//new User object with uid will be returned in getUser and email retrieved from SQLGetterSetter using the uid.
            $image_name = md5($author.time()) . ".jpg"; #TODO: change the id gen algo
            $image_path = get_config('upload_path') . $image_name;
            if(move_uploaded_file($image_tmp, $image_path)){//moves the file from temporary location to specified location
                $ls = `ls`;
                print_r($ls);
                $insert_command = "INSERT INTO `posts` (`post_text`, `image_uri`, `like_count`, `uploaded_time`, `owner`)
                VALUES ('$text', '$image_path', '0', now(), '$author')";
                $db = Database::getConnection();
                if($db->query($insert_command)){
                    $id = mysqli_insert_id($db);
                    return new Post($id);
                } else {
                    return false;
                }
            }
            
        } else {
            throw new Exception("Image not uploaded");
        }
        
    }

    public function __construct($id){
       $this->id = $id;
       $this->conn = Database::getConnection();
       $this->table = 'posts';
    }
 
}
