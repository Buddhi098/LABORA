<?php
class M_test_form
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database();
        $this->conn = $this->conn->dbObject();
    }

    public function addTestForm($test_id , $form_fields)
    {
        for( $i=0 ; $i < count($form_fields); $i++){
            $field_label = $form_fields[$i]['label'];
            $field_type = $form_fields[$i]['type'];
            $query = "INSERT INTO test_form (test_id , label , input_type) VALUES ('$test_id' , '$field_label' , '$field_type')";
            mysqli_query($this->conn , $query);
        }

        return true;
    }

    public function getTestFormById($test_type_id){
        $result = mysqli_query($this->conn , "SELECT * FROM test_form WHERE test_id = '$test_type_id'");
        $rows = mysqli_fetch_all($result , MYSQLI_ASSOC) ;
        return $rows;
    }
}


?>