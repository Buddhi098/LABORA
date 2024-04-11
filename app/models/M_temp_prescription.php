<?php
        class M_temp_prescription{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }
            public function enterPrescription($email){

                $result =mysqli_query($this->conn , "SELECT MAX(id) AS maxID FROM temp_prescription") ;
                $result = mysqli_fetch_assoc($result);

                $nextid = $result['maxID'] +1;
                $query = "INSERT INTO temp_prescription VALUES('$nextid','$email')";
                mysqli_query($this->conn , $query);

                return $nextid;
            }
    }
?>