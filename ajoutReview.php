<?php
require_once("./classe/PDOFactory.php");
require_once("./inc/header.php");

$conn = PDOFactory::getMySQLConnection();

$addMicroReview = $conn->prepare('INSERT INTO Microphone (idMicro, idUser, titre, score, textRevue) VALUES (:idMicro, :idUser, :titre, :score, :textRevue)');

if(isset($_POST['action'])){
    if($_POST['action'] === 'register'){
        $userId = $_SESSION['client'] ?? '0';
        $idMicro = htmlspecialchars($_POST['micro'] ?? '');
        $titre = htmlspecialchars($_POST['titre'] ?? '');
        $rating = htmlspecialchars($_POST['rating'] ?? '');
        $review = htmlspecialchars($_POST['textRevue'] ?? '');

        $addMicroReview->bindParam($idMicro, $userId, $titre, $rating, $review);
        $addMicroReview->execute();
    }
}
?>

<h1 class="center">Merci pour votre revue!</h1>

<?php include_once("inc/footer.php"); ?>