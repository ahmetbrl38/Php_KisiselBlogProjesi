<?php require_once 'inc-functions.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>İçeriği Düzenle</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php 

$id = $_GET["id"];

$cek = $db->prepare("SELECT * FROM `blog` WHERE `ID` = :id");
$cek->bindValue(":id",$id,PDO::PARAM_INT);
$cek->execute();
$row = $cek->fetch(PDO::FETCH_ASSOC);

if(@$_POST["submit"]){
    $baslik = htmlspecialchars($_POST["baslik"],ENT_QUOTES,'UTF-8');
    $altBaslik = htmlspecialchars($_POST["altBaslik"],ENT_QUOTES,'UTF-8');
    $icerik = htmlspecialchars($_POST["icerik"],ENT_QUOTES,'UTF-8');
    $durum = htmlspecialchars($_POST["durum"],ENT_QUOTES,'UTF-8');

    $guncelle = $db->prepare("UPDATE `blog` SET `Baslik` = :baslik ,`Alt_Baslik` = :altBaslik,`Metin` = :icerik,`Durum` = :durum WHERE `ID` = :id");
    $guncelle -> bindValue(":baslik",$baslik,PDO::PARAM_STR);
    $guncelle -> bindValue(":altBaslik",$altBaslik,PDO::PARAM_STR);
    $guncelle -> bindValue(":icerik",$icerik,PDO::PARAM_STR);
    $guncelle -> bindValue(":durum",$durum,PDO::PARAM_INT);
    $guncelle -> bindValue(":id",$id,PDO::PARAM_STR);

    if($guncelle->execute()){
        header("Location: blog.php?g=guncellendi");
    }
    else{
        header("Location: blog.php?g=hata");
    }
}

?>

    <div id="wrapper">

        <?php require_once 'inc-menu.php';?>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Düzenle (<?= $id?>)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href = "blog.php"><i class="fa fa-arrow-circle-left" style="color:#732258;"></i> Geri<a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action ="" method = "POST" enctype = "multiplepart/form-data">                                        
                                        <div class="form-group">
                                            <label>Başlık</label>
                                            <input class="form-control" name = "baslik" value="<?=$row["Baslik"]?>" placeholder="Başlık giriniz...">
                                        </div>
                                        <div class="form-group">
                                            <label>Alt Başlık</label>
                                            <input class="form-control" name = "altBaslik" value="<?=$row["Alt_Baslik"]?>"placeholder="Açıklama giriniz...">
                                        </div>                                       
                                        <div class="form-group">
                                            <label>İçerik</label>
                                            <textarea class="form-control" id = "MyTextArea" name = "icerik" rows="40" placeholder="Metin..."><?= $row["Metin"]?></textarea>
                                        </div>                                       
                                        <div class="form-group">
                                            <label>Durum</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="durum" value="1" 
                                                    <?php echo($row["Durum"] == 1) ? 'checked' : '';?>
                                                    >Yayınlanmış
                                                </label>
                                            </div>                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="durum" value="0"
                                                    <?php echo($row["Durum"] == 0) ? 'checked' : '';?>
                                                    >Taslak
                                                </label>
                                            </div>
                                        </div>               
                                        <input type="submit" name ="submit" value = "Guncelle" class = "btn btn-primary">                        
                                        <button type="reset" class="btn btn-default">Temizle</button>
                                    </form>
                                </div>                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Editör Eklentisi -->
    <script src="../js/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Dil Seçeneği -->
    <script src="../tinymce/js/tinymce/langs/tr.js" referrerpolicy="origin"></script>

    <script>

      tinymce.init({
        selector: '#MyTextArea',
        language: 'tr'
      }); 

    </script>    

</body>

</html>
