<?php


class DataModel {

    private static $db = null;

    function __construct()
    {

        if(self::$db == null){
            $servername = "127.0.0.1:8889";
            $username   = "root";
            $password   = "root";
            $dbname     = "willie";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            self::$db = $conn;
        }

    }

    public function getUsers(){
        $sql = "select * from users";
        $result = self::$db->query($sql);
        return $result;
    }


    public function delete_row($id){
        $sql = "delete from users where id = '$id' ";
        $result = self::$db->query($sql);
        return $result;
    }



}