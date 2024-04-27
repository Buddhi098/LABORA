<?php
    class M_chart{
        protected $conn;
        public function __construct(){
            $this->conn = new Database;
            $this->conn = $this->conn->dbObject();
        }

        //Finance chart
        //chart 1
        public function getCost() {
            $result_data = array();
        
            $query = "SELECT 
                        Test_Type,
                        SUM(cost) AS TotalPaidAmount
                      FROM 
                        appointment
                      WHERE 
                        payment_status = 'paid'
                      GROUP BY 
                        Test_Type";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = array(
                        'Test_Type' => $row['Test_Type'],
                        'TotalPaidAmount' => $row['TotalPaidAmount']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $result_data;
        }

        public function getSevenDayRevenue() {
            // Initialize an empty array to store the result
            $revenue_data = [];
        
            // Build the SQL query to calculate revenue for the past seven days
            $query = "
                SELECT 
                    DATE(Appointment_Date) AS Date,
                    SUM(cost) AS TotalRevenue
                FROM 
                    appointment
                WHERE 
                    payment_status = 'paid' AND
                    Appointment_Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND CURDATE()
                GROUP BY 
                    DATE(Appointment_Date)
                ORDER BY 
                    DATE(Appointment_Date) ASC;
            ";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $revenue_data[] = array(
                        'Date' => $row['Date'],
                        'TotalRevenue' => $row['TotalRevenue']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $revenue_data;
        }

        //cart3
        public function getMonthRevenue() {
            $revenue_month = [];
        
            // Build the SQL query to calculate revenue for the past seven days
            $query = "
                SELECT 
                YEAR(Appointment_Date) AS Year,
                MONTH(Appointment_Date) AS Month,
                SUM(cost) AS TotalCost
            FROM 
                appointment
            WHERE 
                payment_status = 'paid' AND
                MONTH(Appointment_Date) BETWEEN 1 AND 12  -- Filter appointments by month range
            GROUP BY 
                YEAR(Appointment_Date),
                MONTH(Appointment_Date)
            ORDER BY 
                Year ASC, Month ASC;
            ";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $revenue_month[] = array(
                        'Month' => $row['Month'],
                        'TotalCost' => $row['TotalCost']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $revenue_month;
        }

        // chart3 filter
        // Assuming this is a method in your model class
        public function getChartDataByMonthRange($startMonth, $endMonth) {
            // Prepare the SQL query to fetch data for the specified month range
            $query = "
                SELECT 
                    YEAR(Appointment_Date) AS Year,
                    MONTH(Appointment_Date) AS Month,
                    SUM(cost) AS TotalCost
                FROM 
                    appointment
                WHERE 
                    payment_status = 'paid' AND
                    MONTH(Appointment_Date) BETWEEN ? AND ?  -- Filter appointments by month range
                GROUP BY 
                    YEAR(Appointment_Date),
                    MONTH(Appointment_Date)
                ORDER BY 
                    Year ASC, Month ASC;
            ";

            // Execute the query with prepared statements
            $stmt = $this->conn->prepare($query);

            // Bind parameters for the month range
            $stmt->bind_param("ii", $startMonth, $endMonth); // Assuming $startMonth and $endMonth are integers

            // Execute the statement
            $stmt->execute();
            
            // Get the result set
            $result = $stmt->get_result();

            // Fetch the data into an array
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // Close the statement
            $stmt->close();

            // Return the fetched data
            return $data;
        }


        //Appointment report
        public function getSevenDay() {
            // Initialize an empty array to store the result
            $app_data = [];
        
            // Build the SQL query to calculate revenue for the past seven days
            $query = "
            SELECT
                    DATE(Appointment_Date) AS Appointment_Date,
                    COUNT(*) AS Appointment_Count
                FROM
                    appointment
                WHERE
                    (Appointment_Status = 'Pending' OR Appointment_Status = 'Completed')
                    AND DATE(Appointment_Date) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 6 DAY)
                GROUP BY
                    DATE(Appointment_Date)
                ORDER BY
                    DATE(Appointment_Date);
            ";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $app_data[] = array(
                        'Appointment_Date' => $row['Appointment_Date'],
                        'Appointment_Count' => $row['Appointment_Count']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $app_data;
        }
        
        


        
        









        // public function getNextSevenDateAppointment() {
        //     $today_date = date("Y-m-d");
        //     $next_seven_date = date('Y-m-d', strtotime($today_date . ' + 7 days'));
            
        //     $result_data = array();
            
        //     for ($i = 0; $i < 7; $i++) {
        //         $current_date = date('Y-m-d', strtotime("$today_date + $i days"));
                
        //         $query = "SELECT COUNT(*) AS Appointment_Count 
        //                   FROM appointment 
        //                   WHERE (Appointment_Status = 'Approved' OR Appointment_Status = 'Complete')";
                
        //         $result = mysqli_query($this->conn, $query);
        //         $row = mysqli_fetch_assoc($result);
                
        //         $result_data[] = array(
        //             'Appointment_Date' => $current_date,
        //             'Appointment_Count' => $row['Appointment_Count']
        //         );
        //     }
            
        //     if (!empty($result_data)) {
        //         return $result_data;
        //     } else {
        //         return false;
        //     }
        // }


        //Dashboard
        public function getTotalUser(){
            $result = mysqli_query($this->conn , "SELECT * FROM employees");
            $result = mysqli_num_rows($result);
            return $result;
        }

        public function getTotalPatient(){
            $result = mysqli_query($this->conn , "SELECT * FROM patient_data");
            $result = mysqli_num_rows($result);
            return $result;
        }

        public function getTodayAppointmentCount()
        {
            $today_date = date("Y-m-d");
            $result = mysqli_query($this->conn, "SELECT * FROM appointment WHERE Appointment_Date='$today_date'");
            return mysqli_num_rows($result);
        }

        // public function getTodayRevenue()
        // {
        //     $today_date = date("Y-m-d");
        //     $result = mysqli_query($this->conn, "SELECT SUM(cost) FROM appointment WHERE payment_status='paid' AND Appointment_Date='$today_date'");
        //     return mysqli_num_rows($result);
        // }

        public function getTodayRevenue()
        {
            $today_date = date("Y-m-d");
            $query = "SELECT SUM(cost) AS total_revenue FROM appointment WHERE payment_status = 'paid' AND Appointment_Date = '$today_date'";
            
            // Execute the query
            $result = mysqli_query($this->conn, $query);

            // Check if the query executed successfully
            if (!$result) {
                // Query execution failed, handle the error (e.g., log or return an error message)
                return false; // or handle as per your application's logic
            }

            // Fetch the result row
            $row = mysqli_fetch_assoc($result);

            // Close the result set
            mysqli_free_result($result);

            // Check if a valid row was fetched
            if ($row) {
                // Return the total revenue for today
                return $row['total_revenue'];
            } else {
                // No data found or error in fetching data
                return 0; // or handle as per your application's logic
            }
        }

        //chart
        public function patientByGender() {
            $result_data = array();
        
            $query = "SELECT patient_gender, COUNT(*) AS gender_count
            FROM patient_data
            GROUP BY patient_gender";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = array(
                        'patient_gender' => $row['patient_gender'],
                        'gender_count' => $row['gender_count']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $result_data;
        }

        public function appointmentSchedule() {
            $result_data = array();
        
            $query = "SELECT payment_method, COUNT(*) AS payment_status
            FROM appointment
            WHERE YEAR(Appointment_Date) = YEAR(CURDATE()) AND MONTH(Appointment_Date) = MONTH(CURDATE())
            GROUP BY payment_method";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = array(
                        'payment_method' => $row['payment_method'],
                        'payment_status' => $row['payment_status']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $result_data;
        }

        public function paymentStatus() {
            $result_data = array();
        
            $query = "SELECT payment_status, SUM(cost) AS total_revenue
            FROM appointment
            WHERE YEAR(Appointment_Date) = YEAR(CURDATE()) AND MONTH(Appointment_Date) = MONTH(CURDATE())
            GROUP BY payment_status;
            ";
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = array(
                        'payment_status' => $row['payment_status'],
                        'total_revenue' => $row['total_revenue']
                    );
                }
            } else {
                // Handle query execution error
                return false;
            }
        
            return $result_data;
        }




    }
?>