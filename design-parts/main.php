
<?php require_once("connections.php"); ?>



<div class="row">
    <!-- <div class="col-lg-12">
        <h3>Šoninė juosta/Sidebar</h3>
    </div> -->
    <div class="col-lg-12">
        <div class="row">
        <?php 

            $sql = "SELECT * FROM puslapiai
            ORDER BY puslapiai.ID DESC
            ";

            $result = $conn->query($sql);

            while($pages = mysqli_fetch_array($result)) {
            ?>
            <div class="card col-lg-4" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $pages["pavadinimas"]; ?></h5>
                    <p class="card-text"><?php echo $pages["santrauka"]; ?></p>
                    <a href="puslapiai.php?href=<?php echo $pages["nuoroda"]; ?>" class="btn btn-primary">Go somewhere</a>
                    <a href="puslapiaiEdit.php?href=<?php echo $pages["nuoroda"]; ?>" class="text-danger edit"> Edit </a>
                </div>
            </div>

            <?php } ?>    
        </div>
    </div>
</div>