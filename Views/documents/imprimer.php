<!--
 <button type="button" class="btn btn-info"onclick="javascript:imprime_bloc('titre', 'imprime_moi');"><i class="fa fa-print"></i> Lancer l'impression</button> -->
		<?php 
use App\Core\Db;
use App\Core\Form;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use \setasign\Fpdi\FpdiTpl;
use \setasign\FpdiProtection\FpdiProtection;


// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', true);
//Appel du fichier pdf
//$file="archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier";
copy("archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier","pdf-uploaded/".$afficheFile->fichier);
  // Generate random number and store in $random variable
  $random = rand(1,10000);

  // get pdf file name, send name from ajax on other side and received here 
  $filename = "Document.pdf";
 if(!is_dir("pdf-uploaded")){
 	mkdir("pdf-uploaded",0777);
 }
  // compete path of pdf file including directory name
  $srcfile ="pdf-uploaded/Document.pdf";
		
  // new path of new pdf file created by ghostscript if file above 1.4 
  $srcfile_new = 'pdf-compatible/'.$filename;
		
  // path of saved encrypted pdf file by fdpi
  $dest_file = 'pdf-encrypted/encrypted-'.$random.'.pdf';
                 
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
  //if($pdfversion > "1.4"){
    //var_dump($pdfversion); exit();
  // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
  exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=$srcfile_new $srcfile"); 

require_once('fpdf/vendor/setasign/fpdf/fpdf.php');
require_once('fpdf/vendor/autoload.php');
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
  $pdf->Write(0, "Duplicata");
  
}
ob_end_clean();
$pdf->Output('I',date("d-m-Y").'-generated.pdf');
//}






























//debut
//var_dump($afficheFile);
//var_dump($_SESSION['fichier_id']);
/*
$affiche = Db::getInstance()->prepare(
			"SELECT
			d.reference,d.libelle as document, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ 
		 FROM 
		 documents as d,services as s,categories as c, natures as n, types as t,fichiers as f 
		 WHERE 
		 d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id 
			AND
		  d.id = f.id_doc AND f.id=? AND d.actif=? AND f.actif=? ORDER BY d.date_creation_doc DESC ");
		  $affiche->execute([$_SESSION['fichier_id'],1,1]);
$afficheFile= $affiche->fetch();*/

//$file="archives/".$afficheFile->designation."/".$afficheFile->designat."/".$afficheFile->nature."/".$afficheFile->typ."/".$afficheFile->document."/".$afficheFile->fichier;
//$files = fopen($file,"r");		 
//copy($file, "http://archives.local/pdf-uploaded/");

//if($afficheFile->type =='pdf')
//{
// Report all errors

