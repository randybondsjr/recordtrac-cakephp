<?php
 
App::import('Vendor','xtcpdf');
class MYPDF extends TCPDF {

    public function MultiRow($left, $right) {
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)

        $page_start = $this->getPage();
        $y_start = $this->GetY();

        // write the left cell
        $this->MultiCell(40, 0, $left, 1, 'L', 1, 2, '', '', true, 0);

        $page_end_1 = $this->getPage();
        $y_end_1 = $this->GetY();

        $this->setPage($page_start);

        // write the right cell
        $this->MultiCell(0, 0, $right, "T:1 0 0 L:1", 'L', 0, 1, $this->GetX() ,$y_start, true, 0);

        $page_end_2 = $this->getPage();
        $y_end_2 = $this->GetY();

        // set the new row position by case
        if (max($page_end_1,$page_end_2) == $page_start) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 == $page_end_2) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 > $page_end_2) {
            $ynew = $y_end_1;
        } else {
            $ynew = $y_end_2;
        }

        $this->setPage(max($page_end_1,$page_end_2));
        $this->SetXY($this->GetX(),$ynew);
    }

}
$user = $this->User->getUserDetails($requests[0]["Owner"][0]["user_id"]);
$titleName = $user["User"]["alias"];
// create new PDF document
$pdf = new MYPDF('l', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 020');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$today = date("F jS, y g:ia");
$pdf->SetHeaderData('', '0', 'RecordTrac', "Open Requests Report by Staff - ".$titleName." \nGenerated: ".$today);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 20);
// add a page
$pdf->AddPage();

$pdf->SetFont('times', '', 9);

// set color for background
$pdf->SetFillColor(255, 255, 200);


foreach($requests as $row){
  $dateReceived = date('M j, Y g:ia',strtotime($row["Request"]["date_received"]));
  $dateDue = date('M j, Y',strtotime($row["Request"]["due_date"]));
  $details = "Request Details\n\n";
  
  $user = $this->User->getUserDetails($row["Owner"][0]["user_id"]);
  $ownerName = $user["User"]["alias"];
  unset($user);

  
  $details .= "ID: ". $row["Request"]["id"] ."\n";
  $details .= "Received: ". $dateReceived ."\n";
  $details .= "Due: ". $dateDue ."\n";
  $details .= "Department: ". $row["Department"]["name"] ."\n";
  $details .= "Owner/Helper: ". $ownerName ."\n";
  $details .= "Requester: ". $row["Requester"]["alias"] ."\n";

  $pdf->MultiRow($details, $row["Request"]["text"]."\n");
}

// reset pointer to the last page
$pdf->lastPage();

// close and output PDF document
$pdf->Output('open-requests-report.pdf', 'I');