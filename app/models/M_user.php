<?php
class M_user
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }
    public function isEnteredEmail($email)
    {
        $duplicate = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function enterUserData($name, $email, $password, $phone, $dob, $gender, $address)
    {
        // get last row id
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data ORDER BY patient_id DESC LIMIT 1");
        $user = mysqli_fetch_assoc($result);
        $lastid = 0;
        if (isset($user['patient_id'])) {
            $lastid = $user['patient_id'];
        }


        $nextid = $lastid + 1;
        $query = "INSERT INTO patient_data (patient_id, patient_name, patient_email, password, patient_phone, patient_dob, patient_gender, patient_address)
                VALUES ('$nextid', '$name', '$email', '$password', '$phone', '$dob', '$gender', '$address')";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return true;
        } else {
            return $result;
        }
    }

    public function isExistEmail($email)
    {
        $query = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        if (mysqli_num_rows($query) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPassword($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["password"];
            ;
        }

    }

    public function getUser($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            return $user;
        }
    }

    public function getUserName($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            return $user['patient_name'];
        }
    }

    public function changeName($email, $name)
    {
        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET patient_name = '$name'
                WHERE patient_email = '$email'");
    }

    public function changePhone($email, $phone)
    {
        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET patient_phone = '$phone'
                WHERE patient_email = '$email'");
    }

    public function changeDob($email, $dob)
    {
        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET patient_dob = '$dob'
                WHERE patient_email = '$email'");
    }

    public function changeAddress($email, $address)
    {
        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET patient_address = '$address'
                WHERE patient_email = '$email'");
    }

    public function getRow()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data");
        return $result;
    }

    public function setProfileImage($profile_image, $email)
    {
        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET profile_img = '$profile_image'
                WHERE patient_email = '$email'");

        return $result;
    }

    public function changePassword($password, $email)
    {
        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET password = '$password'
                WHERE patient_email = '$email'");

    }

    public function isMailExist($mail)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$mail'");
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPatient()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    public function getTotalPatient()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data");
        $result = mysqli_num_rows($result);
        return $result;
    }

    public function getUserNameByEmail($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        $result = mysqli_fetch_assoc($result);
        return $result['patient_name'];
    }

    public function getPatientName($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM patient_data WHERE patient_email='$email'");
        $result = mysqli_fetch_assoc($result);
        return $result['patient_name'];
    }

    // public function changePassword($email, $password)
    // {
    //     $escaped_email = mysqli_real_escape_string($this->conn, $email);
    //     $escaped_password = mysqli_real_escape_string($this->conn, $password);

    //     $query = "UPDATE patient_data
    //                       SET password = '$escaped_password'
    //                       WHERE patient_email = '$escaped_email'";

    //     $result = mysqli_query($this->conn, $query);

    //     if (!$result) {
    //         // Handle the error, for example:
    //         die("Error updating password: " . mysqli_error($this->conn));
    //     }
    // }


    public function changeForgetPassword($email, $password)
    {

        $result = mysqli_query($this->conn, "UPDATE patient_data
                SET `password` = '$password'
                WHERE patient_email = '$email'");

        if (!$result) {
            throw new Exception("Error updating password: " . mysqli_error($this->conn));
        }else{
            return $result;
        }
    }

}
?>