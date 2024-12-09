<?php
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$addMicroReview = $bdd->prepare('INSERT INTO revue (idMicro, idUser, titre, score, textRevue) VALUES (:idMicro, :idUser, :titre, :score, :textRevue)');



if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] === 'ajoutReview'){
        if(isset($_SESSION['client'])){
            $userId = (int) $_SESSION['client']->getId();
        }
        else{
            $userId = 1;
        }
        $idMicro = (int) htmlspecialchars($_REQUEST['micro']);
        $titre = htmlspecialchars($_REQUEST['titre']);
        $rating = (float) htmlspecialchars($_REQUEST['rating']);
        $review = htmlspecialchars($_REQUEST['textRevue']);

        $addMicroReview->bindParam(':idMicro', $idMicro, PDO::PARAM_INT);
        $addMicroReview->bindParam(':idUser', $userId, PDO::PARAM_INT);
        $addMicroReview->bindParam(':titre', $titre, PDO::PARAM_STR);
        $addMicroReview->bindParam(':score', $rating, PDO::PARAM_STR);
        $addMicroReview->bindParam(':textRevue', $review, PDO::PARAM_STR);
        $addMicroReview->execute();

        $_REQUEST['action'] = '';
    }
}
?>

<h1 class="center">Merci pour votre revue!</h1>

<?php include_once("inc/footer.php"); ?>