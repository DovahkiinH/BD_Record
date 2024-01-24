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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["disc_id"])) {
    $disc_id = $_POST["disc_id"];

    $sql = "DELETE FROM disc WHERE disc_id = :disc_id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":disc_id", $disc_id);
        $stmt->execute();

        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

$conn = null;
?>