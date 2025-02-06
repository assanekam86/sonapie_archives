<?php
use \setasign\Fpdi\Fpdi;
use \setasign\Fpdi\PdfReader;
use \setasign\Fpdi\FpdiTpl;
use \setasign\FpdiProtection\FpdiProtection;
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', true);


  // Generate random number and store in $random variable
  $random = rand(1,10000);

  // get pdf file name, send name from ajax on other side and received here 
  $filename = "bachelier.png";

  // compete path of pdf file including directory name
  $srcfile = 'pdf-uploaded/'.$filename;
		
  // new path of new pdf file created by ghostscript if file above 1.4 
  $srcfile_new = 'pdf-compatible/'.$filename;
		
  // path of saved encrypted pdf file by fdpi
  $dest_file = 'pdf-encrypted/encrypted-'.$random.'.pdf';
 /*                    
  // read pdf file first line because pdf first line contains pdf version information
  $filepdf = fopen($srcfile,"r");
   if($filepdf) {
     $line_first = fgets($filepdf);

     fclose($filepdf);
   }
   else{
     echo "error opening the file.";
   }
  // extract number such as 1.4,1.5 from first read line of pdf file
  preg_match_all('!\d+!', $line_first, $matches);
					 
  // save that number in a variable
  $pdfversion = implode('.', $matches[0]);
  //var_dump($pdfversion);

  // compare that number from 1.4(if greater than proceed with ghostscript)
  if($pdfversion > "1.4"){
  // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
  exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=$srcfile_new $srcfile"); 

    // use now fpdi with pdf parser and fpdi protection
    //require_once('vendor/setasign/fpdi/src/FpdiProtection.php');
    //require_once('vendor/setasign/fpdi/src/Fpdi.php');
   // require_once('vendor/setasign/fpdi/src/FpdfTpl.php');
  require_once('vendor/setasign/fpdf/fpdf.php');
  //require_once('vendor/setasign/fpdi-protection/src/FpdiProtection.php');
  require_once('vendor/autoload.php');
  // require_once('fpdi-protection/src/FpdiProtection.php');
 
   //require_once('fpdi-protection/autoload.php');
    //require_once('fpdi-protection/src/FpdiProtection.php');
   // require_once ('vendor/autoload.php');
    $pdf = new FpdiProtection();
    $pagecount = $pdf->setSourceFile($srcfile_new);

    for ($loop = 1; $loop <= $pagecount; $loop++) {
      $tplidx = $pdf->importPage($loop);
      $pdf->addPage();
      $pdf->useTemplate($tplidx);
    }

    //$pdf->SetProtection(FpdiProtection::FULL_PERMISSIONS, "password");
    $pdf->SetProtection(FpdiProtection::PERM_PRINT | FpdiProtection::PERM_COPY, "password");
    //$pdf->SetProtection(\FPDI_Protection::FULL_PERMISSIONS, '123456', 'ABCDEF');
    $pdf->Output($dest_file, 'F');
 require_once('vendor/setasign/fpdf/fpdf.php');
require_once('vendor/autoload.php');
  $pdf = new Fpdi();
  $pagecount=$pdf->setSourceFile($srcfile_new);
    for ($n = 1; $n <= $pagecount; $n++) {
  $pageId = $pdf->importPage($n, PdfReader\PageBoundaries::MEDIA_BOX);
  $pdf->addPage();
  //$pdf->ImportPage($pageId, 0, 0,0);
  $pdf->useTemplate($pageId, 10, 10, 190);
// now write some text above the imported page
  $pdf->SetFont('Helvetica', 'B', 12);
  $pdf->SetFontSize(12);
  $pdf->SetTextColor(194,8,8);
  $pdf->SetXY(100, 10);
  /*if(isset($_SESSION['user']) AND ($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){*/
 // $pdf->Write(0, "Duplicata");
  /*}else{
  $pdf->Write(0, "Copie");
  }
}
   ob_end_clean();
  $pdf->Output('D',date("d-m-Y").'-generated.pdf');
         
  }
  else{	

				 
    // use FPDI if pdf version upto 1.4 no need for ghostscript 
require_once('vendor/setasign/fpdf/fpdf.php');
require_once('vendor/autoload.php');
 // require_once('vendor/setasign/fpdi-protection/src/FpdiProtection.php');

//require_once('fpdi-protection/src/FpdiProtection.php');
	
//require_once('fpdi-protection/autoload.php');  
    $pdf = new FpdiProtection();
    $pagecount = $pdf->setSourceFile($srcfile);

    for ($loop = 1; $loop <= $pagecount; $loop++) {
       $tplidx = $pdf->importPage($loop);
       $pdf->addPage();
       $pdf->useTemplate($tplidx);
     }

    $pdf->SetProtection(FpdiProtection::FULL_PERMISSIONS, "password");
    //$pdf->SetProtection(\FPDI_Protection::FULL_PERMISSIONS, '123456', 'ABCDEF');
    $pdf->Output($dest_file, 'F');
  }   


/*



use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
require_once('vendor/autoload.php');
require_once('vendor/setasign/fpdf/fpdf.php');
$fichier ="formation_php.pdf";
$pdf = new Fpdi();
$pagecount=$pdf->setSourceFile($fichier);
for ($n = 1; $n <= $pagecount; $n++) {
$pageId = $pdf->importPage($n, PdfReader\PageBoundaries::MEDIA_BOX);$pdf->addPage();
//$pdf->ImportPage($pageId, 0, 0,0);
$pdf->useTemplate($pageId, 10, 10, 190);
// now write some text above the imported page
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->SetFontSize(12);
$pdf->SetTextColor(194,8,8);
$pdf->SetXY(100, 10);
$pdf->Write(0, "Copie");
}
$pdf->Output('generated.pdf','I');
*/

require_once('vendo/autoload.php');
require_once('vendo/setasign/fpdf/fpdf.php');

$file="archives/$afficheFile->designation/$afficheFile->typ/$afficheFile->dossier/$afficheFile->fichier";

$image ='pdf-compatible/formation_php.png';

exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=$srcfile_new $srcfile");
$pdf = new FPDF();
$pdf->AddPage();
//$pdf->Image($file,5,0,200,290);
$pdf->Image($file,5,5,0,277);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->SetFontSize(12);
$pdf->SetTextColor(194,8,8);
$pdf->SetXY(100, 20);
  if($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){
  $pdf->Write(0, "Duplicata");
  }else{
  $pdf->Write(0, "Copie");
  }
$pdf->Output("I",date('d-m-Y').'generate.pdf');