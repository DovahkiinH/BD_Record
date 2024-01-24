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

    $titre = $_POST["titre"];
    $artisteNom = $_POST["artiste"];
    $annee = $_POST["annee"];
    $genre = $_POST["genre"];
    $label = $_POST["label"];
    $prix = $_POST["prix"];


    $imagePath = "/home/loick/Bureau/Full Stack/BD_Record/assets/img";
    $imageName = $_FILES["image"]["name"];
    $imageTempName = $_FILES["image"]["tmp_name"];
    $imageUploadPath = $imagePath . $imageName;

    move_uploaded_file($imageTempName, $imageUploadPath);

    try {
        if (empty($artisteNom)) {
            echo "Veuillez sélectionner un artiste.";
        } else {
            $sqlArtisteId = "SELECT artist_id FROM artist WHERE artist_name = :artisteNom";
            $stmtArtisteId = $conn->prepare($sqlArtisteId);
            $stmtArtisteId->bindParam(":artisteNom", $artisteNom);
            $stmtArtisteId->execute();
            $rowArtisteId = $stmtArtisteId->fetch(PDO::FETCH_ASSOC);
            $artisteId = $rowArtisteId["artist_id"];

            $sql = "INSERT INTO disc (disc_title, artist_id, disc_year, disc_genre, disc_label, disc_price, disc_picture) VALUES (:titre, :artisteId, :annee, :genre, :label, :prix, :image)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":titre", $titre);
            $stmt->bindParam(":artisteId", $artisteId);
            $stmt->bindParam(":annee", $annee);
            $stmt->bindParam(":genre", $genre);
            $stmt->bindParam(":label", $label);
            $stmt->bindParam(":prix", $prix);
            $stmt->bindParam(":image", $imageName);
            $stmt->execute();


            header("location: ../index.php");
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

$conn = null;
?>