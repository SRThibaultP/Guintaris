<?php
include('config.php');
if(isset($_SESSION['persoID']))
{
    unset($_SESSION['persoID']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <a href="index.php">acceuil</a>
    <a href="espaceuser.php"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
    <a href="login.php">deconnexion</a> <br><br>

<?php
$req = mysqli_query($link, 'select nom, id from personnage where Joueur_personnage = '.$_SESSION['userid'].'');
//$req = mysqli_query($link,'select username from users');

while($ligne = mysqli_fetch_array($req)){

echo '<a href="unperso.php?idperso='.$ligne['id'].'">'.$ligne['nom'].'</a> <br/>';
}
?>

</body>
</html>