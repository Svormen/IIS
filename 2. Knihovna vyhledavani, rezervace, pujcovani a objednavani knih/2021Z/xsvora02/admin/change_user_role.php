<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
if ($_SESSION['role'] != 4) {
    header("location: ../index.php");
}
$role;
if ($_GET['role'] == 1) {
    $role = "Čitateľ";
} else if ($_GET['role'] == 2) {
    $role = "Distribútor";
} else if ($_GET['role'] == 3) {
    $role = "Knihovník";
} else if ($_GET['role'] == 4) {
    $role = "Admin";
}

if($_GET['role'] == 3){
    $librarian_lib = $db->get_librarian_lib($_GET['id']);
    $librarian_lib = $librarian_lib->fetch();
}
$libraries = $db->get_empty_libraries();

    if(isset($_GET['submit'])){
        $db->update_user_role($_GET['inlineRadioOptions'], $_GET['id']);
        if($_SESSION['id'] == $_GET['id']){
            $_SESSION['role'] = $_GET['inlineRadioOptions'];
        }
        if(($_GET['inlineRadioOptions'] == 3) && ($_GET['role'] != 3)){
            //change librarian library or add librarian to library
            $db->set_library($_GET['id'], $_GET['lib']);
        }
        if($_GET['role'] == 3){
            $librarian_lib = $db->get_librarian_lib($_GET['id']);
                $librarian_lib = $librarian_lib->fetch();
            if($_GET['inlineRadioOptions'] != 3){
                $db->update_library($librarian_lib['name']);
            }
            else if($_GET['inlineRadioOptions'] == 3){                
                $db->update_library($librarian_lib['name']);
                $db->set_library($_GET['id'], $_GET['lib']);
            }
        }
        header("location: ./user_management.php");
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

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="position: absolute;">
        <div class="container">
            <a class="navbar-brand" href="../index.php" style="color: white;">Knižnica</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 1) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../user/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                            echo '</li>';
                        } else if ($_SESSION['role'] == 2) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Objednávky</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../user/add_user.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                            echo '</li>';
                        } else if ($_SESSION['role'] == 3) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Objednať</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../user/add_user.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                            echo '</li>';
                        } else if ($_SESSION['role'] == 4) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="./reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="./add_books.php" style="text-align:center; color: white; background-color:black; width:120px">Pridať</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="./user_management.php" style="text-align:center; color: white; background-color:black; width:120px">Upraviť</a>';
                            echo '</li>';
                        }

                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../shared/profile.php" style="text-align:center; color: white; background-color:black; width:120px">Profil</a>';
                        echo '</li>';
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../shared/contact.php" style="text-align:center; color: white; background-color:black; width:120px">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <?php

                        if (isset($_SESSION['username'])) {
                            echo '<a href="../login/logout.php"><button type="button" class="btn btn-primary" style="width:120px">Odhlásiť</button></a>';
                        } else {
                            echo '<a href="../login/login.php"><button type="button" class="btn btn-primary" style="width:120px">Prihlásiť</button></a>';
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

            <div class="carousel-item" style="position:absolute;top:60;">
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
    <div style="background-color:rgba(241,241,241,255);">
        <div class="container" style="background-color:rgba(241,241,241,255); padding-top:20px">

            <div class="row d-flex justify-content-center">
                <div class="col-md-12">

                    <div class="text-center mt-3"> <h2 class="bg-secondary p-1 px-4 rounded text-white"><?php echo $role; ?></h2>
                        <div style="margin-top: 20px">
                            <h4 class="mt-2 mb-0" ><?php echo $_GET['name'] . " " . $_GET['surname'] ?></h4> 
                        </div>
                        <div style="margin-top: 20px; margin-bottom: 20px">
                            <span>E-mail: <?php echo $_GET['mail'] ?></span>
                        </div>
                        <form id="add-form" class="form" action="" method="get">
                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                            <input type="hidden" name="role" value="<?php echo $_GET['role'];?>">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" onchange="unvisible()" id="inlineRadio1" value="1" <?php if($_GET['role'] == 1) echo "checked";?>>
                                    <label class="form-check-label" for="inlineRadio1">Čitateľ</label>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" onchange="unvisible()" id="inlineRadio2" value="2" <?php if($_GET['role'] == 2) echo "checked";?>>
                                    <label class="form-check-label" for="inlineRadio2">Distribútor</label>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" onchange="visible()" id="inlineRadio3" value="3" <?php if($_GET['role'] == 3) echo "checked";?><?php if(($libraries->rowCount() == 0) && ($_GET['role'] != 3)) echo "disabled"?>>
                                    <label class="form-check-label" for="inlineRadio3">Knihovník</label>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" onchange="unvisible()" id="inlineRadio4" value="4" <?php if($_GET['role'] == 4) echo "checked";?>>
                                    <label class="form-check-label" for="inlineRadio3">Admin</label>
                                </div>
                            </div>
                            <div class="row" id="dropdown" style="<?php if($_GET['role'] == 3){echo "visibility: visible;";} else { echo "visibility: hidden;";}?>">
                                <div class="col-md-4 text-center" style="margin-top:20px">
                                    <h4>Pracuje v knižnici:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:20px">
                                    <select name="lib" id="lib" class="form-control" <?php if($libraries->rowCount() == 0) echo "disabled"?>>
                                        <?php
                                            if($_GET['role'] == 3) {echo "<option>" . $librarian_lib['name'] . "</option>";}
                                            while($library = $libraries->fetch())
                                            {
                                                echo "<option>" . $library['name'] . "</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Nastaviť">
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>


        <?php
        include '../static/footer.php';
        ?>
        <!--function for changing visibility of dropdown where admin can set library for librarian--> 
        <script type="text/javascript">
            function visible() {     
                document.getElementById("dropdown").style.visibility = "visible";
            }

            function unvisible() {     
                document.getElementById("dropdown").style.visibility = "hidden";
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>