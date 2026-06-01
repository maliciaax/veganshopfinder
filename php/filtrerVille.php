<?php
    include("./connexion.php");

    $selecteurVille = $_GET["selecteurVille"];

    $selecteurVille = mysqli_real_escape_string($conn, $_GET["selecteurVille"]);

    $req="SELECT * FROM magasin WHERE LOWER(ville)=LOWER('".$selecteurVille."') GROUP BY idMag ORDER BY idMag ASC LIMIT 50";
 
    $result = $conn->query($req);

    $lesMagasins=array();

    foreach($result as $magasin){
        array_push($lesMagasins, $magasin);
    }

    echo json_encode($lesMagasins);

?>