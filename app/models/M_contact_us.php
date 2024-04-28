<?php
    class M_contact_us{
        protected $conn;
        public function __construct(){
            $this->conn = new Database;
            $this->conn = $this->conn->dbObject();
        }

        public function submitContactUs($data){
            $name = $data['name'];
            $email = $data['email'];
            $tel = $data['tel'];
            $subject = $data['subject'];
            $message = $data['message'];

            $query = "INSERT INTO contact_us VALUES('','$name','$email','$tel','$subject','$message' , '')";
            mysqli_query($this->conn , $query);
        }

        public function getAllMessages(){
            $all_new_message = mysqli_query($this->conn , 'SELECT * FROM contact_us WHERE reply = ""');
            $messages = mysqli_fetch_all($all_new_message , MYSQLI_ASSOC);
            return $messages;
        }

        public function sendReply($data){
            $id = $data['id'];
            $reply = $data['reply'];

            $query = "UPDATE contact_us SET reply = '$reply' WHERE id = '$id'";
            mysqli_query($this->conn , $query);

            return true;
        }
    }


?>