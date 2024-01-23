<?php
$db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Afpa1234');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifier si la clé "disc_id" existe dans $_GET http://localhost:3000/details_disc.php?disc_id=4
if (isset($_GET["disc_id"])) {
    $requete = $db->prepare("SELECT * FROM disc WHERE disc_id = ?");
    $requete->execute(array($_GET["disc_id"]));
    $disc = $requete->fetch(PDO::FETCH_OBJ);
    
    // Vérifier si l'enregistrement a été trouvé
    if ($disc) {
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test PDO</title>
</head>
<body>
    Disc N° <?= $disc->disc_id ?>
    Disc name <?= $disc->disc_title ?>
    Disc year <?= $disc->disc_year ?>

</body>
</html>
<?php
    } else {
        echo "Aucun enregistrement trouvé pour disc_id = " . $_GET["disc_id"];
    }
} else {
    echo "Paramètre disc_id non spécifié dans l'URL.";
}
?>

