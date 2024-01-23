<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des enregistrements</title>
</head>
<body>

    <h2>Liste des enregistrements dans la table "disc"</h2>

    <?php
    // Connexion à la base de données (à adapter selon votre configuration)
    $conn = new mysqli('localhost', 'admin', 'Afpa1234', 'disc');

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Requête pour récupérer les enregistrements de la table "disc"
    $query = "SELECT disc_id , disc_title , disc_year , disc_picture , disc_label , disc_genre , disc_price , disc.artist_id , artist.artist_id , artist_name FROM disc , artist WHERE disc.artist_id = artist.artist_id";
    $result = $conn->query($query);

    // Vérification des résultats
    if ($result->num_rows > 0) {
        // Affichage des enregistrements dans un tableau HTML
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Title</th><th>Artist</th><th>Year</th></tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['disc_id'] . '</td>';
            echo '<td>' . $row['disc_title'] . '</td>';
            echo '<td>' . $row['disc_year'] . '</td>';
            echo '<td>' . $row['disc_picture'] . '</td>';
            echo '<td>' . $row['disc_label'] . '</td>';
            echo '<td>' . $row['disc_genre'] . '</td>';
            echo '<td>' . $row['disc_price'] . '</td>';
            echo '<td>' . $row['artist_name'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "Aucun enregistrement trouvé dans la table 'disc'.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
    ?>

</body>
</html>