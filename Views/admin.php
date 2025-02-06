
<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Models\Model;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
 setlocale( LC_TIME, 'fr_FR.utf8', 'fra' ); ?>
<!DOCTYPE html>
<html lang="fr" moznomarginboxes mozdisallowselectionprint>

<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GESTION ARCHIVES</title>

    <!-- Custom fonts for this template-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" type="images/x-icon" href="/img/logo.jpg"/>

    <!-- Custom styles for this template

    <link rel="stylesheet" href="css/style.css" type="text/css"/>
       
    <link href="/css/charge.css" rel="stylesheet">-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
   <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
     <script src="/vendor/jquery/jquery.min.js"></script>
<link href="/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Modal CSS (style basique pour exemple) -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: rgba(0,0,0,0.5);
        }

        .modal-dialog {
            position: relative;
            margin: 10% auto;
            max-width: 500px;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        .modal-footer {
            text-align: right;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
<script src="/select2/dist/js/select2.js"></script>
 
  <script src="/js/0cb2b2ec70.js" crossorigin="anonymous"></script>
 
 
      <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
       <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="/css/style.css">
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
<script src="/js/chart.js"></script>
<script src="/vendor/assets/pspdfkit.js" type="text/javascript"></script>
   
     <script src=""></script>
    <script src="https://cdn.asprise.com/scannerjs/scanner.js" type="text/javascript"></script>
    <script src="/js/scanner.js" type="text/javascript"></script>

    <script>
        var d = new FormData();
            d.append('t','ok')

        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Initiates a scan */
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                    {
                        "output_settings": [
                            {
                                "type": "return-base64",
                                "format": "jpg",
                                "width": "900px",
                                "height": "1500px"
                            }
                        ]
                    }
            ); 
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('User cancelled');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
           //var formdata =new FormData();
           //formdata.append('type','ok')
          // console.log(formdata)
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
               d.append('photo',scannedImage.src)
                $.ajax({
                url:'/traitement.php',
                type:'POST',
                data:d,
                contentType:false,
                processData:false,
                dataType:'json',

            })
                processScannedImage(scannedImage);
            }
            
           
           
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            
            document.getElementById('images').appendChild(elementImg);
            $('.zone').append('<input type="hidden" style="width:150px" value="" name="image[]">&nbsp;&nbsp;')
           
        }

        <!-- Previous lines are same as demo-01, below is new addition to demo-02 -->

        /** Upload scanned images by submitting the form */
        function submitFormWithScannedImages() {
            if (scanner.submitFormWithImages('form1', imagesScanned, function (xhr) {
                //console.log(xhr)
                if (xhr.readyState == 4) { // 4: request finished and response is ready
                    document.getElementById('server_response').innerHTML = "<h2>Reponse du serveur: </h2>" + xhr.responseText;
                    document.getElementById('images').innerHTML = ''; // clear images
                    imagesScanned = [];
                }


            })) {
                document.getElementById('server_response').innerHTML = "Veillez patienter ...";
 /*for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                d.append('photo',scannedImage.src)
                 $.ajax({
                url:'traitement.php',
                type:'POST',
                data:d,
                contentType:false,
                processData:false,
                dataType:'json',

            })
                processScannedImage(scannedImage);
            }*/
            } else {
                document.getElementById('server_response').innerHTML = "echec. reprendre le scan.";
            }
        }

    </script>
    <script type="text/javascript">
