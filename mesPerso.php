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
</head>
<body>
    <a href="index.php">acceuil</a>
    <a href="espaceuser.php"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
    <a href="login.php">deconnexion</a>

<?php
$req = mysqli_query($link, 'select nom, id from personnage where Joueur_personnage = '.$_SESSION['userid'].'');
//$req = mysqli_query($link,'select username from users');

while($ligne = mysqli_fetch_array($req)){

echo '<a href="unperso.php?idperso='.$ligne['id'].'">'.$ligne['nom'].'</a> <br/>';
}
?>

</body>
</html>