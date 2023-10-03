<?php
    class Database{

        public function __construct(){
        }

        public function dbObject(){
            $conn = mysqli_connect(DB_HOST ,DB_USER,DB_PASSWORD,DB_NAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
                return $conn;
            }
            
        }
    }
?>