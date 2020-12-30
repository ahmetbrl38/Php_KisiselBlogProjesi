<?php
header("Content-Type: text/html charset=utf-8");
//error_reporting(0);
setlocale(LC_ALL,'tr_TR.UTF-8','tr-TR','tr','turkish');


// ***Veritabanı Bağlantısı ***
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "blogsitesi";

try{

    $db = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword);

}
catch(PDOException $e){
    echo $e->getMessage();
}
$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
// ***Veritabanı Bağlantısı ***

define("_URL","http://localhost/");

?>