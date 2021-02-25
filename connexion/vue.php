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
            </tr>
        </thead>
    <?php
        while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><a href="detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['image'] ?></td>
            
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









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>