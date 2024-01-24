<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Vinyle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Ajouter un Vinyle</h1>
        <form action="/Scripts/add_script.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Title :</label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <label for="artiste">Artist :</label>
                <select class="form-control" id="artiste" name="artiste" required>
                    <option value="">Select an artist</option>
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

                    $sqlArtiste = "SELECT artist_name FROM artist";
                    $resultArtiste = $conn->query($sqlArtiste);

                    if ($resultArtiste->rowCount() > 0) {
                        while ($rowArtiste = $resultArtiste->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $rowArtiste['artist_name'] . '">' . $rowArtiste['artist_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="annee">Year :</label>
                <input type="text" class="form-control" id="annee" name="annee" placeholder="Enter year" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre :</label>
                <input type="text" class="form-control" id="genre" name="genre" placeholder="Enter genre (Rock,Pop,Prog ...)" required>
            </div>
            <div class="form-group">
                <label for="label">Label :</label>
                <input type="text" class="form-control" id="label" name="label" placeholder="Enter label (EMI,Warner,PolyGram,Univers sale ...)" required>
            </div>
            <div class="form-group">
                <label for="prix">Price :</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="image">Picture :</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
</body>

</html>