<div class="col-lg-3">
    <h3>Šoninė juosta/Sidebar</h3> 

<?php

    function kategorijuMedis($tevinis_id = 0, $kategorijos_medis_masyvas = '') {

        require("connections.php");

    if(!is_array($kategorijos_medis_masyvas)) {
        $kategorijos_medis_masyvas = array();
    }
        
        $sql = "SELECT * FROM kategorijos WHERE tevinis_id = $tevinis_id AND rodyti = 1";
            
        $result = $conn->query($sql);
        
        if($result->num_rows > 0) {
            $kategorijos_medis_masyvas[] = "<ul>";
            while($category = mysqli_fetch_array($result)) {
                $categoryID = $category["ID"];
                $sql1 = "SELECT COUNT(ID) AS viso_irasu FROM `puslapiai` WHERE kategorijos_id = $categoryID ";
                $result1 = $conn->query($sql1);
                $totalPages = mysqli_fetch_array($result1);
                $kategorijos_medis_masyvas[] = "<li>";
                $kategorijos_medis_masyvas[] = "<a href='index.php?catID=".$categoryID."'>";
                $kategorijos_medis_masyvas[] = $category["pavadinimas"]." (".$totalPages["viso_irasu"].")" ;
                $kategorijos_medis_masyvas[] = "</a>";
                $kategorijos_medis_masyvas[] = "</li>";
                $kategorijos_medis_masyvas = kategorijuMedis($category["ID"], $kategorijos_medis_masyvas);
                }
            $kategorijos_medis_masyvas[] = "</ul>";
            }
            
        return $kategorijos_medis_masyvas;
        }
        
    $kategorijos = kategorijuMedis();
        
    foreach($kategorijos as $kategorija) {
        echo $kategorija;
    }
        
            
?>
  
</div>