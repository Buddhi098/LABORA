<?php
    class M_chart{
        protected $conn;
        public function __construct(){
            $this->conn = new Database;
            $this->conn = $this->conn->dbObject();
        }

        public function getNextSevenDateAppointment() {
            $today_date = date("Y-m-d");
            $next_seven_date = date('Y-m-d', strtotime($today_date . ' + 7 days'));
            
            $result_data = array();
            
            for ($i = 0; $i < 7; $i++) {
                $current_date = date('Y-m-d', strtotime("$today_date + $i days"));
                
                $query = "SELECT COUNT(*) AS Appointment_Count 
                          FROM appointment 
                          WHERE (Appointment_Status = 'Approved' OR Appointment_Status = 'Complete')";
                
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



    }
?>