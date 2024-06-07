<?php 

/**
 * To use this trait, the PHP Object's constructor should have
 * $id, $conn, $table variables set.
 * 
 * $id - The ID of the MySQL Table Row.
 * $conn - The MySQL Connection.
 * $table - The MySQL Table Name.
 */

 //this php magic function replaces multiple get,set codes
 trait SQLGetterSetter{
    public function __call($name, $arguments)//__call is a magic func,it executes automatically when an undefined function is called by an object
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));//only replaces first 3 char as empty value("get" is removed here)
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));//replaces string like "getDobOfUser" as "get_dob_of_user"
        if (substr($name, 0, 3) == "get") {// substr returns the portion of string specified by the offset and length parameters.
            return $this->getData($property);//if "getFirstname" is called as a function by an object,it will be filtered as "firstname" and given in the place of $property
        }
        elseif (substr($name, 0, 3) == "set") {
            return $this->setData($property, $arguments[0]);
        }
        else{
            throw new Exception(__CLASS__."::__call()->$name, function unavailable");// __CLASS__ is a magic constant that contains the name of the current class where it is used
        }
    }

    private function getData($var){
        if(!$this->conn){
            $this->conn=Database::getConnection(); 
        }
        try{
            $sql="SELECT `$var` FROM `$this->table` WHERE `id` = '$this->id'";
            $result=$this->conn->query($sql);
            if($result and $result->num_rows == 1){
                return $result->fetch_assoc()["$var"]; 
            }
        }
        catch (Exception $e) {
            throw new Exception(__CLASS__."::_get_data() -> $var, data unavailable.");
        }
    }

    private function setData($var,$value){
        if(!$this->conn){
            $this->conn=Database::getConnection();
        }
        try{
            $sql="UPDATE `$this->table` SET `$var`='$value' WHERE `id`='$this->id'";
            if($this->conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
        catch (Exception $e) {
            throw new Exception(__CLASS__."::_set_data() -> $var, data unavailable.");
        }
    }

 }

