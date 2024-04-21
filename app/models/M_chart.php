<?php
    class M_chart{
        protected $conn;
        public function __construct(){
            $this->conn = new Database;
            $this->conn = $this->conn->dbObject();
        }

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
            // Initialize an empty array to store the result
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



    }
?>