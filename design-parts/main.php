<?php require_once("connections.php"); ?>

<?php

$sql = "SELECT reiksme FROM nustatymai WHERE ID = 1 ";
$result = $conn->query($sql);
$sidebar_value = mysqli_fetch_array($result);

// var_dump($sidebar_value);

?>

<div class="row">

    <?php if ($sidebar_value['reiksme'] == 1) {
        require("sidebar.php");
    } ?>
    
    <?php if($sidebar_value['reiksme'] == 0) { ?>
        <div class="col-lg-12">
    <?php } else {?>
        <div class="col-lg-9">
    <?php } ?>

    <div class="row">

        <?php 

        if(isset($_GET["catID"]) && !empty($_GET["catID"])) {
            $catID = $_GET["catID"];
            
            $sql = "SELECT puslapiai.pavadinimas, 
            puslapiai.nuoroda, 
            puslapiai.santrauka, 
            kategorijos.pavadinimas AS kategorijos_pavadinimas,
            kategorijos.ID
            FROM puslapiai 
            LEFT JOIN kategorijos
            ON puslapiai.kategorijos_id = kategorijos.ID
            WHERE puslapiai.kategorijos_id = $catID
            ORDER BY puslapiai.ID DESC";    
        } else {
            $sql = "SELECT puslapiai.pavadinimas, 
            puslapiai.nuoroda, 
            puslapiai.santrauka, 
            kategorijos.pavadinimas AS kategorijos_pavadinimas,
            kategorijos.ID
            FROM puslapiai 
            LEFT JOIN kategorijos
            ON puslapiai.kategorijos_id = kategorijos.ID
            ORDER BY puslapiai.ID DESC";
        }

        $result = $conn->query($sql);

            while($pages = mysqli_fetch_array($result)) {
            ?>
            <div class="card col-lg-4" style="width: 18rem;">
                <img class="card-img-top" src="https://images.unsplash.com/photo-1469598614039-ccfeb0a21111?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $pages["pavadinimas"]; ?></h5>
                    <p class="card-text"><?php echo $pages["santrauka"]; ?></p>
                    <a href="puslapiai.php?href=<?php echo $pages["nuoroda"]; ?>" class="btn btn-primary puslapis">Go somewhere</a>
                    <?php $userRights = explode("|", $_COOKIE["login"]); 
                    if($userRights[3] == 1) { ?>
                    <a href="puslapiaiEdit.php?href=<?php echo $pages["nuoroda"]; ?>" class="text-danger edit"> Edit </a>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>    
        </div>
    </div>
    
    <?php if ($sidebar_value['reiksme'] == 2) {
        require("sidebar.php");
    } ?>
</div>