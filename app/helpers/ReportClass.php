<?php
require ('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {


        // Background color
        $this->SetFillColor(235, 245, 255); // Light blue color
        $this->Rect(0, 0, $this->GetPageWidth(), 40, 'F'); // Rectangle with fill

        // Logo
        $this->Image(APPROOT . '/public/img/Health_Care__2_-removebg-preview.png', 10, 6, 30);

        // Lab Name
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 51, 102); // Dark blue color
        $this->Cell(0, 12, 'Sahanya LABs', 0, 1, 'C');

        // Address
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(51, 51, 51); // Dark gray color
        $this->Cell(0, 7, '123 Main Street, City, State, ZIP', 0, 1, 'C');

        // Phone and Email
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 7, 'Phone: (123) 456-7890 | Email: Labora@abclaboratory.com', 0, 1, 'C');

        // Line break
        $this->Ln(12);

    }

    // Page footer
    function Footer()
    {
        $footerY = $this->GetY();

        $footerHeight = 40;

        $this->SetFillColor(235, 245, 255); // Light blue color
        $this->Rect(0, $this->GetPageHeight() - $footerHeight+10, $this->GetPageWidth(), $footerHeight-10, 'F'); // Rectangle with fill

        $this->SetY($this->GetPageHeight() - $footerHeight + 10);

        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 51, 102); // Dark blue color
        $this->Cell(0, 8, 'Thank you for choosing ABC Laboratory', 0, 1, 'C');

        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(51, 51, 51); // Dark gray color
        $this->Cell(0, 6, 'Your Health is Our Priority', 0, 1, 'C');

        $this->Ln(4);

        $this->Image('../app/storage/lab_signs/lab_sign.jpg', 10, $this->GetY(), 30);
        $this->Cell(40, 6, '', 0, 0);
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(51, 51, 51); // Dark gray color
        $this->Cell(0, 6, $_SESSION['username'].' /Lab Assitant', 0, 1);

        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 4, 'Phone: (123) 456-7890 | Email: info@abclaboratory.com | Website: www.abclaboratory.com', 0, 1, 'C');


        $this->SetDrawColor(204, 204, 204); // Light gray color
        $this->Line(10, $footerY, $this->GetPageWidth() - 10, $footerY);
    }
}

?>