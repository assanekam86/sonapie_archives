<?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="gestion des archives Sogepie">
  <meta name="author" content="Assanekam">

  <title>Archives - Mot de passe oublié</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-sogepie">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
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
                    <h1 class="h4 text-gray-900 mb-2">Veuillez entrer votre nouveau mot de passe</h1>
                    <p class="mb-4"></p>
                  </div>
                  <form class="user" method="post" action="">

                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Mot de passe ">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="conf_password" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Confirmer mot de passe">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Vérification email
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>

</body>

</html>
<?php 
}else{
    http_response_code(404);
    die("Vous ne pouvez pas acceder a cette page");
    exit;
} ?>