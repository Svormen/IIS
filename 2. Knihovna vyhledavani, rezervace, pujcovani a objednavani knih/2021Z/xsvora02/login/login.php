<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();

// if user is logged in then he will be automatically redirected to main page if he tries to enter login page
if(isset($_SESSION['username']))
{
    header("location: ../index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    if(!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))){
        $stmt = $db->get_mail_password($_POST['username']);

        if(!empty($stmt))
        {
            $id = $stmt['id'];
            $username = $stmt['mail'];
            $hashed_password = $stmt['password'];
            $role = $stmt['role'];

            if(password_verify($_POST['password'], $hashed_password)){                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["role"]= $role;                           
                
                // Redirect user to welcome page
                header("location: ../index.php");
            }
            else{
                // When password does not match password from database 
                header("Location: login.php?username=" .$username . "&pass_error=Nesprávne heslo!");
            }
        }
        else{
            // When username does not match mail from database
            header("Location: login.php?username=" .$username . "&error=Nesprávny E-mail!");
        }
        unset($stmt);
    }
}
?>

<html>
<head>
        <!-- META TAGS -->
		<meta charset="utf-8">
        
        <!-- TITLE -->
        <title>Knižnica</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	</head>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="position: absolute;">
        <div class="container">
            <a class="navbar-brand" href="../index.php" style="color: white;">Knižnica</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white;">
            <span class="navbar-toggler-icon" ></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <a class="nav-link" href="../shared/contact.php" style="color: white; background-color:black; width:100px">Kontakt</a>
                </li>
                <li class="nav-item">
                <?php
                if(isset($_SESSION['username']))
                {
                    echo '<a href="./logout.php"><button type="button" class="btn btn-primary" style="width:100px">Odhlásiť</button></a>';
                } else
                {
                    echo '<a href="./login.php"><button type="button" class="btn btn-primary" style="width:100px">Prihlásiť</button></a>';
                }
                ?>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="height: 400px; background-color: rgb(0,0,0); position:relative;">
            <div class="carousel-item active">
            <img class="d-block w-100" src="../images/header_images/image3.png" alt="First slide" style="position:absolute;top:60;">
            </div>
            
            <div class="carousel-item"  style="position:absolute;top:60;">
            <img class="d-block w-100" src="../images/header_images/image2.png" alt="Second slide">
            </div>

            <div class="carousel-item">
            <img class="d-block w-100" src="../images/header_images/image1.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5">Login form</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info">Prihlásenie</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">E-mail:</label><br>
                                    <input type="text" name="username" id="username" class="form-control" value="<?php if (isset($username)) {echo $username;} elseif(isset($_GET['username'])) {echo $_GET['username'];}?>" required>
                                </div>
                                <div class="form-group">
                                    <?php if (isset($_GET['error'])) 
                                    { ?> <p class="errorMsg" style="color: red;"><?php echo $_GET['error']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Heslo:</label><br>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <?php if (isset($_GET['pass_error'])) 
                                    { ?> <p class="error" style="color: red;"><?php echo $_GET['pass_error']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Prihlásiť">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="./register.php" class="text-info">Registrovať tu</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include '../static/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>