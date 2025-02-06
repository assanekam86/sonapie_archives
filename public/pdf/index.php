<?php
//use setasign\Fpdi\Fpdi;
//use \setasign\Fpdi\FpdfTpl;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
require_once('vendor/autoload.php');
require_once('vendor/setasign/fpdf/fpdf.php');
//require_once('vendor/setasign/fpdi/src/Fpdi.php');
//require_once('vendor/setasign/fpdi/src/FpdfTpl.php');
//require_once('vendor/autoload.php');


//$fichier ="uses.pdf";
//$pdf = new Fpdi();
//$pagecount=$pdf->setSourceFile($fichier);
//for ($n = 1; $n <= $pagecount; $n++) {
//$pageId = $pdf->importPage($n, PdfReader\PageBoundaries::MEDIA_BOX);
//$pdf->addPage();
//$pdf->ImportPage($pageId, 0, 0,0);
//$pdf->useTemplate($pageId, 10, 10, 190);
// now write some text above the imported page
//$pdf->SetFont('Helvetica', 'B', 12);
//$pdf->SetFontSize(12);
//$pdf->SetTextColor(194,8,8);
//$pdf->SetXY(100, 10);
//$pdf->Write(0, "Copie");
//}
//$pdf->Output('generated.pdf','I');

$image ='bm1.png';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image($image,20,0,170,170);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->SetFontSize(12);
$pdf->SetTextColor(194,8,8);
$pdf->SetXY(100, 10);
$pdf->Write(0, "Copie");
$pdf->Output();