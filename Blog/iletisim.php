<?php 

require_once '../Admin/pages/inc-functions.php'; 
if(@$_POST["submit"]){
  $ad = htmlspecialchars($_POST["name"],ENT_QUOTES,'UTF-8');
  $email = htmlspecialchars($_POST["email"],ENT_QUOTES,'UTF-8');
  $konu = htmlspecialchars($_POST["konu"],ENT_QUOTES,'UTF-8');
  $mesaj = htmlspecialchars($_POST["message"],ENT_QUOTES,'UTF-8');

  $ekle = $db -> prepare("INSERT INTO `iletisim` (`AdSoyad`,`Mail`,`Konu`,`Mesaj`) values (:p1,:p2,:p3,:p4)");
  $ekle -> bindValue(":p1",$ad,PDO::PARAM_STR);
  $ekle -> bindValue(":p2",$email,PDO::PARAM_STR);
  $ekle -> bindValue(":p3",$konu,PDO::PARAM_STR);
  $ekle -> bindValue(":p4",$mesaj,PDO::PARAM_STR);


  if($ekle-> execute()){

    header("Location: iletisim.php?i=basarili");
  }
  else{

    header("Location: iletisim.php?i=hata");

  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>İletişim</title>

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
  <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>İletişim</h1>
            <span class="subheading">Bizimle iletişime geçin...</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <?php
          if(@$_GET["i"] == "basarili"){

            echo '<p style ="font-family:verdana" class="text-default alert alert-success"><i class="fa fa-check-circle"> Mesajınız başarıyla gönderildi.</i></p>';

           }

          elseif(@$_GET["i"] == "hata"){

            echo '<p style ="font-family:verdana" class="text-default alert alert-danger"><i class="fa fa-check-circle"> Mesaj gönderilirken hata oluştu.</i></p>';

           } 
           
           ?>

       <p>Lütfen gerekli bilgileri eksiksiz doldurunuz. Size en kısa zamanda dönüş yapacağız.</p>

        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form method = "POST">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Ad-Soyad</label>
              <input type="text" class="form-control" placeholder="Ad-Soyad" name="name" required data-validation-required-message="Lütfen Ad-Soyad bilgilerinizi giriniz.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Mail Adresi</label>
              <input type="email" class="form-control" placeholder="Mail Adresi" name="email" required data-validation-required-message="Lütfen Mail Adresi bilginizi giriniz.">
              <p class="help-block text-danger"></p>
            </div>
          </div>      
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Konu</label>
              <input type="text" class="form-control" placeholder="Konu" name="konu">
              <p class="help-block text-danger"></p>
            </div>
          </div>         
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Mesaj</label>
              <textarea rows="5" class="form-control" placeholder="Mesaj" name="message" required data-validation-required-message="Lütfen mesajınızı giriniz."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <input type="submit" name="submit" class = "btn btn-primary" value = "Gönder">      
          
          
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php require 'includes/inc-footer.php'; ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <!-- <script src="js/contact_me.js"></script> -->

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
