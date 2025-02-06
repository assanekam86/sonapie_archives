<?php 
//var_dump($_POST['photo']);
$image =$_POST['photo'];
$infoImg = explode(";base64,", $image);
$imgExt = explode("image/",$infoImg[0]);
$imagetype=$imgExt[1];
//var_dump($imagetype);
$image = str_replace(' ','+',$infoImg[1]);
$imagebase64 = base64_decode($infoImg[1]);
$nouveau = uniqid().'.'.$imagetype;
/*var_dump(base64_decode($image));*/
/*var_dump($imgExt[0]);*/
file_put_contents('archives.local/public/scann/'.$nouveau, $imagebase64);
/*$img = file_get_contents($_POST['photo']);*/
/*var_dump($img)*/

 ?>