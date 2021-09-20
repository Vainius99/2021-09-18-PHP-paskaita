<?php require_once("connections.php"); ?>

<?php

$url = $_GET["href"];

$sql = "SELECT * FROM puslapiai 
WHERE nuoroda='$url'";

$result = $conn->query($sql);

$userRights = explode("|", $_COOKIE["login"]); 

if($result->num_rows != 0 && $userRights[3] == 1) {
    $page = mysqli_fetch_array($result);
} else {
    header("Location:404.php");
}

?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redagavimas</title>
    <?php require_once("includes.php"); ?>
</head>
<body>
<?php 
 if(isset($_GET["submit"])) {
    if(isset($_GET["ID"]) && !empty($_GET["ID"]) && isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"]) && isset($_GET["santrauka"]) && !empty($_GET["santrauka"]) && isset($_GET["kategorijos_id"]) && !empty($_GET["kategorijos_id"]) && isset($_GET["turinys"]) && !empty($_GET["turinys"])) {
        $id = intval($_GET["ID"]);
        $pavadinimas = $_GET["pavadinimas"];
        $santrauka = $_GET["santrauka"];
        $kategorijos_id = intval($_GET["kategorijos_id"]);
        $turinys = $_GET["turinys"];
        

        $sql = "UPDATE `puslapiai` SET `pavadinimas`= '$pavadinimas',`turinys`= '$turinys',`santrauka`= '$santrauka',`kategorijos_id`= $kategorijos_id WHERE `ID` = $id";

            if(mysqli_query($conn, $sql)) {
                // $message = "Redaguota sekmingai";
                // $classN = "success";
                header("Location:index.php?success=1");

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
    <?php showJumbotron($page["pavadinimas"], "Redagavimas"); ?>

  

            <form action="" method="get">
            <input class="hide" type="text" name="ID" value ="<?php echo $page["ID"] ?>" />
                <div class="form-group">
                    <h4>Pavadinimas</h4>
                    <input class="form-control" type="text" name="pavadinimas" value="<?php echo $page["pavadinimas"]?>" />
                </div>
                <div class="form-group">
                    <h4>Kategorijos_id</h4>
                    <input class="form-control" type="text" name="kategorijos_id" value="<?php echo $page["kategorijos_id"] ?>"/>
                </div>
                <div class="form-group">
                    <div class="col-lg-12"> 
                        <h4>Santrauka</h4>
                        <textarea  class="form-control" type="text" name="santrauka" id="santrauka"><?php echo $page["santrauka"] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <h4>Turinys</h4>
                        <textarea class="form-control" type="text" id="turinys" name="turinys"><?php echo $page["turinys"] ?></textarea>
                    </div>    
                </div>
            <button class="btn btn-primary" type="submit" name="submit">Issaugoti</button>
            <br>
            <a href="index.php">Back</a> 
               
            </form>
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
               
<script>
            $(document).ready(function() {
            $('#turinys').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                  // set focus to editable area after initializing summernote
                });
            });

            $(document).ready(function() {
            $('#santrauka').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                  // set focus to editable area after initializing summernote
                });
            });


</script>
</body>
</html>