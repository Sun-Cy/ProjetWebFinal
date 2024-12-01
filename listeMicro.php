<?php include_once("inc/header.php"); 
require_once("./classe/PDOFactory.php");?>

<h1 class="center">Microphone</h1>

<article>
    
    <table>
        <tr>
            <th>Marque et Modele</th>
            <th>Prix</th>
        </tr>
        <tr>
            <th><a href="micro.php?id=1">test</a></th>
            <th>999$</th>
        </tr>
        <?php 
        $conn = PDOFactory::getMySQLConnection();
        $bddResults = $conn->query(
        'SELECT m.idMicro, concat(m.modele, " ", ma.marque), m.prix FROM microphone AS m 
        JOIN marque AS ma ON m.idMicro=ma.marque;');

        while($fetchData = $bddResults->fetch()){
            echo '<tr>';
            echo '<th><a href="micro.php?id='.$fetchData[0].'">'.$fetchData[1].'</a></th>';
            echo '<th>'.$fetchData[2].'</th>';
            echo '</tr>';
        };
        
        ?>
    </table>
</article>

<?php include_once("inc/footer.php"); ?>