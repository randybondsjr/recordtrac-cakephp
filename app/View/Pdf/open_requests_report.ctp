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
        $this->MultiCell(0, 0, $right, 1, 'J', 0, 1, $this->GetX() ,$y_start, true, 0);

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
$pdf->SetHeaderData('', '0', 'RecordTrac', "Open Requests Report \nGenerated: ".$today);

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

//$pdf->SetCellPadding(0);
//$pdf->SetLineWidth(2);

// set color for background
$pdf->SetFillColor(255, 255, 200);

$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.

Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';

// print some rows just as example
/*
for ($i = 0; $i < 10; ++$i) {
    $pdf->MultiRow("Row \n".($i+1), $text."\n");
}
*/

foreach($requests as $row){
  $dateReceived = date('M j, y g:ia',strtotime($row["Request"]["date_received"]));
  $details = "Request Details\n\n";
  foreach ($row["Owner"] as $owner){
    if($owner["active"] == 1 && $owner["is_point_person"] == 1){
      $user = $this->User->getUserDetails($owner["user_id"]);
      $ownerName = $user["User"]["alias"];
      unset($user);
    }
  }
  
  $details .= "ID: ". $row["Request"]["id"] ."\n";
  $details .= "Received: ". $dateReceived ."\n";
  $details .= "Department: ". $row["Department"]["name"] ."\n";
  $details .= "Owner: ". $ownerName ."\n";
  $details .= "Requester: ". $row["Requester"]["alias"] ."\n";
/*
  $this->Cell($w[1],7,$dateReceived,'LR',0,'L',$fill);
  $this->Cell($w[1],7,$row["Request"]["text"],'LR',0,'L',$fill);
  $this->Cell($w[2],7,$deptname,'LR',0,'R',$fill);
  $this->Cell($w[3],7,$owner,'LR',0,'R',$fill);
  $this->Cell($w[4],7,$row["Requester"]["alias"],'LR',0,'R',$fill);
*/
  $pdf->MultiRow($details, $row["Request"]["text"]."\n");
}

// reset pointer to the last page
$pdf->lastPage();
 // extend TCPF with custom functions
//pr($users);
/*
class MYPDF extends XTCPDF {
  
  function FancyTable($header, $data) {
    $this->SetFont('','B',12);
    $this->Ln(2);
    $this->Cell(40);
    $this->SetFillColor(237,28,36);
    $this->SetTextColor(255);
    $this->Cell(0,8,"Please ensure your cell phone or pager is turned OFF",1,0,'C',true);

    $this->Ln(10);
    // Colors, line width and bold font
    $this->SetFillColor(5,139,189);
    $this->SetTextColor(255);
    $this->SetDrawColor(102,102,102);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Table Header
    $w = array(12, 40, 55, 55, 55, 55);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;

    foreach($data as $row){
      $dateReceived = date('M j, y g:ia',strtotime($row["Request"]["date_received"]));
      $owner = '';

      $deptname = $row["Department"]["name"];
      if($deptname == "Office of Neighborhood Development Services"){ $deptname = "ONDS";}
      if($deptname == "Information Technology Services"){ $deptname = "ITS";}
      $this->Cell($w[0],7,$row["Request"]["id"],'LR',0,'L',$fill);
      $this->Cell($w[1],7,$dateReceived,'LR',0,'L',$fill);
      $this->Cell($w[1],7,$row["Request"]["text"],'LR',0,'L',$fill);
      $this->Cell($w[2],7,$deptname,'LR',0,'R',$fill);
      $this->Cell($w[3],7,$owner,'LR',0,'R',$fill);
      $this->Cell($w[4],7,$row["Requester"]["alias"],'LR',0,'R',$fill);
      $this->Ln();
      $fill = !$fill;
    }

    // Closing line
    $this->Cell(array_sum($w),0,'','T');
  }
}

// create new PDF document
$pdf = new MYPDF('l', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asudni');
$pdf->SetTitle('TCPDF Example 011s');
$pdf->SetSubject('TCPDF Tutodrial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//pr($users);
// set default header data
$pdf->SetHeaderData('', '21', 'RecordTrac', 'Open Requests Report \n Dates ');

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
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('ID', 'Received', 'Request', 'Department', 'POC', 'Requester');

// data loading
//$data = $pdf->LoadData('data/table_data_demo.txt');

// print colored table
$pdf->FancyTable($header, $requests);
*/

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('open-requests-report.pdf', 'I');