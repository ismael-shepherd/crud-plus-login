<?php
require_once '../connexion/auth.php';
forcer_utilisateur_connecte();
require '../partials/header.php';
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
</head>
<body class="p-5">


<!--MESSAGE-->
<?php require '../CRUD/process.php'; ?>

<?php

if(isset($_SESSION['message'])): ?>

<div class="alert alert-<?= $_SESSION['msg_type'] ?>">

<?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>
</div>
<?php endif ?>





<!--AJOUT DANS LA BDD-->
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    //pre_r($result);
    ?>

<div class="row justify-content-center">
     <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Image</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
    <?php
        while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['image'] ?></td>
            <td>
             <a class="btn btn-primary" href="dashboard.php">Ajouter</a>
             <a class="btn btn-warning" href="detail.php?details=<?= $row['id'] ?>">Détails</a>
             <a class="btn btn-info" href="dashboard.php?edit=<?= $row['id'] ?>">Edit</a>
             <a class="btn btn-danger" href="../CRUD/process.php?delete=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile ?>
     </table>
    </div>


<!--FUNCTION DEMPER-->
    <?php
    function pre_r( $array ){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

?>

<section class="form1">
  <div class="container">
    
 </div>
 </section>

 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Enregistrer un dossier
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CRUD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../CRUD/process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
     <div class="form-group">
        <input class="form-control" type="text" name="name" placeholder="Entrez votre nom" value="<?php echo $name; ?>" required>
     </div>
     <div class="form-group">
        <input class="form-control" type="text" name="location" placeholder="Entrez votre ville" value="<?php echo $location; ?>" required>
     </div>
     <div class="form-group">
        <input class="form-control" type="file" name="file" value="<?php echo $image; ?>">
     </div>
        <?php
        if($update == true):
        ?>
            <button class="btn btn-info" type="submit" name="update">Mettre a jour</button>
        <?php else: ?>
            <button class="btn btn-primary" type="submit" name="save">Valider</button>
        <?php endif ?>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>