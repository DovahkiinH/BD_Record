<?php

        $servername = "localhost";
        $username = "admin";
        $password = "Afpa1234";
        $dbname = "record";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("La connexion à la base de données a échoué : " . $e->getMessage());
        }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $disc_id = $_POST['disc_id'];
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $genre = $_POST['genre'];
    $label = $_POST['label'];
    $prix = $_POST['prix'];
    $artiste_id = $_POST['artiste'];

    $sql = "UPDATE disc SET disc_title = :titre, disc_year = :annee, disc_genre = :genre, disc_label = :label, disc_price = :prix, artist_id = :artiste WHERE disc_id = :disc_id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":disc_id", $disc_id);
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":annee", $annee);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":label", $label);
        $stmt->bindParam(":prix", $prix);
        $stmt->bindParam(":artiste", $artiste_id);
        $stmt->execute();

        if ($_FILES['image']['error'] == 0) {

            $image_name = $_FILES['image']['name'];

            $image_tmp = $_FILES['image']['tmp_name'];

            move_uploaded_file($image_tmp, "assets/img/" . $image_name);

            $sqlUpdateImage = "UPDATE disc SET disc_picture = :image WHERE disc_id = :disc_id";
            $stmtUpdateImage = $conn->prepare($sqlUpdateImage);
            $stmtUpdateImage->bindParam(":image", $image_name);
            $stmtUpdateImage->bindParam(":disc_id", $disc_id);
            $stmtUpdateImage->execute();
        }

        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

$conn = null;
?>