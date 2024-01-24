<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Supprimer le Disque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
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

    if (isset($_GET['disc_id'])) {
        $disc_id = $_GET['disc_id'];

        $sql = "SELECT disc_title FROM disc WHERE disc_id = :disc_id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":disc_id", $disc_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $titre = $row['disc_title'];

                echo '<h1>Supprimer le Disque</h1>';
                echo '<p>Êtes-vous sûr de vouloir supprimer le disque "' . $titre . '" ?</p>';
                echo '<form action="Scripts/delete_script.php" method="POST">';
                echo '<input type="hidden" name="disc_id" value="' . $disc_id . '">';
                echo '<button type="submit" class="btn btn-danger">Supprimer</button>';
                echo '<a class="btn btn-secondary" href=details.php?disc_id=' . $disc_id . '">Annuler</a>';
                echo '</form>';
            } else {
                echo "Aucun enregistrement trouvé pour cet ID de disque.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "ID de disque non spécifié.";
    }

    $conn = null;
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>