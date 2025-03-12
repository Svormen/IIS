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
    if(!empty(trim($_POST['mail'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['password_confirm']))){
        //check if password and password confirm are same
        if($_POST['password'] == $_POST['password_confirm']){
            //add null to items that are not filled in registration form   
            foreach($_POST as $item => $value){
                if(empty($_POST[$item])){
                    $form_data[$item] = NULL;
                }
                else {
                    $form_data[$item] = $_POST[$item];
                }
            }

            //check if user is in database 
            if(!($db->mail_exist($_POST['mail']))){
                //add user information to database
                $data = $db->add_user($form_data);

                //set session information
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $data['user_id'];
                $_SESSION["username"] = $_POST['mail'];
                $_SESSION["role"]= 1;

                // Redirect user to welcome page
                header("location: ../index.php");
            }
            else {
                $error['mail'] = "Klient so zadaným e-mailom existuje!";
            }
        }
        else {
            $error['pass'] = "Heslá sa nezhodujú!";
        }
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
                <li class="nav-item">
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
        <div id="Register">
            <h3 class="text-center text-white pt-5">Register form</h3>
            <div class="container">
                <div id="register-row" class="row justify-content-center align-items-center">
                    <div id="register-column" class="col-md-6">
                        <div id="register-box" class="col-md-12">
                            <form id="register-form" class="form" action="" method="post">
                                <h3 class="text-center text-info">Registrácia</h3>
                                <?php if(isset($error['mail'])) { ?>
                                    <p class="errorMsg text-center" style="color: red; font-size: 15px; margin: 0;"><?php echo $error['mail'] ?></p>
                                <?php } ?>
                                <?php if(isset($error['pass'])) { ?>
                                    <p class="errorMsg text-center" style="color: red; font-size: 15px; margin: 0;"><?php echo $error['pass'] ?></p>
                                <?php } ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <label for="name" class="text-info">Meno:</label><br>
                                            <input type="text" name="name" id="name" class="form-control" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" pattern="[A-Z a-z \´ \ˇ]*">

                                            <!-- Mail -->
                                            <label for="mail" class="text-info">E-mail*:</label><br>
                                            <input type="email" name="mail" id="mail" class="form-control" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];}?>" required>

                                            <!-- Street -->
                                            <label for="street" class="text-info">Ulica:</label><br>
                                            <input type="text" name="street" id="street" class="form-control" value="<?php if(isset($_POST['street'])){echo $_POST['street'];}?>" pattern="[A-Z a-z \´ \ˇ]*">

                                            <!-- City -->
                                            <label for="city" class="text-info">Mesto:</label><br>
                                            <input type="text" name="city" id="city" class="form-control" value="<?php if(isset($_POST['city'])){echo $_POST['city'];}?>" pattern="[A-Z a-z \´ \ˇ]*">

                                            <!-- Password -->
                                            <label for="password" class="text-info">Heslo*:</label><br>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                            <!--<p class="help-block" style="font-size: 10px;">Username can contain any letters or numbers, without spaces</p>-->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Surname -->
                                            <label for="surname" class="text-info">Priezvisko:</label><br>
                                            <input type="text" name="surname" id="surname" class="form-control" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];}?>" pattern="[A-Z a-z \´ \ˇ]*">

                                            <!-- Phone -->
                                            <label for="phone" class="text-info">Tel. číslo:</label><br>
                                            <input type="tel" name="phone" id="phone" class="form-control" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" pattern="[0-9]{10}" title="Formát: 0xxxxxxxxx">

                                            <!-- Number -->
                                            <label for="number" class="text-info">Číslo:</label><br>
                                            <input type="number" name="number" id="number" class="form-control" value="<?php if(isset($_POST['number'])){echo $_POST['number'];}?>">

                                            <!-- postal_code -->
                                            <label for="postal_code" class="text-info">PSČ:</label><br>
                                            <input type="text" name="postal_code" id="postal_code" class="form-control" value="<?php if(isset($_POST['postal_code'])){echo $_POST['postal_code'];}?>" pattern="[0-9]{5}">

                                            <!-- Password(Confirm) -->
                                            <label for="password_confirm" class="text-info">Heslo(znova)*:</label><br>
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                </div>
                        
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Registrovať">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="./login.php" class="text-info">Prihlásiť tu</a>
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