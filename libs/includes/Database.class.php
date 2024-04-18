<?
class Database
{
    public static $conn = null;
    public static function getConnection()
    {
        if (Database::$conn == null) {
            $servername = "<servername here>";
            $username = "<usrname here>";
            $password = "<password here>";
            $dbname = "<DB name here>";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            else{
                print("Establishing new connection......\n");
                Database::$conn=$connection;  //replacing null with connection instance
                return Database::$conn; //returns the object with the connction instance
            }
        } 
        else {
            print("Returning existing connection\n");
            return Database::$conn;  //If connection already exists, returns that existing connection
            //used to avoid creating multiple connections if a connection already exists
        }
    }
}
