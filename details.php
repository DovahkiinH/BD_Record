<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
        .disque {
            display: flex;
            align-items: center;
        }
        .disque img {
            max-width: 25%;
            height: auto;
        }
        .details {
            flex-grow: 1;
            padding: 0 20px;
        }

    </style>
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


        $sql = "SELECT disc_title, disc_year, disc_picture, disc_genre, disc_label, disc_price, artist_id FROM disc WHERE disc_id = :disc_id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":disc_id", $disc_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $titre = $row['disc_title'];
                $annee = $row['disc_year'];
                $image = $row['disc_picture'];
                $genre = $row['disc_genre'];
                $label = $row['disc_label'];
                $prix = $row['disc_price'];
                $artist_id = $row['artist_id'];

                $sqlArtiste = "SELECT artist_name FROM artist WHERE artist_id = :artist_id";
                $stmtArtiste = $conn->prepare($sqlArtiste);
                $stmtArtiste->bindParam(":artist_id", $artist_id);
                $stmtArtiste->execute();

                if ($stmtArtiste->rowCount() > 0) {
                    $rowArtiste = $stmtArtiste->fetch(PDO::FETCH_ASSOC);
                    $artiste = $rowArtiste['artist_name'];
                } else {
                    $artiste = "Artiste inconnu";
                }

                echo '<h1>Détails du Disque</h1>';
                echo '<div class="disque">';
                echo '<img src="assets/img/' . $image . '" alt="Image du disque">';
                echo '<div class="details">';
                echo '<b>' . $titre . '</b>';
                echo '<p>Artist : ' . $artiste . '</p>';
                echo '<p>Year : ' . $annee . '</p>';
                echo '<p>Genre : ' . $genre . '</p>';
                echo '<p>Label : ' . $label . '</p>';
                echo '<p>Price : $' . $prix . '</p>'; 
                echo '<a class="btn btn-primary" href="update_form.php?disc_id=' . $disc_id . '">Modifier</a>
                      <a class="btn btn-primary" href="delete_form.php?disc_id=' . $disc_id . '">Supprimer</a>
                      <a class="btn btn-primary" href="index.php">Retour</a>';
                echo '</div>';
                echo '</div>';
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