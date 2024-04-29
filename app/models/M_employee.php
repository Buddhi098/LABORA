<?php
        class M_employee{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function isExistEmail($email){
                $query =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
                if(mysqli_num_rows($query)>0){
                    return true;
                }else{
                    return false;
                }
            }
            public function isEnteredEmail($email){
                $duplicate = mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'" );
                if(mysqli_num_rows($duplicate)>0){
                    return true;
                }else{
                    return false;
                }
            }

            public function enterUserData($name,$email,$phone,$dob,$address ,$gender ,$role, $password ){
                // get last row id
                $result =mysqli_query($this->conn , "SELECT * FROM employees ORDER BY id DESC LIMIT 1") ;
                $user = mysqli_fetch_assoc($result);
                $lastid = 0;

                if(isset($user['id'])){

                    $lastid = $user['id'];

                }
                

                $nextid = $lastid +1;

                $query = "INSERT INTO employees VALUES('$nextid','$name','$email','$phone','$dob','$address' ,'$gender' ,'$role', '$password')";

                mysqli_query($this->conn , $query);
                // echo
                // "<script> alert('Registration Successful');</script>";
            }


            public function getRow(){

                $result =mysqli_query($this->conn , "SELECT * FROM employees");
                
                return $result;       
            }

            public function getUser($email){
                $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'");
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user;
                }
            }

            public function getPassword($email){
                $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'");
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    return $row["password"];
                }
                
            }

            // public function deleteFromMail($email){
            //     $result = mysqli_query($this->conn ,"DELETE FROM employees WHERE email = '$email';") ;
            // }
            // public function deleteFromMail($email) {
            //     $query = "DELETE e FROM employees e
            //               LEFT JOIN orders_tbl o ON e.id = o.suplier_id
            //               WHERE e.email = ? 
            //               AND (e.role = 'employee' OR (e.role = 'supplier' AND o.suplier_id IS NULL))";
        
            //     $stmt = $this->conn->prepare($query);
            //     $stmt->bind_param('s', $email);
                
            //     if ($stmt->execute()) {
            //         return true; // Deletion successful
            //     } else {
            //         return false; // Deletion failed
            //     }
            // }
            public function deleteFromMail($email) {
                // Check if the email exists in the employees table
                $query = "SELECT id, role FROM employees WHERE email = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $employee = $result->fetch_assoc();
                    $employeeId = $employee['id'];
                    $role = $employee['role'];
                    
                    // Check if the employee is a supplier and if so, handle foreign key constraints
                    if ($role === 'supplier') {
                        // Check if this supplier ID is not referenced in orders_tbl
                        $checkQuery = "SELECT COUNT(*) AS orderCount FROM orders_tbl WHERE suplier_id = ?";
                        $checkStmt = $this->conn->prepare($checkQuery);
                        $checkStmt->bind_param('i', $employeeId);
                        $checkStmt->execute();
                        $checkResult = $checkStmt->get_result();
                        $orderCount = $checkResult->fetch_assoc()['orderCount'];
        
                        if ($orderCount > 0) {
                            // Orders are referencing this supplier, handle accordingly
                            return false; // Cannot delete supplier with active orders
                        }
                    }
                    
                    // Delete the employee record
                    $deleteQuery = "DELETE FROM employees WHERE id = ?";
                    $deleteStmt = $this->conn->prepare($deleteQuery);
                    $deleteStmt->bind_param('i', $employeeId);
                    if ($deleteStmt->execute()) {
                        return true; // Deletion successful
                    }
                }
        
                return false; // Deletion failed (employee not found or other constraints)
            }


            public function getAllSupplier(){
                $supplier = mysqli_query($this->conn, "SELECT 
                e.id, e.full_name, e.email, e.phone, e.address,
                COUNT(o.id) AS order_count
            FROM 
                employees e
            LEFT JOIN 
                orders_tbl o ON e.id = o.suplier_id AND o.status = 'complete'
            WHERE 
                e.role = 'supplier'
            GROUP BY 
                e.id, e.full_name, e.email, e.phone, e.address
            ORDER BY 
                e.id ASC;
            ");
                if($supplier && mysqli_num_rows($supplier) > 0){
                    $supplier_array = array();
                    while($row = mysqli_fetch_assoc($supplier)){
                        $supplier_array[] = $row;
                    }
                    return $supplier_array;
                } else {
                    return false;
                }
            }


            //edit profile

            // public function getPassword($email){
            //     $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
            //     if(mysqli_num_rows($result)>0){
            //         $row = mysqli_fetch_assoc($result);
            //         return $row["password"];;
            //     }
                
            // }

            // public function getUser($email){
            //     $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
            //     if(mysqli_num_rows($result)>0){
            //         $user = mysqli_fetch_assoc($result);
            //         return $user;
            //     }
            // }

            public function getUserName($email){
                $result =mysqli_query($this->conn , "SELECT * FROM employees WHERE email='$email'") ;
                if(mysqli_num_rows($result)>0){
                    $user = mysqli_fetch_assoc($result);
                    return $user['full_name'];
                }
            }

            public function changeName($email , $full_name){
                echo '<script>';
                echo 'console.log("hello");';
                echo '</script>';
                $result = mysqli_query($this->conn , "UPDATE employees
                SET full_name = '$full_name'
                WHERE email = '$email'");
            }

            public function changeMail($full_name , $email){
                $result = mysqli_query($this->conn , "UPDATE employees
                SET email = '$email'
                WHERE full_name = '$full_name'");
            }

            public function changePhone($email , $phone){
                $result = mysqli_query($this->conn , "UPDATE employees
                SET phone = '$phone'
                WHERE email = '$email'");
            }

            public function changeDob($email , $dob){
                $result = mysqli_query($this->conn , "UPDATE employees
                SET dob = '$dob'
                WHERE email = '$email'");
            }

            public function changeAddress($email , $address){
                $result = mysqli_query($this->conn , "UPDATE employees
                SET address = '$address'
                WHERE email = '$email'");
            }

            // public function getRow(){
            //     $result =mysqli_query($this->conn , "SELECT * FROM employees") ;
            //     return $result;       
            // }

            // public function setProfileImage($profile_image , $email){
            //     $result = mysqli_query($this->conn , "UPDATE employees
            //     SET profile_img = '$profile_image'
            //     WHERE email = '$email'");

            //     return $result;
            // }

            public function changePassword($password , $email){
                $result = mysqli_query($this->conn , "UPDATE employees
                SET password = '$password'
                WHERE email = '$email'");

            }

    }
?>