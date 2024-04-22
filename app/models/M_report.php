<?php
class M_report
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new Database;
        $this->conn = $this->conn->dbObject();
    }

    public function getRowByEmail($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE email='$email'");
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (!empty($rows)) {
            return $rows;
        } else {
            return false;
        }
    }

    public function deleteFromId($id)
    {
        $result = mysqli_query($this->conn, "DELETE FROM medical_report WHERE id = '$id';");
    }

    public function getReportCount($email)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE email='$email';");
        $report_count = mysqli_num_rows($result);
        return $report_count;
    }

    public function getAllreports()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE active_status='1'");
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = array_reverse($rows);

        return $result;
    }

    public function reportCreated($ref_no)
    {
        $result = mysqli_query($this->conn, "UPDATE medical_report SET report_status='Created' WHERE ref_no='$ref_no';");
        return $result;
    }

    public function reportSendToMLT($ref_no)
    {
        $result = mysqli_query($this->conn, "UPDATE medical_report SET report_status='Review By MLT' WHERE ref_no='$ref_no';");
        return $result;
    }

    public function getReviewReportCount()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE report_status='Review By MLT';");
        $report_count = mysqli_num_rows($result);
        return $report_count;
    }

    public function getReviewReport()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE report_status='Review By MLT';");
        $report_count = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $report_count;
    }

    public function getReportForMLT()
    {
        $result1 = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE report_status='Review By MLT' AND mlt_active='1';");
        $result1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
        $result2 = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE (report_status='Completed' OR report_status='Rejected' OR report_status='Approved') AND mlt_active='1';");
        $report2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

        $reports = array_merge($result1, $report2);
        
        return $reports;
    }

    public function approveReport($ref_no){
        $result = mysqli_query($this->conn, "UPDATE medical_report SET report_status='Approved' WHERE ref_no='$ref_no';");
        return $result;
    }

    public function rejectReport($ref_no , $reason){
        $result = mysqli_query($this->conn, "UPDATE medical_report SET report_status='Rejected' , reject_note='$reason' WHERE ref_no='$ref_no';");
        return $result;
    }

    public function removeReportForMLT($ref_no){
        $result = mysqli_query($this->conn, "UPDATE medical_report SET mlt_active='0' WHERE ref_no='$ref_no';");
        return $result;
    }

    public function completeReport($ref_no){
        $result = mysqli_query($this->conn, "UPDATE medical_report SET report_status='Completed' WHERE ref_no='$ref_no';");
        return $result;
    }

    public function deleteReportByRefNo($ref_no){
        $result = mysqli_query($this->conn, "DELETE FROM medical_report WHERE ref_no='$ref_no';");
        return $result;
    }

    public function getPendingReportsCount(){
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE report_status='Pending';");
        $report_count = mysqli_num_rows($result);
        return $report_count;
    }

    public function getPendingReports(){
        $result = mysqli_query($this->conn, "SELECT * FROM medical_report WHERE report_status='Pending';");
        $report = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $report;
    }
}
?>