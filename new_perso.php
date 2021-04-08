
<?php
include('config.php');

if(isset($_POST['nom'])&& $_POST['nom'] != ""){
    $nom = addslashes($_POST['nom']);
    if ($_POST['niveau'] != ""|| $_POST['pv'] != ""|| $_POST['pm'] != ""|| $_POST['pc'] != ""){
        if ( $_POST['constitution'] != ""|| $_POST['force'] != ""|| $_POST['dexterite'] != ""|| $_POST['foi'] != ""|| $_POST['intelligence'] != ""||  $_POST['charisme']!= ""){
            $req = mysqli_query($link, 'select id from RACE where libelle = "'.$_POST['race'].'"');
            $ligne = mysqli_fetch_array($req);
            $race = $ligne['id'];
            $req = mysqli_query($link, 'select id from classe where libelle = "'.$_POST['classe'].'"');
            $ligne = mysqli_fetch_array($req);
            $classe = $ligne['id'];
            mysqli_query($link, 'insert into personnage(Joueur_personnage, nom, race_personnage, classe_personnage, niveau,pvMax, pv, pmMax, pm, pcMax, pc, constitution, dexterite, force_,foi , inteligence, charisme ) values("'.$_SESSION['userid'].'","'.$nom.'","'.$race.'", "'.$classe.'" ,"'.$_POST['niveau'].'", "'.$_POST['pv'].'", "'.$_POST['pv'].'", "'.$_POST['pm'].'", "'.$_POST['pm'].'", "'.$_POST['pc'].'", "'.$_POST['pc'].'", "'.$_POST['constitution'].'", "'.$_POST['force'].'", "'.$_POST['dexterite'].'", "'.$_POST['foi'].'", "'.$_POST['intelligence'].'",  "'.$_POST['charisme'].'")');
            $req = mysqli_query($link, 'select id from personnage where nom = "'.$_POST['nom'].'" AND Joueur_personnage = "'.$_SESSION['userid'].'";');
            $ligne = mysqli_fetch_array($req);
            $idperso = $ligne['id'];
            for($i = 1; $i<= 7; $i++){
                mysqli_query($link, 'insert into armure_personnage VALUES("'.$idperso.'", "12", "'.$i.'" , null);');
            }
            for($i = 1; $i<= 3; $i++){
                mysqli_query($link, 'insert into arme_joueur VALUES("'.$idperso.'", "'.$i.'", "17", null);');
                }

            header("location: index.php");
            exit;
        }
        else{
            $mess =  'constitution, force, dexterite, foi, intelligence,  charisme';
        }
    }
    else{
        $mess = "pv, pc, pm";
    }
    }
else{

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

    <a href= "espaceuser.php"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
    <a href = "login.php">deconnexion</a>
	<a href="index.php">acceuil</a>
    <?php
    if(isset($mess)){
        echo '<p>'.$mess.'</p>';
    }
    ?>
    
    <form action="" method="post">
        <label for="nom">nom</label>
        <input type="text" name="nom"> <br/>
        <label for="race">race</label>
        <select name="race" id="">
        <option value="Norsalme">Norsalme</option>
        <option value="Sylfrage">Sylfrage</option>
        <option value="Drogins">Drogins</option>
        <option value="Progniris">Progniris</option>
        <option value="Jardafolc">Jardafolc</option>
        <option value="Citrinzi">Citrinzi</option>
        <option value="Firmalne">Firmalne</option>
        <option value="Phalmagare">Phalmagare</option>
        </select>
        <br/>
        <label for="classe">classe</label>
        <select name="classe" id="">
        <option value="Guerriers">Guerriers</option>
        <option value="Clerc">Clerc</option>
        <option value="Herboriste">Herboriste</option>
        <option value="Mage">Mage</option>
        <option value="Rodeur">Rôdeur</option>
        <option value="Pretre">Prêtre</option>
        <option value="Ingenieur">Ingénieur</option>
        <option value="Assassin">Assassin</option>
        </select> <br/>
        <label for="niveau">Niveau</label>
        <input type="number" name="niveau" id="">
        <label for="pv">PV</label>
        <input type="number" name="pv" id="">
        <label for="pm">PM</label>
        <input type="number" name="pm" id="">
        <label for="pc">PC</label> 
        <input type="number" name="pc" id=""> <br/>
        <label for="constitution">Constitution</label>
        <input type="number" name="constitution" id=""> <br/> 
        <label for="force">Force</label>
        <input type="number" name="force" id=""> <br/>
        <label for="dexterite">Dexterite</label>
        <input type="number" name="dexterite" id=""> <br/>
        <label for="foi">Foi</label>
        <input type="number" name="foi" id=""> <br/>
        <label for="intelligence">Intelligence</label>
        <input type="number" name="intelligence" id=""> <br/>
        <label for="charisme">Charisme</label>
        <input type="number" name="charisme" id=""> <br/>
        <input type="submit" value="Créer">
    </form>
</body>
</html>