<?php require("connections.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Create</title>
    <?php require("includes.php"); ?>
<style>
    .naujas {
        display: none;
    }
</style>  

</head>
<body>
    <div class="container">
        <?php require("design-parts/meniu.php"); ?>
        <?php require("design-parts/jumbotron.php"); ?>
        <?php showJumbotron("Create Menu", "Menu Creation page"); ?>

        <form action="createMenu.php" method="get">
            <input type="radio" name="menuType" value="1" checked="true"> Pasirinktinė nuoroda <br>
            <input type="radio" name="menuType" value="2"> Nuoroda į kategoriją <br>
            <input type="radio" name="menuType" value="3"> Nuoroda į puslapį <br>
            <input type="submit" name="submit" value="Create">
        </form>

        <?php 
        if(isset($_GET["menuType"])) {
            $menuType = $_GET["menuType"]; ?>
            <?php if($menuType == 1) { ?>
                <h2> Pasirinktine forma </h2>
                <form action="createMenu.php" method="get">
                        <input type="hidden" name="menuType" value="<?php echo $menuType; ?>" >
                        <input class="form-control" type="text" name="pavadinimas" placeholder="Įveskite pavadinimą">
                        <input class="form-control" type="text" name="nuoroda" placeholder="Įveskite nuorodą">
                        <input  type="radio" name="target" value="_self"> Atsidarys tame pačiame</br>
                        <input  type="radio" name="target" value="_blank"> Atsidarys kitame lange</br>
                        <input class="form-control" type="text" name="alt" placeholder="Įveskite nuorodos aprašymą">
                        <input class="btn btn-primary" type="submit" name="create" value="Create">                        
                    </form>

                    <?php
                    if(isset($_GET["create"])) {
                    $pavadinimas = $_GET["pavadinimas"];
                    $nuoroda = $_GET["nuoroda"];
                    $target = $_GET["target"];
                    $alt = $_GET["alt"];
                        $sql= "INSERT INTO `menu`(`pavadinimas`, `nuoroda`, `target`, `alt`) VALUES ('$pavadinimas', '$nuoroda', '$target', '$alt')";
                    
                        if(mysqli_query($conn, $sql)) {
                            echo "Meniu punktas sukurtas sėkmingai";
                            echo "<script type='text/javascript'>window.top.location='createMenu.php';</script>";
                            echo "<br>";
                        } else {
                            echo "Kazkas ivyko negerai";
                            echo "<br>";
                        }
                    }
                
                    ?>

                <?php } else if ($menuType == 2) { ?>
                    <h2> nuoroda i Kategorija </h2>
                    <form action="createMenu.php" method="get">
                    <input type="hidden" name="menuType" value="<?php echo $menuType; ?>" >
                        <select name="categories">
                            <?php 
                                $sql = "SELECT `ID`, `pavadinimas` FROM `kategorijos`";
                                $result = $conn->query($sql);
                                while($categories = mysqli_fetch_array($result)) {
                                    $id = $categories["ID"];
                                    $pavadinimas = $categories["pavadinimas"];
                                    
                                    echo "<option value='$id'>$pavadinimas</option>";
                                }
                            
                            ?>
                        </select><br>
                        <input  type="radio" name="target" value="_self" checked="true"> Atsidarys tame pačiame</br>
                        <input  type="radio" name="target" value="_blank"> Atsidarys kitame lange</br>
                        <a>Pavadinimas</a></br>
                        <input  type="radio" name="pav1" value="esamas"> esamas pavadinimas</br>
                        <input  type="radio" name="pav1" value="naujas"> naujas pavadinimas</br>
                        <input class="naujas form-control" id="naujas" type="text" name="alt" placeholder="Įveskite kita pavadinima">
                        <input class="btn btn-primary" type="submit" name="create2" value="Create">                 
                        
                        
                        <?php
                        if(isset($_GET["create2"])) {
                            $category_id = $_GET["categories"];
                            $sql = "SELECT `pavadinimas` FROM `kategorijos` WHERE ID = $category_id";
                            $result = $conn->query($sql);
                            
                            $category = mysqli_fetch_array($result);
                            $pavadinimas = $category["pavadinimas"];
                            $target = $_GET["target"];
                            $alt = $_GET["alt"];

                            $nuoroda = "index.php?catID=".$category_id;

                            $sql = "INSERT INTO `menu`(`pavadinimas`, `nuoroda`, `target`, `alt`) VALUES ('$pavadinimas','$nuoroda','$target','$alt')";
                        
                            if(mysqli_query($conn, $sql)) {
                                    echo "Meniu punktas sukurtas sėkmingai";
                                    echo "<script type='text/javascript'>window.top.location='createMenu.php';</script>";
                                    echo "<br>";
                            } else {
                                    echo "Kazkas ivyko negerai";
                                    echo "<br>";
                            }
                        }
                        ?>                       

                </form>
                <!-- <div class="naujas">
                            naujas
                        </div> -->

                <?php } else if ($menuType == 3) { ?>
                    <h2> Nuoroda i puslapi</h2>
                <form action="createMenu.php" method="get">
                <input type="hidden" name="menuType" value="<?php echo $menuType; ?>" >
                        <select name="pages">
                            <?php 
                                $sql = "SELECT  pavadinimas, nuoroda FROM puslapiai";
                                $result = $conn->query($sql);
                                while($pages = mysqli_fetch_array($result)) {
                                    $nuoroda = $pages["nuoroda"];
                                    $pavadinimas = $pages["pavadinimas"];
                                    
                                    echo "<option value='$nuoroda'>$pavadinimas</option>";
                                }
                            
                            ?>
                        </select><br>
                        <input  type="radio" name="target" value="_self" checked="true"> Atsidarys tame pačiame</br>
                        <input  type="radio" name="target" value="_blank"> Atsidarys kitame lange</br>
                        
                        <input class="form-control" type="text" name="alt" placeholder="Įveskite nuorodos aprašymą">
                        <input class="btn btn-primary" type="submit" name="create" value="Create">
                    </form>
                    
                    <?php 
                    if(isset($_GET["create"])) {

                        $pages_href = $_GET["pages"];
                        $sql = "SELECT pavadinimas FROM puslapiai WHERE nuoroda = '$pages_href'";
                        $result = $conn->query($sql);
                        
                        $page = mysqli_fetch_array($result);
                        $pavadinimas = $page["pavadinimas"];
                        
                        $target = $_GET["target"];
                        $alt = $_GET["alt"];

                        $nuoroda = "puslapiai.php?href=".$pages_href;

                        $sql = "INSERT INTO `menu`(`pavadinimas`, `nuoroda`, `target`, `alt`) VALUES ('$pavadinimas','$nuoroda','$target','$alt')";
                    
                        if(mysqli_query($conn, $sql)) {
                                echo "Meniu sukurtas sėkmingai";
                                echo "<script type='text/javascript'>window.top.location='createMenu.php';</script>";
                                echo "<br>";
                        } else {
                                echo "Kazkas ivyko negerai";
                                echo "<br>";
                        }
                    }
                    
                    ?>

                
                <?php } ?>
        <?php } ?>

    </div>

    
</body>
</html>