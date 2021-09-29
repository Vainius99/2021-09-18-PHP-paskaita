<?php require("connections.php"); ?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require("includes.php"); ?>
</head>
<body>
<div class="container">
        <?php require("design-parts/meniu.php"); ?>
        <?php require("design-parts/jumbotron.php"); ?>
        <?php showJumbotron("Admin", "Admin page"); ?>
        

        <h2>Sidebar atvaizdavimas </h2>
        <form action="admin.php">
            <?php
                $sql = "SELECT reiksme FROM nustatymai WHERE ID = 1 ";
                $result = $conn->query($sql);

                $selected_value = mysqli_fetch_array($result);

                $checked = array(0,0,0);
                
                if($selected_value[0] == 0) {
                    $checked[0] = "checked";
                } else if ($selected_value[0] == 1) {
                    $checked[1] = "checked";
                } else if ($selected_value[0] == 2) {
                    $checked[2] = "checked";
                }  

            ?>
            <input type="radio" name="sidebar" value="0" <?php echo $checked[0]; ?>/> Sidebar neatvaizduojamas </br>
            <input type="radio" name="sidebar" value="1" <?php echo $checked[1]; ?>/> Sidebar kaireje </br>
            <input type="radio" name="sidebar" value="2" <?php echo $checked[2]; ?>/> Sidebar desineje </br>
            <input class="btn btn-primary" type="submit" name="submit" value="Išsaugoti">
        </form>
        
        <?php
        if(isset($_GET["submit"])) {
            
            $sidebar = $_GET["sidebar"];

            $sql = "UPDATE `nustatymai` SET `reiksme`='$sidebar' WHERE ID = 1";
            $result = $conn->query($sql);

            if($result) {
                echo "Nustatymas pakeistas sėkmingai";
                echo "<script type='text/javascript'>window.top.location='admin.php';</script>";
            } else {
                echo "Kažkas įvyko negerai";
            }
        }

        ?>

        <h2> Kategoriju atvaizdavimas </h2>
        
        <form action="admin.php" method="get">
        
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Aprasymas</th>
                    <th>Veiksmai</th>
                    <th>Atvaizdavimas</th>
                </tr>
            <?php
            $sql = "SELECT * FROM kategorijos";
            $result = $conn->query($sql);

            while($category = mysqli_fetch_array($result)) {
                $categoryID = $category["ID"];
                echo "<tr>";
                    echo "<td>".$category["ID"]."</td>";
                    echo "<td>".$category["pavadinimas"]."</td>";
                    echo "<td>".$category["aprasymas"]."</td>";
                    echo "<td>";
                    echo "<a href='kategorijosEdit.php?ID=".$category["ID"]."'>Redaguoti</a>";
                    echo "</td>";
                    if($category["rodyti"] == 0) {
                        echo "<td>
                            <input type='checkbox' value='$categoryID' name='category[]'/> 
                        </td>";
                    } else {
                        echo "<td><input type='checkbox' value='$categoryID' name='category[]' checked='true'/> 
                        </td>";
                        
                    }
    
                echo "</tr>";

            }
            
            ?>
            </table>
            <input type="submit" name="submit1" value="Išsaugoti"/>   
        </form>
        

        <?php 
        if(isset($_GET["submit1"])) {

            $reiksmes = $_GET["category"];
            var_dump($reiksmes);

            $sql = "UPDATE `kategorijos` SET `rodyti`= 0";
            $result = $conn->query($sql);

            foreach ($reiksmes as $reiksme) {
                $sql = "UPDATE `kategorijos` SET `rodyti`= 1 WHERE ID=$reiksme";
                $result = $conn->query($sql);
            }

            echo "<script type='text/javascript'>window.top.location='admin.php';</script>";

        }
        
        ?>
                <h2> Kategoriju dropdown atvaizdavimas </h2>

        <form action="admin.php" method="get">
            <?php 

            $sql = "SELECT reiksme FROM nustatymai WHERE ID = 2 "; 
            $result = $conn->query($sql);
            $selected_value = mysqli_fetch_array($result);
            
            $checked = array("","");
                
                if($selected_value[0] == "nerodyti") {
                    $checked[0] = "checked";
                } else if ($selected_value[0] == "rodyti") {
                    $checked[1] = "checked";
                }
            
            ?>

            <input  type="radio" name="show_dropdown" value="2" <?php echo $checked[0]; ?> > Nerodyti kategorijų dropdown</br>
            <input  type="radio" name="show_dropdown" value="1" <?php echo $checked[1]; ?> > Rodyti kategorijų dropdown</br>
            <input class="btn btn-primary" type="submit" name="submit3" value="Išsaugoti">
        </form>

        <?php
        if(isset($_GET["submit3"])) {
            $show_dropdown = $_GET["show_dropdown"];

                $sql = "UPDATE `nustatymai` SET `reiksme`='$show_dropdown' WHERE ID = 2";
                $result = $conn->query($sql);

                if($conn->query($sql)) {
                    echo "Nustatymas pakeistas sėkmingai";
                    echo "<script type='text/javascript'>window.top.location='admin.php';</script>";
                } else {
                    echo "Kažkas įvyko negerai";
                }
        }
        
        
        ?>
        <h2> Puslapiu dropdown atvaizdavimas </h2>

<form action="admin.php" method="get">
    <?php 

    $sql = "SELECT reiksme FROM nustatymai WHERE ID = 3 "; 
    $result = $conn->query($sql);
    $selected_value = mysqli_fetch_array($result);
    
    $checked = array("","");
        
        if($selected_value[0] == "nerodyti") {
            $checked[0] = "checked";
        } else if ($selected_value[0] == "rodyti") {
            $checked[1] = "checked";
        }
    
    ?>

    <input  type="radio" name="show_pages" value="2" <?php echo $checked[0]; ?> > Nerodyti kategorijų dropdown</br>
    <input  type="radio" name="show_pages" value="1" <?php echo $checked[1]; ?> > Rodyti kategorijų dropdown</br>
    <input class="btn btn-primary" type="submit" name="submit4" value="Išsaugoti">
</form>

<?php
if(isset($_GET["submit4"])) {
    $show_pages = $_GET["show_pages"];

        $sql = "UPDATE `nustatymai` SET `reiksme`='$show_pages' WHERE ID = 3";
        $result = $conn->query($sql);

        if($conn->query($sql)) {
            echo "Nustatymas pakeistas sėkmingai";
            echo "<script type='text/javascript'>window.top.location='admin.php';</script>";
        } else {
            echo "Kažkas įvyko negerai";
        }
}


?>
    </div>

    <!-- puslapiu atvaizdavima sukurti dar -->
</body>
</html>