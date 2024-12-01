<?php
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();

$addMicroReview = $conn->prepare('INSERT INTO Microphone (idMicro, idUser, titre, score, textRevue) VALUES (:idMicro, :idUser, :titre, :score, :textRevue)');

if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] === 'ajoutReview'){
        if(isset($_SESSION['client'])){
            $userId = $_SESSION['client']->getId();
        }
        else{
            $userId = 0;
        }
        
        $idMicro = htmlspecialchars($_REQUEST['micro']);
        $titre = htmlspecialchars($_REQUEST['titre']);
        $rating = htmlspecialchars($_REQUEST['rating']);
        $review = htmlspecialchars($_REQUEST['textRevue']);

        $addMicroReview->bindParam($idMicro, $userId, $titre, $rating, $review);
        $addMicroReview->execute();

        $_REQUEST['action'] = '';
    }
}
?>

<h1 class="center">Merci pour votre revue!</h1>

<?php include_once("inc/footer.php"); ?>