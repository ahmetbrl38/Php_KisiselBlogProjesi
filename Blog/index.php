<?php 
require_once '../Admin/pages/inc-functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blogify | Blog Your Life</title>

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

 <?php require 'includes/inc-menu.php'; ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blogify'a hoşgeldiniz.</h1>
            <span class="subheading">Developed by Ahmet Yasin Burul</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-16 col-md-10 mx-auto">
       
       <?php
       @$kelime = $_GET["q"];

       //arama yapıldıysa
       if($kelime!= ""){
        echo "<p>Aranan kelime: $kelime | <a href='index.php'>Ana Sayfaya Geri Dön</a></p>";
        $cek = $db ->prepare("SELECT * FROM `blog` WHERE  `Durum` = :durum && `Baslik` LIKE :aranan ORDER BY `ID` DESC");
        $cek -> bindValue(":durum",1,PDO::PARAM_INT);
        $cek -> bindValue(":aranan","%$kelime%",PDO::PARAM_STR);
       }
       //arama yapılmadıysa
       else{

       $cek = $db ->prepare("SELECT * FROM `blog` WHERE `Durum` = :durum ORDER BY `ID` DESC");
       $cek ->bindValue(":durum",1,PDO::PARAM_INT);

      }

       $cek -> execute();

       while($row = $cek ->fetch(PDO::FETCH_ASSOC)){ ?>   

        <div class="post-preview">
          <a href="blog-detay.php?id=<?= $row["ID"] ?>">
            <h2 class="post-title">
              <?= $row["Baslik"]  ?>
            </h2>
            <h3 class="post-subtitle">
            <?= $row["Alt_Baslik"]  ?>
            </h3>
          </a>
          <p class="post-meta">Admin
            <label>tarafından</label>
            <?= $row["Tarih"]  ?>
            <label>tarihinde yayınlandı.</label>
            </p>
        </div>
       <hr>
       <?php } ?>

        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">ÖNCEKİ KAYITLAR &rarr;</a>
        </div>
      </div>
    </div>
  </div>

 <?php require_once 'includes/inc-footer.php';  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>
</html>
