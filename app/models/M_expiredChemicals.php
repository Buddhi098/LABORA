<?php
        class M_expiredChemicals{
            protected $conn;
            public function __construct(){
                $this->conn = new Database;
                $this->conn = $this->conn->dbObject();
            }

            public function getExpiredItem(){
                $result = mysqli_query($this->conn , "SELECT id, item_id, item_name, quantity, expire_date 
                FROM order_item 
                WHERE expire_date <= CURDATE() + INTERVAL 2 DAY ORDER BY expire_date ASC;
                ");
                $result = mysqli_fetch_all($result , MYSQLI_ASSOC);
                return $result;
            }

            // function notifyByEmail($email, $name){
                
            //     $Subject='Items with Expiry Date Within the Next Two Days';
            //     $Body='';
            //     sendEmail($email, $name, $Body, $subject);
            //     $this->md_expire->
            // }

            // public function sendEmailExpiredItem(){
            //     $result = mysqli_query($this->conn, "SELECT id, item_id, item_name, quantity, expire_date 
            //                                         FROM order_item 
            //                                         WHERE expire_date <= CURDATE() + INTERVAL 2 DAY 
            //                                         ORDER BY expire_date ASC");
            //     $expiredItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            //     $body = '<h2>Items with Expiry Date Within the Next Two Days:</h2>';
            //     $body .= '<table border="1">
            //                 <tr>
            //                     <th>ID</th>
            //                     <th>Item ID</th>
            //                     <th>Item Name</th>
            //                     <th>Quantity</th>
            //                     <th>Expire Date</th>
            //                 </tr>';
            
            //     foreach ($expiredItems as $item) {
            //         $body .= '<tr>';
            //         $body .= '<td>' . $item['id'] . '</td>';
            //         $body .= '<td>' . $item['item_id'] . '</td>';
            //         $body .= '<td>' . $item['item_name'] . '</td>';
            //         $body .= '<td>' . $item['quantity'] . '</td>';
            //         $body .= '<td>' . $item['expire_date'] . '</td>';
            //         $body .= '</tr>';
            //     }
            
            //     $body .= '</table>';
            
            //     $user = $_SESSION['user'];
            //     $name = $user['name'];
            //     $email = $user['email'];
            //     $subject = 'Items with Expiry Date Within the Next Two Days';
            
            //     sendEmail($email, $name, $body, $subject);
            
            //     return $expiredItems;
            // }
            
    

        }
?> 