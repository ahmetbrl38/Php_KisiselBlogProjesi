<?php
session_start();
$_SESSION["girisKontrol"] = 0;
unset($_SESSION["girisKontrol"]);
unset($_SESSION["username"]);
header("Location: index.php?i=cikis");
session_destroy();
?>