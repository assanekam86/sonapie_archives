<div id="imprime_moi">
<?php
use App\Core\Db;
use App\Core\Form;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use \setasign\Fpdi\FpdiTpl;
use \setasign\FpdiProtection\FpdiProtection;

//header('Content-Type: application/pdf');
//var_dump($afficheFile);
//var_dump($_SESSION['fichier_id']);
//var_dump($_SESSION['fichier_id']);exit;
/*$affiche = Db::getInstance()->prepare(
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

//var_dump($afficheFile);exit();
	$file="archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier";
	//var_dump($file);exit();


if($afficheFile->fichier):
	move_uploaded_file("archives/$afficheFile->designation/$afficheFile->designat/$afficheFile->nature/$afficheFile->typ/$afficheFile->document/$afficheFile->fichier", "pdf-compatible/");
	endif;
	//copy("archives/".$afficheFile->designation."/".$afficheFile->designat."/".$afficheFile->nature."/".$afficheFile->typ."/".$afficheFile->document."/".$afficheFile->fichier,"pdf-compatible/$afficheFile->fichier");
	$filename="pdf-compatible/".$afficheFile->fichier;
	//var_dump($filename);exit();
    // use FPDI if pdf version upto 1.4 no need for ghostscript 
require_once('vend/autoload.php');
require_once('vend/setasign/fpdf/fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image("archives/Comptabilite/RECUS/ADZOPE/FACTURE/PGA/61fa96f98ad6a.jpg",20,10,170,170);
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
	$pdf->Output('I',date("d-m-Y").'-generated.pdf');

?>
<object width="100%" height="100%" data="<?= $afficheFile->fichier;?>" type="application/pdf"></object>
</div>

