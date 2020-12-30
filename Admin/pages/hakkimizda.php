<?php require_once 'inc-functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hakkımızda</title>

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

if(@$_POST["submit"]){

    $sil = $db->prepare("DELETE FROM `hakkımızda`");
    $sil ->execute();

    $icerik = htmlspecialchars($_POST["aciklama"],ENT_QUOTES,'UTF-8');

    $ekle = $db->prepare("INSERT INTO `hakkımızda` (`Metin`) values (:icerik)");
    $ekle -> bindValue(":icerik",$icerik,PDO::PARAM_STR);
    if($ekle->execute()){
        header("Location: blog.php?i=eklendi");
    }
    else{
        header("Location: blog.php?i=hata");
    }
}

$cek = $db->prepare("SELECT * FROM `hakkımızda` ORDER BY `ID` DESC LIMIT 1");
$cek->execute();
$row = $cek->fetch(PDO::FETCH_ASSOC);

?>
    <div id="wrapper">

        <?php require_once 'inc-menu.php';?>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hakkımızda</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href = "anasayfa.php"><i class="fa fa-arrow-circle-left" style="color:#732258;"></i> Geri<a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action = "" role="form" method = "POST">
                                        <div class="form-group">
                                            <textarea class="form-control" name = "aciklama" id = "MyTextArea"rows="40" placeholder="Metin..."><?= $row["Metin"] ?></textarea>
                                        </div>           
                                        <input type="submit" name = "submit" value = "Kaydet" class="btn btn-primary">   
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
