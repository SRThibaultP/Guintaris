<?php
include('config.php');
if(isset($_POST['changevalue'])){
    mysqli_query($link, 'UPDATE personnage
    set niveau = "'.$_POST['niveau'].'",
    pvMax = "'.$_POST['pv'].'",pmMax = "'.$_POST['pm'].'",pcMax = "'.$_POST['pc'].'",
    constitution = "'.$_POST['constitution'].'",dexterite = "'.$_POST['dexterite'].'",force_ = "'.$_POST['force_'].'",
    charisme = "'.$_POST['charisme'].'",inteligence = "'.$_POST['inteligence'].'",foi = "'.$_POST['foi'].'" 
    WHERE id = "'.$_SESSION['persoID'].'";');

    header("location: unperso.php?idperso=".$_SESSION['persoID']);
        exit;
}

$req = mysqli_query($link, 'SELECT niveau,pvMax,pmMax,pcMax,constitution,dexterite,force_,charisme,inteligence,foi 
FROM personnage WHERE id = "'.$_SESSION['persoID'].'";');
$lignePerso = mysqli_fetch_array($req);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="index.php">acceuil</a>
    <a href="unperso.php?idperso=<?php echo $_SESSION['persoID']?>">retour</a>
<form action="levelup.php" method="post">
    <label for="niveau">niveau</label>
    <input type="number" name="niveau" value="<?php echo $lignePerso['niveau']?>" size="2">
    
    
    <label for="pv">pv</label>
    <input type="number" name="pv" value="<?php echo $lignePerso['pvMax']?>" size="2">
    <label for="pc">pc</label> <input type="number" name="pc" value="<?php echo $lignePerso['pcMax']?>" size="2">
    <label for="pm">pm</label><input type="number" name="pm" value="<?php echo $lignePerso['pmMax']?>" size="2"> <br>

    <label for="constitution">constitution</label>
    <input type="number" name="constitution" value="<?php echo $lignePerso['constitution']?>" size="2">
    
    <label for="dexterite">dexterite</label>
    <input type="number" name="dexterite" value="<?php echo $lignePerso['dexterite']?>" size="2">

    <label for="force_">force_</label>
    <input type="number" name="force_" value="<?php echo $lignePerso['force_']?>" size="2">

    <label for="charisme">charisme</label>
    <input type="number" name="charisme" value="<?php echo $lignePerso['charisme']?>" size="2">

    <label for="inteligence">inteligence</label>
    <input type="number" name="inteligence" value="<?php echo $lignePerso['inteligence']?>" size="2">

    <label for="foi">foi</label>
    <input type="number" name="foi" value="<?php echo $lignePerso['foi']?>" size="2">

    <input type="hidden" name="changevalue" value="1">
    <br><input type="submit" value="Modifier">
</form>
</body>
</html>