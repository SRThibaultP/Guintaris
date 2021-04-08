<?php
include("config.php");
$id = $_GET['idperso'];
$_SESSION['persoID']= $id;
if(isset($_POST['pointsValue'])){
    $pv = $_POST['pv'];
    $pc = $_POST['pc'];
    $pm = $_POST['pm'];
    //echo 'insert into message( objet, description, destinataire, expediteur , date) values ( null, "'.$text.'", "'.$destinataire.'","'.$_SESSION['userid'].'", "'.time().'")';
    //echo 'select id from message where expediteur = "'.$_SESSION['userid'].'" and date = "'.time().'"';
    //echo 'update message set reponse = '.$ligne['id'].' where id = '.$reponse.'';
    mysqli_query($link, 'update personnage set pv = "'.$pv.'", pc= "'.$pc.'", pm = "'.$pm.'" where id = "'.$id.'"');
    $message  = 'update personnage set pv = "'.$pv.'", pc= "'.$pc.'", pm = "'.$pm.'" where id = "'.$id.'"';
}
$id = $_GET['idperso'];
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<a href="index.php">acceuil</a>
<a href="mesPerso.php">retour</a>
<?php
$reqPerso = mysqli_query($link, 'select * from personnage where id = "'.$id.'"');
$lignePerso = mysqli_fetch_array($reqPerso);
$idrace = $lignePerso['race_personnage'];
$idclasse = $lignePerso['classe_personnage'];
?>

    <h1><?php echo $lignePerso['nom']?></h1>
    <h3>niveau <?php echo $lignePerso['niveau']?></h3>

<?php
$req = mysqli_query($link, 'select libelle from RACE where id = "'.$idrace.'"');
$ligne = mysqli_fetch_array($req);
$race = $ligne['libelle'];
$req = mysqli_query($link, 'select libelle from classe where id = "'.$idclasse.'"');
$ligne = mysqli_fetch_array($req);
$classe = $ligne['libelle'];
?>
    <h3><?php echo $race?></h3>
    <h3><?php echo $classe?></h3>
    <a href="levelup.php">level UP !</a>
<?php
    echo '<form action="unperso.php?idperso='.$_GET['idperso'].'"method="post">'
?>   
        
    <p>pv <input type="number" name="pv" value="<?php echo $lignePerso['pv']?>" size="2">/ <?php echo $lignePerso['pvMax']?></p>
    <p>pc <input type="number" name="pc" value="<?php echo $lignePerso['pc']?>" size="2">/ <?php echo $lignePerso['pcMax']?></p>
    <p>pm <input type="number" name="pm" value="<?php echo $lignePerso['pm']?>" size="2">/ <?php echo $lignePerso['pmMax']?></p>
    <input type="hidden" name="pointsValue" value="true">
    <input type="submit" value="Modifier">
</form>
    <br><br>

    <p>Constitution  <?php echo $lignePerso['constitution']?></p>
    <p>Force  <?php echo $lignePerso['force_']?></p>
    <p>Dexterite  <?php echo $lignePerso['dexterite']?></p>
    <p>Foi  <?php echo $lignePerso['foi']?></p>
    <p>Intelligence  <?php echo $lignePerso['inteligence']?></p>
    <p>Charisme  <?php echo $lignePerso['charisme']?></p>
    <a href="armure.php">armure</a>
<?php
    $req = mysqli_query($link, 'SELECT L.libelle AS loca, T.`type` AS types, A.niveau as niveau, P.effet as effet
    FROM armure A, localisation_armure L, type_armure T, armure_personnage P 
    WHERE A.typ = T.id AND A.localitastion = L.id
    AND P.typ_armure = A.typ
    AND P.loca_armure = A.localitastion
    AND	P.perso = "'.$_SESSION['persoID'].'"
    ORDER BY L.id ASC;');
    $ca = 0;
    echo '4
    <div class="col">';
    echo '<table>
    <tr>
        <th>pièce</th>
        <th>type</th>
        <th>CA</th>
    </tr>';
    while($ligne = mysqli_fetch_array($req)){
        $ca = $ca + $ligne['niveau'];
        echo '<tr>
            <th>'.$ligne['loca'].'</th>
            <th>'.$ligne['types'].'</th>
            <th>'.$ligne['niveau'].'</th>
            <th> '.$ligne['effet'].'</th>
        </tr>';
        }
    echo 'Classe d\'armure'.$ca.'</table>
    </div>
    ';

    $req = mysqli_query($link, 'SELECT numero, nom, degat, de 
    FROM arme, arme_joueur
    WHERE amre = id
    AND perso = "'.$_SESSION['persoID'].'";');
    echo '<a href="arme.php">arme</a>';
    while ($ligne = mysqli_fetch_array($req)){
        echo '<p> amre n°'.$ligne['numero'].' : '.$ligne['nom'].' degat : ' .$ligne['degat'].' -1D '.$ligne['de'];
    }
?>

</body>
</html>