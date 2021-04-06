<?php

//On se connecte a la base de donnee
$link =mysqli_connect("localhost", "root", "", "jdr");


//Nom dutilisateur de ladministrateur
$admin='admin';


//Nom du fichier de laccueil
$url_home = 'index.php';

//dossier pour css et image
$design = 'default';

//initialise la session
include('init.php');
?>