//$srcfile = "archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier";
/*
  error_reporting(E_ALL);
ini_set('display_errors', true);
  // Generate random number and store in $random variable
  $random = rand(1,10000);

    
  // compete path of pdf file including directory name
  $srcfile = "archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier";		
 
 //copy("archives/".$afficheFile->designation."/".$afficheFile->designat."/".$afficheFile->nature."/".$afficheFile->typ."/".$afficheFile->document."/".$afficheFile->fichier,"pdf-compatible/$afficheFile->fichier");
 $filename = $afficheFile->fichier;
 $srcfile_new = "pdf-compatible/$filename";		
  // path of saved encrypted pdf file by fdpi
  $dest_file = 'pdf-encrypted/encrypted-'.$random.'.pdf';  
//fin de cration
  // get pdf file name, send name from ajax on other side and received here 
                 
  // read pdf file first line because pdf first line contains pdf version information
  $filepdf = fopen($srcfile,"r");
   if($filepdf) {
     $line_first = fgets($filepdf);
     fclose($filepdf);
   }
   else{
     Form::setFlash('danger',"Erreur d'ouverture du fichier");
   }
  // extract number such as 1.4,1.5 from first read line of pdf file
  preg_match_all('!\d+!', $line_first, $matches);
					 
  // save that number in a variable
  $pdfversion = implode('.', $matches[0]);
  //var_dump($pdfversion);exit();
  // compare that number from 1.4(if greater than proceed with ghostscript)
  if($pdfversion > "1.4"){
  // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH


  exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=$srcfile_new $srcfile"); 
//var_dump($pdfversion);exit();
 /* require_once('fpdf/vendor/setasign/fpdf/fpdf.php');
  require_once('fpdf/vendor/autoload.php');
  
    $pdf = new FpdiProtection();
    $pagecount = $pdf->setSourceFile($srcfile_new);

    for ($loop = 1; $loop <= $pagecount; $loop++) {
      $tplidx = $pdf->importPage($loop);
      $pdf->addPage();
      $pdf->useTemplate($tplidx);
    }

    //$pdf->SetProtection(FpdiProtection::FULL_PERMISSIONS, "password");
    $pdf->SetProtection(FpdiProtection::PERM_PRINT | FpdiProtection::PERM_COPY, "password");*/
    //$pdf->SetProtection(\FPDI_Protection::FULL_PERMISSIONS, '123456', 'ABCDEF');
  //  $pdf->Output($dest_file,'F');
 /*require_once('fpdf/vendor/setasign/fpdf/fpdf.php');
require_once('fpdf/vendor/autoload.php');
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
  if(isset($_SESSION['user']) AND ($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER'))
  {
  $pdf->Write(0, "Duplicata");
  }else{
  $pdf->Write(0, "Copie");
  }
 }
   ob_end_clean();
  $pdf->Output('I',date("d-m-Y").'-generated.pdf');
         
  }
  else{	
			 
    // use FPDI if pdf version upto 1.4 no need for ghostscript 
require_once('fpdf/vendor/setasign/fpdf/fpdf.php');
require_once('fpdf/vendor/autoload.php');
$file = "archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier";
// version inferieure ou egale a 1.4
    $pdf = new Fpdi();
  $pagecount=$pdf->setSourceFile($file);
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
  if(isset($_SESSION['user']) AND ($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER'))
  {
  $pdf->Write(0, "Duplicata");
  }else{
  $pdf->Write(0, "Copie");
  }
 }
   	ob_end_clean();
  	$pdf->Output('I',date("d-m-Y").'-generated.pdf');
  }                
//}


//fin

  ?>


























<?php	/*
require_once('fpdf/vendor/autoload.php');
require_once('fpdf/vendor/setasign/fpdf/fpdf.php');
	$fichier =$file;
		if($afficheFile->type=='pdf'){
	$pdf = new Fpdi();
	$pagecount=$pdf->setSourceFile($fichier);
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
	if(isset($_SESSION['user']) AND ($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
	$pdf->Write(0, "Duplicata");
	}else{
	$pdf->Write(0, "Copie");
	}
}
	 ob_end_clean();
	$pdf->Output('D',date("d-m-Y").'-generated.pdf');
}else{
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image($fichier,20,0,170,170);
	$pdf->SetFont('Helvetica', 'B', 12);
	$pdf->SetFontSize(12);
	$pdf->SetTextColor(194,8,8);
	$pdf->SetXY(100, 10);

	if(isset($_SESSION['user']) AND ($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
	$pdf->Write(0, "Duplicata");
	}else{
	$pdf->Write(0, "Copie");
	}
	ob_end_clean();
	$pdf->Output('D',date("d-m-Y").'-generated.pdf');
}
*/

?>
<!--
</div>
<script language="javascript">
function imprime_bloc(titre, objet) {
// Définition de la zone à imprimer
var zone = document.getElementById(objet).innerHTML;
 
// Ouverture du popup
var fen = window.open("", "", "height=500, width=600,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=10, top=10");
 
// style du popup
fen.document.body.style.color = '#000000';
fen.document.body.style.backgroundColor = '#FFFFFF';
fen.document.body.style.padding = "20px";
 
// Ajout des données a imprimer
fen.document.title = titre;
fen.document.body.innerHTML += " " + zone + " ";
 
// Impression du popup
fen.window.print();
 
//Fermeture du popup
fen.window.close();
return true;
}
</script>	
 -->


 