function met(btn,champ1,champ2)
{
 if (btn.checked)
   {
    document.getElementById(champ1).style.display="inline";
 document.getElementById(champ2).style.display="none";
   }
 else {
    document.getElementById(champ1).style.display="none";
 document.getElementById(champ2).style.display="display";
   }
}
</script>
    <script>
    /*   $(function(){
             function timeChecker(){
  setInterval(function(){
var storedTimeStamp =sessionStorage.getItem("lastTimeStamp"); 
timeCompare(storedTimeStamp);
  },3000);
             }
function timeCompare(timeString){
 var currentTime = new Date();
 var pastTime = new Date(timeString);
var timeDiff = currentTime - pastTime;
var minPast = Math.floor( (timeDiff/80000));

    if(minPast > 5){
       sessionStorage.removeItem('lastTimeStamp');
    window.location = "/session_killer.php";
                    return false; 
                }else{
                console.log(currentTime  +" - "+ pastTime+" - "+minPast+" min past");
                }
             }

            $(document).mousemove(function(){
                var timestamp = new Date();
                sessionStorage.setItem("lastTimeStamp",timestamp);
            });

            timeChecker();
        });*/
    </script>

   <script>
      $(document).ready(function(){
        $('#domaine').on('change',function(){

            var domaineid = $(this).val();
            if(domaineid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxData.php',
                    data:'domaine='+domaineid,
                    success:function(html){
                        $('#type').html(html);
                       
                    }
                });
            }else{
        $('#type').html('<option value"">Choisir le type </option>');
        
            }
        });
      });  
    </script>

   <script>
      $(document).ready(function(){
        $('#domaine').on('change',function(){

            var domaineid = $(this).val();
            if(domaineid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataUsager.php',
                    data:'domaine='+domaineid,
                    success:function(html){
                       
                        $('#usag').html(html);
                    }
                });
            }else{
        $('#usag').html('<option value"">Choisir usager </option>');
            }
        });
      });  
    </script>

     <script>
      $(document).ready(function(){
        $('#domaine').on('change',function(){

            var domaineid = $(this).val();
            if(domaineid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataDossier.php',
                    data:'domaine='+domaineid,
                    success:function(html){
                       
                        $('#doss').html(html);
                    }
                });
            }else{
        $('#doss').html('<option value"">Choisir dossier </option>');
            }
        });
      });  
    </script>
        <script>
      $(document).ready(function(){
        $('#etagere').on('change',function(){

            var etagereid = $(this).val();
            if(etagereid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtag.php',
                    data:'etagere='+etagereid,
                    success:function(html){
                       
                        $('#ville').html(html);
                    }
                });
            }else{
        $('#ville').html('<option value"">Choisir dossier </option>');
            }
        });
      });  
    </script>
     <script>
      $(document).ready(function(){
        $('#ville').on('change',function(){

            var villeid = $(this).val();
            if(villeid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataSa.php',
                    data:'ville='+villeid,
                    success:function(html){
                       
                        $('#salle').html(html);
                    }
                });
            }else{
        $('#salle').html('<option value"">Choisir salle </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#salle').on('change',function(){

            var salleid = $(this).val();
            if(salleid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataRa.php',
                    data:'salle='+salleid,
                    success:function(html){
                       
                        $('#rayon').html(html);
                    }
                });
            }else{
        $('#rayon').html('<option value"">Choisir le Rayon </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#rayon').on('change',function(){

            var rayonid = $(this).val();
            if(rayonid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEta.php',
                    data:'rayon='+rayonid,
                    success:function(html){
                       
                        $('#etager').html(html);
                    }
                });
            }else{
        $('#etager').html('<option value"">Choisir etagere </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#etager').on('change',function(){

            var etagerid = $(this).val();
            if(etagerid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataBoi.php',
                    data:'etager='+etagerid,
                    success:function(html){
                       
                        $('#boite').html(html);
                    }
                });
            }else{
        $('#boite').html('<option value"">Choisir boite </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#etagere').on('change',function(){

            var etagereid = $(this).val();
            if(etagereid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtagSal.php',
                    data:'etagere='+etagereid,
                    success:function(html){
                       
                        $('#salle').html(html);
                    }
                });
            }else{
        $('#salle').html('<option value"">Choisir dossier </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#etagere').on('change',function(){

            var etagereid = $(this).val();
            if(etagereid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtagRay.php',
                    data:'etagere='+etagereid,
                    success:function(html){
                       
                        $('#rayon').html(html);
                    }
                });
            }else{
        $('#rayon').html('<option value"">Choisir dossier </option>');
            }
        });
      });  
    </script>

    <script>
      $(document).ready(function(){
        $('#domaine').on('change',function(){

            var domaineid = $(this).val();
            if(domaineid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataCDossier.php',
                    data:'domaine='+domaineid,
                    success:function(html){
                       
                        $('#boite').html(html);
                    }
                });
            }else{
        $('#boite').html('<option value"">Choisir la boite </option>');
            }
        });
      });  
    </script>
<script>
      $(document).ready(function(){
        $('#boite').on('change',function(){

            var boiteid = $(this).val();
            if(boiteid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtagD.php',
                    data:'boite='+boiteid,
                    success:function(html){
                       
                        $('#ville').html(html);
                    }
                });
            }else{
        $('#ville').html('<option value"">Choisir dossier </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#boite').on('change',function(){

            var boiteid = $(this).val();
            if(boiteid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtagSalD.php',
                    data:'boite='+boiteid,
                    success:function(html){
                       
                        $('#salle').html(html);
                    }
                });
            }else{
        $('#salle').html('<option value"">Choisir boite </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#boite').on('change',function(){

            var boiteid = $(this).val();
            if(boiteid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtagRayD.php',
                    data:'boite='+boiteid,
                    success:function(html){
                       
                        $('#rayon').html(html);
                    }
                });
            }else{
        $('#rayon').html('<option value"">Choisir boite </option>');
            }
        });
      });  
    </script>
      <script>
      $(document).ready(function(){
        $('#boite').on('change',function(){

            var boiteid = $(this).val();
            if(boiteid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataEtagDe.php',
                    data:'boite='+boiteid,
                    success:function(html){
                       
                        $('#etagere').html(html);
                    }
                });
            }else{
        $('#etagere').html('<option value"">Choisir Boite </option>');
            }
        });
      });  
    </script>
    <script>
      $(document).ready(function(){
        $('#salle').on('change',function(){

            var salleid = $(this).val();
            if(salleid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataSalle.php',
                    data:'salle='+salleid,
                    success:function(html){
                       
                        $('#ville').html(html);
                    }
                });
            }else{
        $('#ville').html('<option value"">Choisir la Salle </option>');
            }
        });
      });  
    </script>
      <script>
      $(document).ready(function(){
        $('#rayon').on('change',function(){

            var rayonid = $(this).val();
            if(rayonid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataVill.php',
                    data:'rayon='+rayonid,
                    success:function(html){
                       
                        $('#ville').html(html);
                    }
                });
            }else{
        $('#ville').html('<option value"">Choisir le rayon </option>');
            }
        });
      });  
    </script>
        <script>
      $(document).ready(function(){
        $('#rayon').on('change',function(){

            var rayonid = $(this).val();
            if(rayonid){
                //alert('BIENVENUE');
                $.ajax({
                    type:'POST',
                    url:'/ajaxDataSall.php',
                    data:'rayon='+rayonid,
                    success:function(html){
                       
                        $('#salle').html(html);
                    }
                });
            }else{
        $('#salle').html('<option value"">Choisir le rayon </option>');
            }
        });
      });  
    </script>

