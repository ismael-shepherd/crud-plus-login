<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>
<ul class="navbar-nar">
      <?php if(est_connecte()): ?>
       <li class="nav-item"><a class="nav-link" href="../logout.php">Se déconnecter</a></li>
       <li class="nav-item"><a class="nav-link" href="../connexion/dashboard.php">Retourner sur le dashboard</a></li>
      <?php endif ?>
      </ul>
</body>
</html>