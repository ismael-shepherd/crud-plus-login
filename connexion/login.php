<?php
$erreur = null;
$password = '$2y$12$SbNCBQGLRJ2NTreX.tEde.D4BUX5hVPwZP3OnBXjKbZyXSPcDxxgq';
if(!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    if($_POST['pseudo'] === 'Jhon' && password_verify($_POST['motdepasse'], $password)) {
       session_start();
       $_SESSION['connecte'] = 1;
       header('Location: ../connexion/dashboard.php');
    } else {
       $erreur = "Identifiants incorrects";
    }
}

require_once '../connexion/auth.php';
if(est_connecte()) {
    header('Location: ../connexion/dashboard.php');
}


?>

<?php if($erreur): ?>
 <div class="alert alert-danger">
 <?= $erreur ?>
 </div>
<?php endif ?>

<form action="" method="POST">
 <div class="form-group">
  <input class="form-control" type="text" name="pseudo" placeholder="Nom d'utilisateur">
 </div>
 <div class="form-group">
 <input class="form-control" type="password" name="motdepasse" placeholder="Votre mot de passe">
 </div>
 <button type="submit" class="btn btn-primary">Valider</button>
</form>

