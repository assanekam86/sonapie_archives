  <?php
session_start();
$_SESSION['pieces']="";
$image =$_POST['photo'];
$infoImg = explode(";base64,", $image);
$imgExt = explode("image/",$infoImg[0]);
$imagetype=$imgExt[1]; 
$ext='jpg';
$n=date('dmY Hisu');
$image = str_replace(' ','+',$infoImg[1]);
$imagebase64 = base64_decode($infoImg[1]);
$nouveau = $_SESSION['copie'].'.'.$ext;
file_put_contents('scann/'.$nouveau, $imagebase64);
//$fp=fopen("scann/$nouveau", "w+");
//fwrite($fp,$imagebase64);
$p=date('dmY Hisu');
$img = new Imagick($_SERVER['DOCUMENT_ROOT']."/scann/$nouveau");
$img->setImageFormat('pdf');
$success = $img->writeImage($_SERVER['DOCUMENT_ROOT']."/pros/". $_SESSION['copie'].".pdf");
$_SESSION['pieces'].= $_SESSION['copie'].' Fichier Validé<br/>';
$_SESSION['copie'] +=1;
//file_put_contents('scann/'.$nouveau, $imagebase64);
//file_put_contents('pdf-compatible/'.$nouveau, $imagebase64);
/*$img = file_get_contents($_POST['photo']);*/
/*var_dump($img)*/



 ?>