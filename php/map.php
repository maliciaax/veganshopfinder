<?php
    include("connexion.php");

    //$idMagasin = mysqli_real_escape_string($conn,$idMagasin);

    $req="SELECT * FROM magasin GROUP BY idMag ORDER BY idMag ASC LIMIT 50";
 
    $result = $conn->query($req);

    $lesInfos=array();

    foreach($result as $info){
        array_push($lesInfos, $info);
    }

    echo json_encode($lesInfos);
?>