<script>
    document.getElementById('ville').addEventListener('change', function() {
        let villeId = this.value;
        fetch('/boites/getSallesByVille/' + villeId)
            .then(response => response.json())
            .then(data => {
                let salleSelect = document.getElementById('salle');
                salleSelect.innerHTML = '<option value="">Choisir Salle</option>';
                data.forEach(function(salle) {
                    salleSelect.innerHTML += `<option value="${salle.id}">${salle.salle}</option>`;
                });
            });
    });

    document.getElementById('salle').addEventListener('change', function() {
        let salleId = this.value;
        fetch('/boites/getRayonsBySalle/' + salleId)
            .then(response => response.json())
            .then(data => {
                let rayonSelect = document.getElementById('rayon');
                rayonSelect.innerHTML = '<option value="">Choisir Rayon</option>';
                data.forEach(function(rayon) {
                    rayonSelect.innerHTML += `<option value="${rayon.id}">${rayon.rayon}</option>`;
                });
            });
    });

    document.getElementById('rayon').addEventListener('change', function() {
        let rayonId = this.value;
        fetch('/boites/getEtageresByRayon/' + rayonId)
            .then(response => response.json())
            .then(data => {
                let etagereSelect = document.getElementById('etagere');
                etagereSelect.innerHTML = '<option value="">Choisir Étagère</option>';
                data.forEach(function(etagere) {
                    etagereSelect.innerHTML += `<option value="${etagere.id}">${etagere.etagere}</option>`;
                });
            });
    });
    
