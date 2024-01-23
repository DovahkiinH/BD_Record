<?php

    try 
    {
        $db = new PDO('mysql:host=localhost;dbname=record;charset=utf8','admin','Afpa1234');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
        $requete = $db->query("SELECT * FROM artist");
        $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
        $requete->closeCursor();

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage() . "<br>";
        echo "N° : " . $e->getCode();
        die("Fin du script");
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PDO</title>
</head>
<body>

<?php foreach ($tableau as $artist): ?>

    <div>
        <?= $artist->artist_name ?>
    </div>
    
<?php endforeach; ?>

</body>
</html>
