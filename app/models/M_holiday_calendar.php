<?php
    class M_holiday_calendar{
        protected $conn;
        public function __construct(){
            $this->conn = new Database;
            $this->conn = $this->conn->dbObject();
        }

        public function isExistHoliday($date){
            $query =mysqli_query($this->conn , "SELECT * FROM holiday_calendar WHERE date='$date'") ;
            if(mysqli_num_rows($query)>0){
                return true;
            }else{
                return false;
            }
        }

        public function enterHolidayData($date,$description){
            // get last row id
            $result =mysqli_query($this->conn , "SELECT * FROM holiday_calendar ORDER BY id DESC LIMIT 1") ;
            $holiday = mysqli_fetch_assoc($result);
            $lastid = 0;
            if(isset($holiday['id'])){
                $lastid = $holiday['id'];
            }
            

            $nextid = $lastid +1;
            $check = mysqli_query($this->conn , "SELECT * FROM holiday_calendar WHERE holiday='$date'");
            if(mysqli_num_rows($check)==0){
                $query = "INSERT INTO holiday_calendar VALUES('$nextid','$date','$description' , '1')";
                $result = mysqli_query($this->conn , $query);
                return $result;
            }else{
                return false;
            }
            // echo
            // "<script> alert('Registration Successful');</script>";
        }

        public function getAlldates($year, $month) {
        
            $result = mysqli_query($this->conn, "SELECT DAY(holiday) as Dates FROM holiday_calendar WHERE YEAR(holiday) = '$year' AND MONTH(holiday) = '$month' AND `delete_status`='1'");
        
            if ($result === false) {
                return false;
            }
        
            $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            mysqli_free_result($result);
        
            return $dates;
        }

        public function getHolidays(){
            $result = mysqli_query($this->conn , "SELECT * FROM holiday_calendar WHERE `delete_status`='1'");
            $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
            $result = array_reverse($result);
            return $result;
        }

        public function deleteHoliday($id){
            $result = mysqli_query($this->conn , "UPDATE holiday_calendar SET delete_status='0' WHERE id='$id'");
            return $result;
        }
        
    }

?>