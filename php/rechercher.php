<?php
    include("./connexion.php");

    $magasin = $_GET["recherche"];

    $magasin = mysqli_real_escape_string($conn,$magasin);
    
    if ($magasin === '' || $magasin === 'noSearch') {
        $req = "SELECT * FROM magasin GROUP BY idMag LIMIT 50";
        $result = $conn->query($req);
    } else {
        $req="SELECT * FROM magasin WHERE nomMag LIKE '%".$magasin."%' GROUP BY idMag ORDER BY idMag ASC LIMIT 50";
        $result = $conn->query($req);
    }

    $lesMagasins=array();

    foreach($result as $magasin){
        array_push($lesMagasins, $magasin);
    }

    echo json_encode($lesMagasins);

?>