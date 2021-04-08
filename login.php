<?php
//Cette page permet aux utilisateurs de se connecter ou de se deconnecter
include('config.php');
if(isset($_SESSION['username']))
{
	unset($_SESSION['username'], $_SESSION['userid']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>deconnexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">
            <p>vous avez été deconeté</p>
            <a href="index.php">acceuil</a>
        </div>
    </div>

    
</body>
</html>

<?php
}
else{
if(isset($_POST['username'], $_POST['password']))
{
    if(get_magic_quotes_gpc())
    {
        $username = mysqli_real_escape_string($link,stripslashes($_POST['username']));
        $password = stripslashes($_POST['password']);
    }
    else
    {
        $username = mysqli_real_escape_string($link,$_POST['username']);
        $password = $_POST['password'];
    }
    $req = mysqli_query($link,'select password,id from joueur where nom="'.$username.'"');
    echo 'select password,id from joueur where nom="'.$username.'"';
    $dn = mysqli_fetch_array($req);
    if($dn['password']==$password and mysqli_num_rows($req)>0)
    {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['userid'] = $dn['id'];
        
        //ferme la page et ouvre la page d'index
        header("location: index.php");
        exit;
        ?>
    <?php
    }
    else
    {
        $message = 'La combinaison que vous avez entré n\'est pas bonne.';
    }
}    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<body>
    <a href="<?php echo $url_home; ?>">Index du Forum</a>
    <?php 
    if(isset($message)){
        echo '<p>'.$message.'<p>';
    }
    ?>   
     <form action="login.php" method="post">
        Veuillez entrer vos identifiants pour vous connecter:<br />
        
        
        <div class="login">
            <label for="username">Nom dutilisateur</label><input type="text" name="username" id="username"/><br />
            <label for="password">Mot de passe</label><input type="password" name="password" id="password" /><br />
            <input type="submit" value="Connection" />
		</div>
    </form>
</div>
<?php
}
?>
</body>
</html>