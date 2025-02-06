<?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
    <!DOCTYPE html>
<html lang="fr">

<head>
    <title>ARCHIVE - S'inscrire</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Kamara Assane">



    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="/signature/css/jquery.signature.css">
<script src="/signature/js/jquery.signature.min.js"></script>

<style type="text/css">
   .kbw-signature{width: 40%; height: 150px;}

   #sig canvas{ width: 100% !important; height: auto; }


    @media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
</style>
</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-12 text-center ">
                   <?php
             
          if(Form::hasFlash()){
          foreach(Form::getFlash() as $type => $message):  ?>

                    <div class="alert alert-<?= $type;?>">
                      <?= $message; ?>
                    </div>
                  <?php endforeach;
                }?>
                    <div class="p-5">
                        <div class="text-center">
                            <h1 align="center"><img src="/img/logo.jpg" title="logo SOGEPIE"/></h1>
                            <h1 class="h4 text-gray-900 mb-8">CREER UNE SIGNATURE</h1>
                        </div> 
                        
                      <form action="" method="post">
                          <div class="row">
                              <div class="col-md-12 form-group" >
                                
                                  <div id="sig"></div>
                                  <br>
                                  <button id="clear" class="btn btn-danger bg-lg">Effacer</button>
                                  <textarea id="signature64" name="signed" style="display: none;" class="form-control"></textarea>
                              </div>
                              <button class="btn btn-primary" name="signat">Valider</button>
                          </div>
                      </form>

                      
                        <hr>
                        <!--<div class="text-center">
                            <a class="small" href="forgot-password.php">Mot de passe oublié?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Se Loguer!</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

Core plugin JavaScript
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

Custom scripts for all pages
<script src="/js/sb-admin-2.min.js"></script>-->

<script type="text/javascript"> 
var sig = $('#sig').signature({syncField: '#signature64',syncFormat:'PNG'});
$('#clear').click(function (e){
    e.preventDefault();
    sig.signature('clear');
    $("#signature64").val('');

});
   </script>
</body>

</html>


<?php 
}else{
    http_response_code(404);
    die("Vous ne pouvez pas acceder a cette page");
    exit;
} ?>

