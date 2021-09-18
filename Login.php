<?php require_once("connections.php"); ?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php 

if(isset($_POST["submit"])) {
    if(isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM `vartotojai` WHERE `username` = '$username' AND `password` = '$password'";

        $result = $conn->query($sql);
        // var_dump($result);
        if($result->num_rows == 1) {
            $user_info = mysqli_fetch_array($result);
            $cookie_array = array(
                $user_info["ID"],
                $user_info["username"],
                $user_info["password"],
                $user_info["teises_id"],
            );
            $cookie_array = implode("|", $cookie_array);
            setcookie("login", $cookie_array, time() + 3600, "/");
            header("location: index.php");
        } else {
            $negerai = "Neteisingi prisijungimo duomenys";
            $classN = "danger";
        }
    } else {
        $negerai = "Laukeliai yra tusti arba neteisingi duomenys";
        $classN = "danger";
    }
}

?>

<?php if(!isset($_COOKIE["login"])) { ?>
<div class="container">
        <h1>Slaptu Dokumentu archyvas</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" />
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Prisijungti</button>
            <br>
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
    <?php } else {
        header("Location: index.php");
    } ?>

</div>  
    
</body>
</html>