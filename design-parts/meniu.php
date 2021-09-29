<?php require_once("connections.php"); ?>
<?php require_once("log_info.php"); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"> Main Page <span class="sr-only">(current)</span></a>
                </li>
                <?php 
                    $sql = "SELECT reiksme FROM nustatymai WHERE ID = 2";
                    $result = $conn->query($sql);
                    $selected_value = mysqli_fetch_array($result);

                    if($selected_value[0] == "1") {?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kategorijos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php 
                                    $sql = "SELECT * from kategorijos WHERE rodyti = 1";
                                    $result = $conn->query($sql);
                                    while($categories = mysqli_fetch_array($result)) {
                                        $pavadinimas = $categories["pavadinimas"];
                                        $id = $categories["ID"];
                                        echo "<a class='dropdown-item' href='index.php?catID=$id'>$pavadinimas</a>";
                                    }
                                ?>
                            </div>
                        </li>
                    <?php } ?>    

                    <?php 
                    $sql = "SELECT reiksme FROM nustatymai WHERE ID = 3";
                    $result = $conn->query($sql);
                    $selected_value = mysqli_fetch_array($result);

                    if($selected_value[0] == "1") {?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Puslapiai
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php 
                                    $sql = "SELECT * from puslapiai WHERE rodyti = 1";
                                    $result = $conn->query($sql);
                                    while($categories = mysqli_fetch_array($result)) {
                                        $pavadinimas = $categories["pavadinimas"];
                                        $id = $categories["ID"];
                                        echo "<a class='dropdown-item' href='index.php?catID=$id'>$pavadinimas</a>";
                                    }
                                ?>
                            </div>
                        </li>
                    <?php } ?> 

                    <?php  
                    $sql = "SELECT * FROM menu";
                    $result = $conn->query($sql);
                    
                    while($meniu = mysqli_fetch_array($result)) {
                        $pavadinimas = $meniu["pavadinimas"];
                        $nuoroda = $meniu["nuoroda"];
                        $target = $meniu["target"];
                        $alt = $meniu["alt"];    

                        echo "<li class='nav-item'>";
                            echo "<a class='nav-link' href='$nuoroda' target='$target' alt='$alt' >$pavadinimas</a> ";
                        echo "</li>";
                    }
                    ?>
            </ul>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
                <ul class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seeding test
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="seed/kategorijosSeed.php">Kategorijos seed</a>
                    <a class="dropdown-item" href="seed/puslapiaiSeed.php">Puslapiai seed</a>   
                    </div>
                </ul>
                
                    <?php if ($varT[3] == 1 ) { ?>
                <ul class="nav-item">
                    <a class="nav-link disabled" href="admin.php">Admin</a>
                    </ul>
                <ul class="nav-item">
                    <a class="nav-link disabled" href="createMenu.php">Menu Valdymas</a>
                    </ul>
                    <?php } ?>
            
            <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
</nav>