</script>
    <style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }

        div#images {
            margin-top: 20px;
        }
    </style>

</head>

<body id="page-top">
    <!--
<div class="loader">
        <span class="lettre">C</span>
        <span class="lettre">H</span>
        <span class="lettre">A</span>
        <span class="lettre">R</span>
        <span class="lettre">G</span>
        <span class="lettre">E</span>
        <span class="lettre">M</span>
        <span class="lettre">E</span>
        <span class="lettre">N</span>
        <span class="lettre">T</span>
    </div>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
               <!-- <i class="fas fa-laugh-wink"></i>-->
               <img src="/img/logo.jpg" width="50" height="50" style="border-radius: 100px;">
            </div>
            <div class="sidebar-brand-text mx-3">ARCHIVES</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/users/account">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tableau de bord</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Mon menu
        </div>
         <!-- Nav Item - Pages Collapse Menu -->
          <?php if(isset($_SESSION['user']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){?>

            <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cogs"></i>
                <span>DIRECTION</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu direction:</h6>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                       <a class="collapse-item" href="/directions/ajouter">Ajouter Direction</a>
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                       <a class="collapse-item" href="/directions/ajouter">Ajouter Direction</a>
                    <?php } ?>
                    
                    <a class="collapse-item" href="/directions/liste_directions">Lister les Direction</a>

                   
                </div>
            </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwol" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-area-chart"></i>
                <span>VILLES - SALLES</span>
            </a>
            <div id="collapseTwol" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu ville:</h6>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                       <a class="collapse-item" href="/villes/ajouter">Ajouter ville</a>
                       <a class="collapse-item" href="/salles/ajouter">Ajouter salle</a>
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                       <a class="collapse-item" href="/villes/ajouter">Ajouter ville</a>
                       <a class="collapse-item" href="/salles/ajouter">Ajouter salle</a>
                    <?php } ?>
                    
                    <a class="collapse-item" href="/villes/liste_villes">Lister les villes</a>
                    <a class="collapse-item" href="/salles/liste_salles">Lister les salles</a>


                   
                </div>
            </div>
        </li>


            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwols" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-pie-chart"></i>
                <span>RAYONS - ETAGERES</span>
            </a>
            <div id="collapseTwols" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu Rayon:</h6>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                       <a class="collapse-item" href="/rayons/ajouter">Ajouter rayon</a>
                       <a class="collapse-item" href="/etageres/ajouter">Ajouter Etagère</a>
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                       <a class="collapse-item" href="/rayons/ajouter">Ajouter rayon</a>
                       <a class="collapse-item" href="/etageres/ajouter">Ajouter Etagère</a>

                    <?php } ?>
                    
                    <a class="collapse-item" href="/rayons/liste_rayons">Lister les rayons</a>
                    <a class="collapse-item" href="/etageres/liste_etageres">Lister les etagères</a>

                   
                </div>
            </div>
        </li>
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo401" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-box-open"></i>
                <span>BOITES - DOSSIERS</span>
            </a>
            <div id="collapseTwo401" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu Boite - Dossier:</h6>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                       <a class="collapse-item" href="/boites/ajouter">Ajouter une Boite Archive</a>
                      <!-- <a class="collapse-item" href="/dossiers/ajouter">Ajouter un Dossier</a>-->
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                       <a class="collapse-item" href="/boites/ajouter">Ajouter une Boite Archive</a>
                      <!-- <a class="collapse-item" href="/dossiers/ajouter">Ajouter un Dossier</a>-->
                    <?php } ?>
                    
                    <a class="collapse-item" href="/boites/liste_boites">Lister les Boites Archives</a>
                    <a class="collapse-item" href="/dossiers/liste_dossiers">Lister les Dossiers</a>

                   
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo0" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-tags"></i>
                <span>DOMAINES</span>
            </a>
            <div id="collapseTwo0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu domaine:</h6>
                     <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                   <!-- <a class="collapse-item" href="/domaines/ajouter">Ajouter un Domaine</a>-->
                     <?php } ?>
                     <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                    <!--<a class="collapse-item" href="/domaines/ajouter">Ajouter un Domaine</a>-->
                     <?php } ?>
                    <a class="collapse-item" href="/domaines/liste_domaines">Lister les Domaines</a>
                   
                </div>
            </div>
        </li>
