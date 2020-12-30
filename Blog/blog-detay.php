<?php 

require_once '../Admin/pages/inc-functions.php';
$id = intval($_GET["id"]);

$cek = $db -> prepare("SELECT * FROM `blog` WHERE `ID` = :id LIMIT 1");
$cek -> bindValue(":id",$id,PDO::PARAM_INT);
$cek -> execute();
$row = $cek ->fetch(PDO::FETCH_ASSOC);

if($row["Durum"] == 0){

  header("Location: index.php");

}


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $row["Baslik"]?></title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

 <?php require 'includes/inc-menu.php';?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/bisikletSurme.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?= $row["Baslik"] ?></h1>
            <h2 class="subheading"><?= $row["Alt_Baslik"] ?></h2>           
            
            </p>
            <p class="post-meta">Admin
            <label>tarafından</label>
            <?= $row["Tarih"]  ?>
            <label>tarihinde yayınlandı.</label>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <?= htmlspecialchars_decode($row["Metin"])?>
        </div>
      </div>
    </div>
  </article>

  <hr>

  <?php require 'includes/inc-menu.php'; ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>