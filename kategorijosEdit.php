<?php require_once("connections.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorijos redagavimas</title>
    <?php require_once("includes.php"); ?>
    <style>
    .hide {
        display: none;
    }
    </style>
</head>
<body>
<?php 
if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM `kategorijos` WHERE `ID` = $id";
     
    $result = mysqli_query($conn, $sql);
    
    if($result->num_rows == 1) {
        $category = mysqli_fetch_array($result);
    
        $hideForm = false;
    } else {
        echo "ivyko kazkas blogai";
        $hideForm = true;
    }

}
if(isset($_GET["submit"])) {
    if(isset($_GET["pavadinimas"]) && isset($_GET["aprasymas"]) && !empty($_GET["pavadinimas"]) && !empty($_GET["aprasymas"]) && isset($_GET["tevinis_id"])) {
        $id = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $tevinis_id = intval($_GET["tevinis_id"]);
        $aprasymas = $_GET["aprasymas"];

        $sql = "UPDATE `kategorijos` SET `pavadinimas`='$pavadinimas',`tevinis_id`= $tevinis_id ,`aprasymas`= '$aprasymas'  WHERE ID = $id";

        if(mysqli_query($conn, $sql)) {
            $message =  "Kategorija redaguota sėkmingai (Po 2 sekundziu griste i Admin)";
            $class = "success";
            $hideForm = true;           
           
            echo '<meta http-equiv="refresh" content="2;url=Admin.php">';

        } else {
            $negerai =  "Kazkas ivyko negerai";
            $classN = "danger";
        }
    } else {
        $negerai =  "Kazkas ivyko negerai arba yra tusti langeliai";
        $classN = "danger";
    }
}
?>
<div class="container">

<?php require_once("design-parts/meniu.php"); ?>
<?php require_once("design-parts/jumbotron.php"); ?>
<?php showJumbotron($category['pavadinimas'], "Kategorijos Redagavimas"); ?>
</nav>
    <?php if($hideForm == false) { ?>
        
            <form action="kategorijosEdit.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $category["ID"] ?>" />

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" value="<?php echo $category["pavadinimas"] ?>" />
                </div>
                <div class="form-group">
                    <label for="aprasymas">Aprasymas</label>
                    <input class="form-control" type="text" name="aprasymas" value="<?php echo $category["aprasymas"] ?>"/>
                </div>
                <div class="form-group">
                    <label for="tevinis_id">Kategorija</label>
                    <select class="form-control" name="tevinis_id">
                        
                    <option value = "0">Nepriklausoma Kategorija</option>
                        
                    <?php 
                         $sql = "SELECT `ID`, `pavadinimas` FROM `kategorijos` WHERE 1";
                         $result1 = $conn->query($sql);
                        
                         while($categoryT = mysqli_fetch_array($result1)) {

                        
                            if ($category["tevinis_id"] == $categoryT["ID"]) {
                                echo "<option value='".$categoryT["ID"]."' selected='true'>";
                            } else {
                                echo "<option value='".$categoryT["ID"]."'>";
                            }  
                                echo $categoryT["pavadinimas"];
                            echo "</option>";
                            }
                        
                        ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Issaugoti</button>
                <br>
                <a href="admin.php">Back</a> 
               
            </form>

        <?php } else { ?>
            
            
        <?php } ?>  

            <?php if(isset($message)) { ?>
                <div class="message alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
                <?php if(isset($negerai)) { ?>
                    <div class="message alert alert-<?php echo $classN; ?>" role="alert">
                     <?php echo $negerai; ?>
                    </div>
                <?php } ?> 
           
               
          
</div>



</body>
</html>