<!--
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo01" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-tags"></i>
                <span>NATURES</span>
            </a>
            <div id="collapseTwo01" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu nature:</h6>
                     <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                    <a class="collapse-item" href="/natures/ajouter">Ajouter une Nature</a>
                     <?php } ?>
                     <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                    <a class="collapse-item" href="/natures/ajouter">Ajouter une Nature</a>
                     <?php } ?>
                    <a class="collapse-item" href="/natures/liste_natures">Lister les natures</a>
                   
                </div>
            </div>
        </li>-->

        

<!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-wrench"></i>
                <span>TYPOLOGIE</span>
            </a>
            <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu Typologie:</h6>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                       <!--<a class="collapse-item" href="/types/ajouter">Ajouter Typologie</a>-->
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                      <!-- <a class="collapse-item" href="/types/ajouter">Ajouter Typologie</a>-->
                    <?php } ?>
                    
                    <a class="collapse-item" href="/types/liste_types">Lister les Typologies</a>

                   
                </div>
            </div>
        </li>

    
    
<?php } ?>



        <!-- Nav Item - Pages Collapse Menu -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages02" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>PIECES</span>
            </a>


            <div id="collapsePages02" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Dossiers - Pièces</h6>
                    
                     
                  
                    <a class="collapse-item" href="/documents/mes_documents">Liste des Pièces</a>
                   
                         
                           <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                             <a class="collapse-item" href="/documents/ajout_documents">Ajouter une Pièces</a>
                        <a class="collapse-item" href="/documents/liste_documents">Liste des Dossiers</a>
                          <a class="collapse-item" href="/documents/corbeille_documents">Corbeille Admin</a>
                        <?php } ?>
                   
                     <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                         <a class="collapse-item" href="/documents/ajout_documents">Ajouter une Pièces</a>
                    <a class="collapse-item" href="/documents/liste_documents">Liste des Dossiers</a>
                      <a class="collapse-item" href="/documents/corbeille_documents">Corbeille Admin</a>
                    <?php } ?>
                    
                    <a class="collapse-item" href="/documents/corbeille_user">Corbeille Utilisateur</a>

                    
                    <div class="collapse-divider"></div>

                </div>
            </div>
            
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/documents/recherche">
                <i class="fas fa-fw fa-search"></i>
                <span>CONSULTER PI&Egrave;CE</span>
            </a>
        </li>

    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo41" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>USAGER</span>
            </a>
            <div id="collapseTwo41" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu Usager:</h6>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
                       <a class="collapse-item" href="/usagers/ajouter">Ajouter un Usager</a>
                    <?php } ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
                       <a class="collapse-item" href="/usagers/ajouter">Ajouter un Usager</a>
                    <?php } ?>
                    
                    <a class="collapse-item" href="/usagers/liste_usagers">Lister les Usagers</a>

                   
                </div>
            </div>
        </li>


  <!-- Nav Item Archives - Pages Collapse Menu -->
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-archive"></i>
                <span>EMPRUNTS</span>
            </a>
            <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contennu Emprunt:</h6>
                  
                    <a class="collapse-item" href="/archives/emprunter">Liste des Pièces</a>
                    <a class="collapse-item" href="/archives/liste_emprunts_valide"> Pièces Deposées</a>
                    <a class="collapse-item" href="/archives/liste_emprunts_pending">Pièces Empruntés</a>
                    <a class="collapse-item" href="/archives/stats_emprunts">Stats Emprunts </a>

                   
                </div>
            </div>
        </li>
     <?php } ?>

      <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>

         <!-- Nav Item - Pages Collapse Menu Role -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoj" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>ATTRIBUTION R&Ocirc;LE</span>
            </a>
            <div id="collapseTwoj" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu Role:</h6>
                     <a class="collapse-item" href="/users/attribuer_roles">Attribuer un r&ocirc;le</a>
                    <a class="collapse-item" href="/roles/ajouter">Ajouter r&ocirc;le</a>
                                        
                    <a class="collapse-item" href="/roles/liste_roles">Lister les r&ocirc;les</a>

                   
                </div>
            </div>
        </li>
