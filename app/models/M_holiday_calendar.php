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
            $query = "INSERT INTO holiday_calendar VALUES('$nextid','$date','$description')";
            mysqli_query($this->conn , $query);
            // echo
            // "<script> alert('Registration Successful');</script>";
        }

        public function getAlldates($year, $month) {
        
            $result = mysqli_query($this->conn, "SELECT DAY(holiday) as Dates FROM holiday_calendar WHERE YEAR(holiday) = '$year' AND MONTH(holiday) = '$month'");
        
            if ($result === false) {
                return false;
            }
        
            $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            mysqli_free_result($result);
        
            return $dates;
        }
        
    }

?>