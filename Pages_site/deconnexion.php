<?php
session_start();
session_destroy();
session_start();
$_SESSION['champ_vide']=0;
header('Location: ./Accueil.php')
?>