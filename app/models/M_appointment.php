<?php
class M_appointment
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }
    public function enterAppointmentData($refno, $test_type, $appointment_date, $appointment_time, $appointment_duration, $appointment_status, $appointment_notes, $email, $payment_method, $payment_status, $cost, $prescription, $test_type_id)
    {

        $today_date = date("Y-m-d");

        $result = mysqli_query($this->conn, "SELECT * FROM appointment ORDER BY id DESC LIMIT 1");
        $appointment = mysqli_fetch_assoc($result);
        $lastid = 0;
        if (isset($appointment['Id'])) {
            $lastid = $appointment['Id'];
        }


        $nextid = $lastid + 1;
        $query = "INSERT INTO appointment VALUES('$nextid','$refno','$test_type','$appointment_date','$appointment_time','$appointment_duration','$appointment_status','$appointment_notes','$email' , '$payment_method' , '$payment_status' , '$cost' , '$prescription' , '' , '' , '' , '1' , ' $today_date' , '$test_type_id' , '1' , '')";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
        // echo
        // "<script> alert('Registration Successful');</script>";
    }

    public function getNextId()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment ORDER BY id DESC LIMIT 1");
        $appointment = mysqli_fetch_assoc($result);
        $nextid = 1;
        if (isset($appointment['Id'])) {
            $nextid = $appointment['Id'] + 1;
        }
        return $nextid;
    }

    public function getRowByEmail($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE patient_email='$email' AND NOT (payment_method='online' AND payment_status='unpaid')");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function getRow()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment");
        return $result;
    }

    public function getRowList($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Id='$id'");
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function cancelAppointment($id)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment
                SET Appointment_Status = 'Canceled'
                WHERE Id = '$id'");

        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Id='$id'");
        $result_data = mysqli_fetch_assoc($result);

        if ($result_data['payment_status'] == 'paid') {
            $result = mysqli_query($this->conn, "UPDATE appointment
                SET refund_status = 'pending'
                WHERE Id = '$id'");
        }

        return $result_data;

    }

    public function sendAppointment($id)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment
                SET Appointment_Status = 'Send to MLT'
                WHERE Id = '$id'");
    }

    public function isAvailableDate($date, $time)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Date='$date' AND Appointment_Time='$time'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (empty($result_data)) {
            return true;
        } else {
            return false;
        }
    }

    public function doPayment($refno)
    {

        $result = mysqli_query($this->conn, "UPDATE appointment
                SET Payment_Status = 'paid'
                WHERE Ref_No = '$refno'");

        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public function getTotalRefund($email)
    {
        $result = mysqli_query($this->conn, "SELECT SUM(cost) AS refund FROM appointment WHERE patient_email='$email' AND payment_status='paid' AND Appointment_Status='Canceled' AND payment_method='online'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data[0]['refund'])) {
            return $result_data[0]['refund'];
        } else {
            return 0;
        }
    }

    public function getTotalCost($email)
    {
        $result = mysqli_query($this->conn, "SELECT SUM(cost) AS cost FROM appointment WHERE patient_email='$email' AND payment_status='paid'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data[0]['cost'])) {
            return $result_data[0]['cost'];
        } else {
            return 0;
        }
    }

    public function getUnpaidOnsiteAppointment($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE patient_email='$email' AND payment_method='onsite' AND payment_status='unpaid' AND  Appointment_Status ='Pending'");
        $unpaid_appointment_count = mysqli_num_rows($result);
        return $unpaid_appointment_count;
    }

    public function getApprovedAppointments()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Status='Approved'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function setPassKey($appointment_id)
    {
        $pass_key = $this->generateRandomString(20);

        $result = mysqli_query($this->conn, "UPDATE appointment
                SET pass_code  = '$pass_key'
                WHERE Id = '$appointment_id' AND active_status='1' ");

        $result2 = mysqli_query($this->conn, "UPDATE appointment 
                SET  Appointment_Status='Completed' 
                WHERE Id = '$appointment_id' AND active_status='1'");

        // create New Report

        $appointment = mysqli_query($this->conn, "SELECT * FROM appointment WHERE id='$appointment_id' AND active_status='1'");
        $appointment = mysqli_fetch_assoc($appointment);

        if ($appointment) {
            $ref_no = $appointment['Ref_No'];
            $test_type = $appointment['Test_Type'];
            $date = $appointment['date'];
            $email = $appointment['patient_email'];
            $test_type_id = $appointment['test_type_id'];

            $result3 = mysqli_query($this->conn, "INSERT INTO medical_report (ref_no, test_type, `date`, email, active_status, test_type_id , report_status) VALUES ('$ref_no', '$test_type', '$date', '$email', '1', '$test_type_id' , 'Pending')");
        }


        return $pass_key;
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $max)];
        }
        return $randomString;
    }

    public function getAppointmentByID($appointment_id)
    {
        $appointment = mysqli_query($this->conn, "SELECT * FROM appointment WHERE id='$appointment_id'");
        $appointment = mysqli_fetch_assoc($appointment);
        return $appointment;
    }

    public function getAppointmentByPassKey($key , $ref_no='')
    {
        if($ref_no == ''){
            $appointment = mysqli_query($this->conn, "SELECT * FROM appointment WHERE  pass_code='$key' ");
        }else{
            $appointment = mysqli_query($this->conn, "SELECT * FROM appointment WHERE  pass_code='$key' AND  Ref_No='$ref_no' ");
        }
        
        if (mysqli_num_rows($appointment) > 0) {
            $appointment = mysqli_fetch_assoc($appointment);
            return $appointment;
        } else {
            return false;
        }

    }

    public function getPriceByID($id)
    {
        $price = mysqli_query($this->conn, "SELECT cost , Id FROM appointment WHERE id='$id'");
        $price = mysqli_fetch_assoc($price);
        return $price;
    }

    public function payAppointment($id)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment SET payment_status='paid' WHERE Id='$id'");
        return $result;
    }

    public function getCompleteAppointments()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Status='Completed' AND active_status='1'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result_data = array_reverse($result_data);
        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function removeAppointment($id)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment SET active_status='0' WHERE Id='$id'");
        return $result;
    }

    public function getRenfundAppointment()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE (Appointment_Status='Canceled' OR Appointment_Status='Expired' OR Appointment_Status='Rejected') AND payment_status='paid' AND payment_method='online'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function getPendingAppointments()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Status='Pending'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function isRefundComplete($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE refund_status='refunded' AND  Id='$id'");
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function setRefundKey($id)
    {
        $refund_key = $this->generateRandomString();
        $result = mysqli_query($this->conn, "UPDATE appointment SET refund_code='$refund_key' WHERE Id='$id'");
        return $refund_key;
    }

    public function completeRefundByRefundKey($key)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment SET refund_status='refunded' WHERE refund_code='$key'");
        $result = mysqli_query($this->conn, "UPDATE appointment SET refund_code='closed' WHERE refund_code='$key'");
        return $result;
    }

    public function isExistRefundKey($key)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE refund_code='$key'");
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getTodayRevenue()
    {
        $today_date = date("Y-m-d");
        $result = mysqli_query($this->conn, "SELECT SUM(cost) AS revenue FROM appointment WHERE `date`='$today_date' AND payment_status='paid'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data[0]['revenue'])) {
            return $result_data[0]['revenue'];
        } else {
            return 0;
        }
    }

    public function getTodayAppointmentCount()
    {
        $today_date = date("Y-m-d");
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Date='$today_date'");
        return mysqli_num_rows($result);
    }

    public function getTodayRefundCost()
    {
        $today_date = date("Y-m-d");
        $result = mysqli_query($this->conn, "SELECT SUM(cost) AS refund FROM appointment WHERE `date`='$today_date' AND refund_status='refunded'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data[0]['refund'])) {
            return $result_data[0]['refund'];
        } else {
            return 0;
        }
    }

    public function getTodayAppointment()
    {
        $today_date = date("Y-m-d");
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Date='$today_date'");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function getNextSevenDateAppointment()
    {
        $today_date = date("Y-m-d");
        $next_seven_date = date('Y-m-d', strtotime($today_date . ' + 7 days'));

        $result_data = array();

        for ($i = 0; $i < 7; $i++) {
            $current_date = date('Y-m-d', strtotime("$today_date + $i days"));

            $query = "SELECT COUNT(*) AS Appointment_Count 
                              FROM appointment 
                              WHERE Appointment_Date = '$current_date' AND (Appointment_Status = 'Approved' OR Appointment_Status = 'Pending')";

            $result = mysqli_query($this->conn, $query);
            $row = mysqli_fetch_assoc($result);

            $result_data[] = array(
                'Appointment_Date' => $current_date,
                'Appointment_Count' => $row['Appointment_Count']
            );
        }

        if (!empty($result_data)) {
            return $result_data;
        } else {
            return false;
        }
    }

    public function getpendingAppointmentCount()
    {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) AS count FROM appointment WHERE Appointment_Status='Pending'");
        $result_data = mysqli_fetch_assoc($result);
        return $result_data['count'];
    }

    public function getAppointmentForMlt()
    {
        $pending_appointment = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Status='Pending' AND mlt_active='1'");
        $pending_appointment = mysqli_fetch_all($pending_appointment, MYSQLI_ASSOC);

        $other_appointment = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Status!='Pending' AND mlt_active='1'");
        $other_appointment = mysqli_fetch_all($other_appointment, MYSQLI_ASSOC);

        $result = array(
            'pending_appointment' => $pending_appointment,
            'other_appointment' => $other_appointment
        );

        return $result;

    }

    public function setApprovedAppointment($ref_no)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment SET Appointment_Status='Approved' WHERE Ref_No='$ref_no'");
        $email = mysqli_query($this->conn, "SELECT patient_email  FROM appointment WHERE Ref_No='$ref_no'");
        $email = mysqli_fetch_assoc($email);
        return $email['patient_email'];
    }

    public function setRejectedAppointment($ref_no, $reason)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment SET Appointment_Status='Rejected' WHERE Ref_No='$ref_no'");
        $result2 = mysqli_query($this->conn, "UPDATE appointment SET reject_note='$reason' WHERE Ref_No='$ref_no'");

        // add refund record.
        $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Ref_No='$ref_no'");
        $result_data = mysqli_fetch_assoc($result);

        if ($result_data['payment_status'] == 'paid') {
            $result = mysqli_query($this->conn, "UPDATE appointment
                SET refund_status = 'pending'
                WHERE Ref_No = '$ref_no'");
        }

        $patient_email = mysqli_query($this->conn, "SELECT patient_email  FROM appointment WHERE Ref_No='$ref_no'");
        $patient_email = mysqli_fetch_assoc($patient_email);
        return $patient_email['patient_email'];
    }

    public function removeAppointmentMLT($ref_no)
    {
        $result = mysqli_query($this->conn, "UPDATE appointment SET mlt_active='0' WHERE Ref_No='$ref_no'");
        return $result;
    }

    public function getAllAppointment()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM appointment");
        $result_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_data;
    }


}
?>