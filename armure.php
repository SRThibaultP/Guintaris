<?php
    $plastron = 'plastron';
    $jambiere = 'jambiere';
    $casque = 'casque';
    $cape = 'cape';
    $anneau = 'anneau';
    $bouclier = 'bouclier';
    $amulette = 'amulette';
    include("config.php");
    if(isset($_POST['setArmure'])){
       update_armure($link, $_POST[$plastron],$plastron, $_POST['effetPlastron']);
       update_armure($link, $_POST[$jambiere],$jambiere, $_POST['effetJambiere']);
       update_armure($link, $_POST[$casque],$casque, $_POST['effetCasque']);

       update_armure($link, $_POST[$bouclier],$bouclier, $_POST['effetCasque']);

       update_armure($link, $_POST[$amulette],$amulette, $_POST['effetAmulette']);
       update_armure($link, $_POST[$anneau],$anneau, $_POST['effetAnneau']);
       update_armure($link, $_POST[$cape],$cape, $_POST['effetCape']);
       header("location: unperso.php?idperso=".$_SESSION['persoID']);
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <a href="index.php">acceuil</a>
    <a href="unperso.php?idperso=<?php echo $_SESSION['persoID']?>">retour</a>
    <form action="armure.php" method="post">
    <input type="hidden" name="setArmure" value="1">
    
        <!------------------------------ PLASTRON ------------------------------------->
        <label for="<?php echo $plastron; ?>">Plastron</label>
        <select name="<?php echo $plastron; ?>" id=""><?php option($link, $plastron); ?></select>
        <label for="effetPlastron">effet</label>
        <input type="text" name="effetPlastron" id="" value= "<?php default_value_effet($link, $plastron)?>">  <br>
        <!------------------------------ JAMBIERE ------------------------------------->
        <label for="<?php echo $jambiere; ?>">Jambière</label>
        <select name="<?php echo $jambiere; ?>" id=""><?php option($link, $jambiere); ?></select>
        <label for="effetJambiere">effet</label>
        <input type="text" name="effetJambiere" id="" value= "<?php default_value_effet($link, $jambiere)?>"> <br>
        <!------------------------------ CASQUE ------------------------------------->    
        <label for="<?php echo $casque; ?>">casque</label>
        <select name="<?php echo $casque; ?>" id=""><?php option($link, $casque); ?></select>
        <label for="effetCasque">effet</label>
        <input type="text" name="effetCasque" id="" value= "<?php default_value_effet($link, $casque)?>"> <br>
        
        <!------------------------------ BOUCLIER ------------------------------------->    
        <label for="<?php echo $bouclier; ?>">bouclier</label>
        <select name="<?php echo $bouclier; ?>" id="">
        <?php option_reduit($link, $cape);?>
        </select>
        <label for="effetBouclier">effet</label>
        <input type="text" name="effetBouclier" id="" value= "<?php default_value_effet($link, $bouclier)?>"> <br>
        <!------------------------------ CAPE ------------------------------------->    
        <label for="<?php echo $cape; ?>">cape</label>
        <select name="<?php echo $cape; ?>" id=""><?php option_reduit($link, $cape);?></select>
        <label for="effetCape">effet</label>
        <input type="text" name="effetCape" id="" value= "<?php default_value_effet($link, $cape)?>"> <br>
        <!------------------------------ ANNEAU ------------------------------------->
        <label for="<?php echo $anneau; ?>">anneau</label>
        <select name="<?php echo $anneau; ?>" id=""><?php option_reduit($link, $anneau);?></select>
        <label for="effetAnneau">effet</label>
        <input type="text" name="effetAnneau" id="" value= "<?php default_value_effet($link, $anneau)?>"> <br>
        <!------------------------------ AMULETTE ------------------------------------->
        <label for="<?php echo $amulette; ?>">amulette</label>
        <select name="<?php echo $amulette; ?>" id=""><?php option_reduit($link, $amulette);?></select>
        <label for="effetAmulette">effet</label>
        <input type="text" name="effetAmulette" id="" value= "<?php default_value_effet($link, $amulette)?>"> <br>
        

       
        <input type="submit" value="modifier">



        <?php
        function option_reduit($link, $locaArmure){
            $typeUse = default_value_type($link, $locaArmure); 
            echo '<option value="Autre"';
            if($typeUse == 'Autre'){
                echo 'selected';
            }
            echo'>Equiper</option> <option value="Enlever"';
            if($typeUse == 'Enlever'){
                echo 'selected';
            }
            echo'>Enlever</option>';
        }
        function option($link, $locaArmure){
            $types = array(1=>'Tissu','Matelassee', 'Cuir','Cuir souple','Cuir cloute','Ecaille','Peaux','Maille legere','Cuirasse','Plate', 'Enlever');
            $typeUse = default_value_type($link, $locaArmure);            
            
            $trouver = array_search($typeUse, $types, true);
            for($i = 1; $i <= 11; $i++){   
                echo '<option value="'.$types[$i].'"';
                if($trouver == $i){
                    echo 'selected';
                }
                echo '>'.$types[$i].'</option>'; 
            }

            
        }

        function default_value_type($link, $libelleLoca){
            $req = mysqli_query($link, 'SELECT T.`type` AS types 
            FROM armure A, localisation_armure L, type_armure T, armure_personnage P 
            WHERE A.typ = T.id AND A.localitastion = L.id
            AND P.typ_armure = A.typ
            AND P.loca_armure = A.localitastion
            AND	P.perso = "'.$_SESSION['persoID'].'"
            AND L.libelle = "'.$libelleLoca.'";');
            $ligne = mysqli_fetch_array($req);
            return $ligne['types'];
        }

        function default_value_effet($link, $libelleLoca){
            $req = mysqli_query($link, 'SELECT P.effet AS eff 
            FROM armure A, localisation_armure L, type_armure T, armure_personnage P 
            WHERE A.typ = T.id AND A.localitastion = L.id
            AND P.typ_armure = A.typ
            AND P.loca_armure = A.localitastion
            AND	P.perso = "'.$_SESSION['persoID'].'"
            AND L.libelle = "'.$libelleLoca.'";');
            $ligne = mysqli_fetch_array($req);
            echo $ligne['eff'];
        }

        function update_armure($link, $post,$localis, $effet){
            $req = mysqli_query($link, 'select id from type_armure where type = "'.$post.'";');
            $ligne = mysqli_fetch_array($req);
            $idType = $ligne['id'];
            $req = mysqli_query($link, 'select id from localisation_armure where libelle = "'.$localis.'";');
            $ligne = mysqli_fetch_array($req);
            $idloca = $ligne['id'];
            mysqli_query($link, 'UPDATE armure_personnage SET typ_armure = "'.$idType.'", effet = "'.$effet.'" WHERE perso = "'.$_SESSION['persoID'].'" AND loca_armure = "'.$idloca.'";');
        }
        ?>
    </form>
</body>
</html>