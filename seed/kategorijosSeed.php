<?php require_once("../connections.php"); ?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriju generavimas</title>
</head>
<body>
<form action="" method="get">
        <button type="submit" name="submit">Sukurti kategorijas</button>
    </form>
<?php 
    if(isset($_GET["submit"])) {
        for ($i=0; $i<10; $i++) {

            $pavadinimas = "pavadinimas".$i;
            $aprasymas = "aprasymas".$i;
            $tevinis_id = 0;

            $sql = "INSERT INTO `kategorijos`(`pavadinimas`, `aprasymas`, `tevinis_id`) VALUES ('$pavadinimas', '$aprasymas', $tevinis_id)";

            
            if(mysqli_query($conn, $sql)) {
                echo "Kategorija sukurtas sekmingai";
                echo "<br>";
            } else {
                echo "Kazkas ivyko negerai";
                echo "<br>";
            }
        }
    }

?>
    
</body>
</html>