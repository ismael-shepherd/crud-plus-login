<?php

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';
$image = '';


// CONDITION QUI PERMET D'AJOUTER DES ELEMENTS DANS LA BDD
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $image = $_POST['image'];

    $mysqli->query("INSERT INTO data (name, location, image) VALUES ('$name', '$location', '$image')") or die($mysqli->error);

    $_SESSION['message'] = "Tout a bien été sauvegarder !";
    $_SESSION['msg_type'] = "success";

    header('Location: ../connexion/dashboard.php');
}




// CONDITION QUI PERMET DE SUPPRIMER DES ELEMENTS DE LA BDD
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "L'article a bien été supprimer !";
    $_SESSION['msg_type'] = "danger";

    header('Location: ../connexion/dashboard.php');
}


// CONDITION QUI PERMET DE MODIFIER UN ARTICLE
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if(count((array)$result) == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $image = $row['image'];
    }
}





// CONDITION QUI PERMET DE METTRE A JOUR LES ARTICLES
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $image = $_POST['image'];

    $mysqli->query("UPDATE data SET name='$name', location='$location', location='$image' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "L'article a été mise a jour";
    $_SESSION['msg_type'] = "warning";

    header('Location: ../connexion/dashboard.php');
}



// CONDITION POUR POSTER UNE IMAGE
if(isset($_POST['save']) && isset($_FILES['file'])) {
    echo "<pre>";
    print_r($_FILES['file']);
    echo "</pre>";

    $img_name = $_FILES['file']['name'];
    $img_size = $_FILES['file']['size'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

    if($error === 0) {
        if($img_size > 10000000) {
            $em = "Fichier large !!";
        header("Location: ../CRUD/erreur.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "pdf");

            if(in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../CRUD/upload/' .$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //BDD INSERT
                $sql = "INSERT INTO image(image_url) VALUES ('$new_img_name')";
                mysqli_query($mysqli, $sql);
                header("Location: ../connexion/dashboard.php");
            } else {
                $em = "Vous ne pouvez pas upload de fichier de se type !!";
                header("Location: ../CRUD/erreur.php?error=$em");
            }
        }
    } else {
        $em = "Erreur survenue de null part !!";
        header("Location: ../CRUD/erreur.php?error=$em");
    }

} else {
    //header("Location: ../connexion/dashboard.php");
}


