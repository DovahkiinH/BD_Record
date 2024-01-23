<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Disques</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Assets/Css/Css.css">
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


    $sql = "SELECT disc_id, disc_title, disc_year, disc_picture, disc_genre, disc_label FROM disc";

    try {
        $result = $conn->query($sql);


        if ($result->rowCount() > 0) {
            $count = 0;
            echo '<h1>Liste des Disques (' . $result->rowCount() . ' disques)</h1>';
            echo '<a class="btn btn-primary" href="add_form.php">Ajouter</a><hr>';
            echo '<div class="disque-container">';
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="disque">';
                echo '<img src="assets/img/' . $row['disc_picture'] . '" alt="Image du disque">';
                echo '<div class="details">';
                echo '<b>' . $row['disc_title'] . '</b>';
                echo '<p>Année : ' . $row['disc_year'] . '</p>';
                echo '<p>Genre : ' . $row['disc_genre'] . '</p>';
                echo '<p>Label : ' . $row['disc_label'] . '</p>';
                echo '<a class="btn btn-primary" href="details.php?disc_id=' . $row['disc_id'] . '">Détail</a>';
                echo '</div>';
                echo '</div>';
                $count++;
            }
            echo '</div>';
        } else {
            echo '<h1>Liste des Disques (0 disque)</h1>';
            echo "Aucun enregistrement trouvé dans la table 'disc'.";
        }
    } catch (PDOException $e) {
        echo "Erreur de requête :" . $e->getMessage();
    }

    $conn = null;
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>