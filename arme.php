<?php
include("config.php");
if (isset($_POST['arme1'])){
    update_arme($link, $_POST['arme1'], $_POST['effetArme1'], $num = 1);
    update_arme($link, $_POST['arme2'], $_POST['effetArme2'], $num = 2);
    update_arme($link, $_POST['arme3'], $_POST['effetArme3'], $num = 3);
}
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
    <form action="" method="post">
        <!------------------------------ PLASTRON ------------------------------------->
        <label for="arme1">Arme N° 1</label>
        <select name="arme1" id=""><?php $num = 1; option($link, $num); ?></select>
        <label for="effetArme1">effet</label>
        <input type="text" name="effetArme1" id="" value= "<?php default_value_effet($link, $num)?>">  <br>
        <!------------------------------ JAMBIERE ------------------------------------->
        <label for="arme2">Arme N°2</label>
        <select name="arme2" id=""><?php $num++; option($link, $num); ?></select>
        <label for="effetArme2">effet</label>
        <input type="text" name="effetArme2" id="" value= "<?php  default_value_effet($link, $num)?>"> <br>
        <!------------------------------ CASQUE ------------------------------------->    
        <label for="arme3">Arme N°3</label>
        <select name="arme3" id=""><?php $num++; option($link, $num); ?></select>
        <label for="effetArme3">effet</label>
        <input type="text" name="effetArme3" id="" value= "<?php default_value_effet($link, $num)?>"> <br>
        
        <input type="submit" value="modifier">
    </form>

<?php
    function option($link, $numero){
        $types = array(1=>'Arc', 'Arbalete', 'Dague de lancee', 'Fusil', 'Pistolet','Fronde' , 'Hachette', 'Masse', 'Epee', 'Faucille', 'Dague', 'Espadon' , 'Lance' ,'marteau de guerre' ,'Batton' , 'Hache', 'vide');
        $typeUse = default_value_type($link, $numero);            
        
        $trouver = array_search($typeUse, $types, true);
        for($i = 1; $i <= 17; $i++){
            echo '<option value="'.$types[$i].'"';
            if($trouver == $i){
                echo 'selected';
            }
            echo '>'.$types[$i].'</option>'; 
        }
    }

    function default_value_type($link, $numero){
        $req = mysqli_query($link, 'SELECT nom 
        FROM arme, arme_joueur
        WHERE amre = id
        AND perso = "'.$_SESSION['persoID'].'"
        AND numero = "'.$numero.'" ;');
        $ligne = mysqli_fetch_array($req);
        return $ligne['nom'];
    }

    function default_value_effet($link, $numero){
        $req = mysqli_query($link, 'SELECT effet FROM arme_joueur where perso = "'.$_SESSION['persoID'].'" AND numero = "'.$numero.'"');
        $ligne = mysqli_fetch_array($req);
        echo $ligne['effet'];
    }

    function update_arme($link,$nomArme,$effet, $numero){
        
        $req = mysqli_query($link, 'select id from arme where nom = "'.$nomArme.'";');
        $ligne = mysqli_fetch_array($req);
        $idArme = $ligne['id'];
        mysqli_query($link, 'UPDATE arme_joueur 
        SET amre = "'.$idArme.'", effet = "'.$effet.'"
        WHERE perso = "'.$_SESSION['persoID'].'" AND numero = "'.$numero.'";');
    }
?>
</body>
</html>