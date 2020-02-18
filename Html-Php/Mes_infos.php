<?php
session_start();


echo $_SESSION['id_user']." ".$_SESSION['nom']." ".$_SESSION['prenom'];

?>