<?php } ?>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            UTILISATEURS
        </div>
    <!-- Nav Item - Pages Collapse Menu Role -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoje" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>USERS</span>
            </a>
            <div id="collapseTwoje" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contenu Users:</h6>
                    <?php if(isset($_SESSION['user']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){?>
                        
                     <a class="collapse-item" href="/users/register">Créer un utilisateur</a>

                     <a class="collapse-item" href="/users/liste_users">liste utilisateurs</a>
                       <!--<a class="collapse-item" href="/users/signature">Signature</a> -->
                     <?php  }?>
                     <a class="collapse-item" href="/users/users_active">Utilisateur Activé</a>
                      <a class="collapse-item" href="/users/users_attente">Utilisateur en attente</a>
                     
                   
                </div>
            </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>MON COMPTE</span>
            </a>


            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login:</h6>
                    
                    <?php if(isset($_SESSION['user'])): ?>
                        <a class="collapse-item" href="/users/change_password/<?=$_SESSION['user']['id'];?> ">Modifier mot de passe</a>
                        <a class="collapse-item" href="/users/logout">Se Deconnecter</a>
                    <?php else: ?>
                     
                    <a class="collapse-item" href="login.php">Se Connecter</a>
                    <a class="collapse-item" href="register.php">S'inscrire</a>
                    <a class="collapse-item" href="forgot-password.php">Mot de passe oublié</a>
                    <div class="collapse-divider"></div>

                </div>
            </div>
            <?php endif; ?>
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->

                <form method="post" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 lg" placeholder="Entrer le numéro du Document..." aria-label="Search" name="recherche" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>




                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                         <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <h2 class="btn btn-primary">Bonjour <?= $_SESSION['user']['nom']." ".$_SESSION['user']['prenom']; ?></h2>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/users/change_password/<?=$_SESSION['user']['id'];?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Changer de mot de passe
                            </a>
                            <!--
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/users/logout" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                D&eacute;connexion
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

  <?php  

//var_dump($_SESSION['user']);
if(Form::hasFlash()){
foreach(Form::getFlash() as $type => $message):  ?>

                    <div class="alert alert-<?= $type;?>">
                      <?= $message; ?>
                    </div>
                  <?php endforeach;
}


    if(isset($_POST['recherche']) && !empty($_POST['recherche']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')):
         $user = new UsersModel;
        $userss = $user->requete('SELECT rl_types.id_type FROM users,categories,rl_types WHERE users.id = rl_types.id_user AND categories.id = rl_types.id_type AND users.id=? GROUP BY rl_types.id_type',[$_SESSION['user']['id']])->fetchAll();
      // var_dump($userss); exit;
        foreach ($userss as $users) :
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.reference LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND c.id=t.id_cat AND dos.id=d.id_dos AND d.id_cat=? GROUP BY d.reference";
            $go = strtoupper("%".$_POST['recherche']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type]);
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
           
?>

<h2>RESULTAT DE LA RECHERCHE</h2>

<table class="table table-bordered table-striped" id="dataTable6" data-order="[[ 3, &quot;desc&quot; ]]" width="100%" cellspacing="0">
                        <caption></caption>
<thead>
        <tr>
         <th>Référence Pièce</th>
        <th>Dossier</th>
        <th>Domaine</th>
        <th>Typologie</th>  
        <th>Usager</th> 
        <th>Créé le</th>    
        <th>Modifié le</th> 
        <th width="13%">Action</th>
        </tr>
</thead>
    <tbody>
<?php
                foreach($result as $result1){?>


            <tr>
                <<td><?=$result1->reference;?></td>
                <td><?=$result1->dossier;?></td>
                <td><?=$result1->designat;?></td>
                <td><?=$result1->typ;?></td>
                <td><?=$result1->usager;?></td>
                <td><?= $result1->date_creation_doc;?></td>
                <td><?= $result1->update_at;?></td>
                <td width="5%">
                  
                    <a href="/documents/details/<?=$result1->id_doc;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a>
                </td>
            </tr>
      

        
    

               <?php }
       ?>

</tbody>

</table>
       <?php    
endforeach;
endif;

 


 //<!--  Recherche pour users simple -->

   if(isset($_POST['recherche']) && !empty($_POST['recherche']) && $_SESSION['user']['roles'] =='ROLE_USER'):
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag, DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND c.id= t.id_cat AND d.actif=? AND d.reference LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['recherche']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
           
?>

<h2>RESULTAT DE LA RECHERCHE: <?= $_REQUEST['recherche']; ?></h2>

<table class="table table-bordered table-striped" id="dataTable8" data-order="[[ 1, &quot;desc&quot; ]]" width="100%" cellspacing="0">
                        <caption></caption>
<thead>
        <tr>
        <th>Référence Pièce</th>
        <th>Dossier</th>
        <th>Domaine</th>
        <th>Typologie</th>  
        <th>Usager</th> 
        <th>Créé le</th>    
        <th>Modifié le</th> 
        <th width="13%">Action</th>
        </tr>
</thead>
    <tbody>
<?php
                foreach($result as $result1){?>


            <tr>
                <td><?=$result1->reference;?></td>
                <td><?=$result1->dossier;?></td>
                <td><?=$result1->designat;?></td>
                <td><?=$result1->typ;?></td>
                <td><?=$result1->usager;?></td>
                <td><?= $result1->date_creation_doc;?></td>
                <td><?= $result1->update_at;?></td>
                <td width="5%">
                  
                    <a href="/documents/details/<?=$result1->id_doc;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a>
                </td>
            </tr>
      

        
    

               <?php }
       ?>

</tbody>

</table>
       <?php    

endif;

 ?>


	<?= $contenu; ?>


  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Archives-sonapie <?= date("Y"); ?> By <a href="">KAMIS</a></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pret &agrave; quitter?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Cliquez sur "D&eacute;connexion" si vous souhaiter mettre fin &agrave; votre session en cours.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="/users/logout">D&eacute;connexion</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
  $('#REFERENCE,#TYPES,#DEBUT,#FIN,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS,#CONT').hide();
  $('#CRITERE').on('change', function() 
  {
    var $val=$('.critere').val();
    if($val==1)
    {
          $('#REFERENCE').show();
      $('#TYPES,#DEBUT,#FIN,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS,#CONT').hide();
    }
    else if($val==2)
    {
      $('#TYPES').show();
      $('#REFERENCE,#DEBUT,#FIN,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
        $('#category_id').on('change', function() 
  {
    var $val1=$('.single').val();
    if($val1==19)
    {
          $('#CONT').show();
      $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
     
    }else if($val1==20){
          $('#CONT').show();
          $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
    }
    });
    }
    else if($val==3)
    {
      $('#TYPES,#DEBUT,#FIN').show();
            $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
            $('#category_id').on('change', function() 
  {
    var $val1=$('.single').val();
    if($val1==19)
    {
          $('#CONT').show();
      $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
     
    }else if($val1==20){
          $('#CONT').show();
          $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
    }
    });
    }
    else if($val==4)
    {
      $('#REGISTER').show();
      $('#TYPES,#DEBUT,#FIN,#SERVICES,#REFERENCE,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
    }
    else if($val==5)
    {
      $('#SERVICES').show();
      $('#TYPES,#DEBUT,#FIN,#REGISTER,#REFERENCE,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
    }
    else if($val==6)
    {
      $('#NATURES,#SERVICES1').show();
      $('#TYPES,#DEBUT,#FIN,#REGISTER,#REFERENCE,#NOM,#SERVICES,#USAGERS').hide();
    }
    else if($val==7)
    {
      $('#DEBUT,#FIN').show();
      $('#TYPES,#SERVICES,#REFERENCE,#NATURES,#REGISTER,#NOM,#SERVICES1,#USAGERS').hide();
    }
    else if($val==8)
    {
      $('#USAGERS').show();
      $('#TYPES,#SERVICES,#REFERENCE,#NATURES,#REGISTER,#FIN,#DEBUT,#SERVICES1,#NOM').hide();
    }
  });
});




</script>
<script type="text/javascript">
   /* $(document).ready(function(){
  $('#CONT').hide();
  $('#category_id').on('change', function() 
  {
    var $val1=$('.single').val();
    if($val1==19)
    {
          $('#CONT').show();
      $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
     
    }else if($val1==20){
          $('#CONT').show();
          $('#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
    }else{
        $('#CONT,#REFERENCE,#SERVICES,#REGISTER,#NATURES,#NOM,#SERVICES1,#USAGERS').hide();
    }
});
});*/
</script>


<!--

<script src="/js/app.js"></script>
<script src="/vendor/jquery/jquery.min.js"></script>
-->
<!-- Page level plugins -->


<script src="/js/monselect.js"></script>
<script src="/vendor/chart.js/Chart.min.js"></script>


<!-- Bootstrap core JavaScript-->
<script src=""></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="/js/demo/chart-area-demo.js"></script>
<script src="/js/demo/chart-pie-demo.js"></script>

<!-- Page level custom scripts -->


<!-- Page level plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/js/demo/datatables-demo.js"></script>

<script src="/js/script.js"></script>


<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
-->
 


  

 <script>
    //liste choix typo
$(document).ready(function(){
  $('#ANL1,#ANL2,#ANL3,#ANL4,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
  $('#type').on('change', function() 
  {
    var $val=$('.types').val();
    if($val==1)
    {
          $('#ANL2').show();
      $('#ANL1,#ANL3,#ANL4,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==2)
    {
      $('#ANL3').show();
      $('#ANL1,#ANL2,#ANL4,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==3)
    {
      $('#ANL2').show();
            $('#ANL1,#ANL3,#ANL4,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==4)
    {
      $('#ANL1').show();
      $('#ANL2,#ANL3,#ANL4,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==5)
    {
      $('#ANL4').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==6)
    {
      $('#ANL4').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION2,#CESSION3,#CESSION4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==7)
    {
      $('#CESSION4').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION2,#CESSION3,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==8)
    {
      $('#CESSION2').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION4,#CESSION3,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
     else if($val==9)
    {
      $('#CESSION3').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
     else if($val==20)
    {
      $('#BAUX1').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
      else if($val==19)
    {
      $('#BAUX2').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX3,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
      else if($val==18)
    {
      $('#BAUX3').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX4,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
      else if($val==17)
    {
      $('#BAUX4').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX5,#BAUX5,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
      else if($val==21)
    {
      $('#BAUX5').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#RESS1,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }

       else if($val==14)
    {
      $('#RESS1').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==15)
    {
      $('#RESS2').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS1,#RESS3,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==16)
    {
      $('#RESS3').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS1,#RESS4,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==12)
    {
      $('#RESS4').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS1,#RESS5,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==11)
    {
      $('#RESS5').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS1,#RESS6,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==13)
    {
      $('#RESS6').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS5,#RESS1,#RESS7,#RESS8,#COURRIER').hide();
    }
    else if($val==10)
    {
      $('#RESS7').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS1,#RESS8,#COURRIER').hide();
    }
    else if($val==22)
    {
      $('#COURRIER').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS1,#RESS8,#RESS7').hide();
    }
     else if($val==23)
    {
      $('#COURRIER').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS1,#RESS8,#RESS7').hide();
    }
    else{
      $('#RESS8').show();
      $('#ANL1,#ANL3,#ANL2,#CESSION1,#CESSION3,#CESSION4,#CESSION2,#ANL4,#BAUX1,#BAUX2,#BAUX3,#BAUX4,#BAUX5,#RESS2,#RESS3,#RESS4,#RESS5,#RESS6,#RESS1,#RESS7,#COURRIER').hide();
      
    }
  });
});


</script>

 <script>
    //test usager
$(document).ready(function(){
  $('#entreprise,#particulier').hide();
  $('#usagers').on('change', function() 
  {
    var $val=$('.usager').val();
    if($val==1)
    {
          $('#entreprise').show();
      $('#particulier').hide();
    }
    else if($val==2)
    {
      $('#particulier').show();
      $('#entreprise').hide();
    }
      });
});

</script>
 <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
</body>

</html>








 
 
