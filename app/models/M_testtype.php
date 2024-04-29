<?php
class M_testtype
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }

    // public function enterUserData($name,$email,$password,$phone,$dob,$gender,$address){
    //     // get last row id
    //     $result =mysqli_query($this->conn , "SELECT * FROM patient_data ORDER BY patient_id DESC LIMIT 1") ;
    //     $user = mysqli_fetch_assoc($result);
    //     $lastid = 0;
    //     if(isset($user['patient_id'])){
    //         $lastid = $user['patient_id'];
    //     }


    //     $nextid = $lastid +1;
    //     $query = "INSERT INTO patient_data VALUES('$nextid','$name','$email','$password','$phone','$dob','$gender','$address')";
    //     mysqli_query($this->conn , $query);
    //     // echo
    //     // "<script> alert('Registration Successful');</script>";
    // }


    public function getDuration($test_type)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM test_type WHERE id='$test_type'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;

        }
    }

    public function getRow()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM test_type WHERE active_status='1' AND availability='1'");
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_set;
    }

    public function getRowNew(){
        $result = mysqli_query($this->conn, "SELECT * FROM test_type WHERE active_status='1' AND availability='1'");
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = mysqli_query($this->conn, "SELECT * FROM test_type WHERE active_status='1' AND availability='1' LIMIT 1");
        $result = mysqli_fetch_assoc($result);
        $data['table_id'] = $result['id'];
        $data['result'] = $result_set;
        return $data;
    }

    public function getAvailableTime($date, $start_time, $end_time)
    {
        $result_set = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Date = '$date' AND Appointment_Time BETWEEN '$start_time' AND '$end_time' ORDER BY Appointment_Time DESC LIMIT 1;");
        if (mysqli_num_rows($result_set)) {
            $row = mysqli_fetch_assoc($result_set);
            return $row;
        }
    }

    public function getTestTypeCount()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM test_type WHERE active_status ='1'");
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function setTestType($test_category_name, $description, $preparation, $time_duration, $price)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM test_type ORDER BY id DESC LIMIT 1");
        $user = mysqli_fetch_assoc($result);
        $lastid = 0;
        if (isset($user['id'])) {
            $lastid = $user['id'];
        }

        // convert number to time duration
        $hours = floor(intval($time_duration) / 60);
        $minutes = intval($time_duration) % 60;

        // Format the time string
        $timeString = sprintf('%02d:%02d:00', $hours, $minutes);

        $nextid = $lastid + 1;
        $_SESSION['test_id'] = $nextid;
        $query = "INSERT INTO test_type VALUES('$nextid','$test_category_name','$description','$timeString','$price','1' , '1')";
        mysqli_query($this->conn, $query);

        for ($i = 0; $i < count($preparation); $i++) {
            $query = "INSERT INTO test_preparation VALUES('','$nextid','$preparation[$i]')";
            mysqli_query($this->conn, $query);
        }

        return true;
    }

    public function getAllActiveTests()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM test_type WHERE active_status='1'");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = array_reverse($result);
        return $result;
    }

    public function getDescriptionById($id)
    {
        $result = mysqli_query($this->conn, "SELECT `Description` FROM test_type WHERE id='$id'");
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function getPreparationsById($id)
    {
        $result = mysqli_query($this->conn, "SELECT preparation FROM test_preparation WHERE test_id='$id'");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    public function changeAvailabilityStatus($id)
    {
        $test = mysqli_query($this->conn, "SELECT  `availability`FROM test_type WHERE id='$id'");
        $test = mysqli_fetch_assoc($test);
        if ($test['availability'] == '1') {
            $result = mysqli_query($this->conn, "UPDATE test_type SET `availability`='0' WHERE id='$id'");
        } else {
            $result = mysqli_query($this->conn, "UPDATE test_type SET `availability`='1' WHERE id='$id'");
        }

        return $result;
    }

    public function removeTestById($id)
    {
        $result = mysqli_query($this->conn, "UPDATE test_type SET `active_status`='0' WHERE id='$id'");
        return $result;
    }

    public function getTestNameById($id){
        $result = mysqli_query($this->conn, "SELECT `Test_type` FROM test_type WHERE id='$id'");
        $result = mysqli_fetch_assoc($result);
        return $result['Test_type'];
    }
}
?>