<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();
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
            <span class="navbar-toggler-icon" ></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <?php
                if(isset($_SESSION['role']))
                {
                    if($_SESSION['role'] == 1)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../user/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                    } 
                    else if($_SESSION['role'] == 2)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../orders/orders.php" style="text-align:center; color: white; background-color:black; width:120px">Objednávky</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                    }
                    else if($_SESSION['role'] == 3)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../librarian/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../librarian/order.php" style="text-align:center; color: white; background-color:black; width:120px">Objednať</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                    } 
                    else if($_SESSION['role'] == 4)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../admin/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../admin/add_books.php" style="text-align:center; color: white; background-color:black; width:120px">Pridať</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../admin/user_management.php" style="text-align:center; color: white; background-color:black; width:120px">Upraviť</a>';
                        echo '</li>';
                    }

                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="../shared/profile.php" style="text-align:center; color: white; background-color:black; width:120px">Profil</a>';
                    echo '</li>';
                }
                ?>
                <li class="nav-item">
                <a class="nav-link" href="./contact.php" style="text-align:center; color: white; background-color:black; width:120px">Kontakt</a>
                </li>
                <li class="nav-item">
                <?php
                
                if(isset($_SESSION['username']))
                {
                    echo '<a href="../login/logout.php"><button type="button" class="btn btn-primary" style="width:120px">Odhlásiť</button></a>';
                } else
                {
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
    
    <?php
    $lib = $db->get_lib($_GET['lib_name']);
    $name = str_replace(' ', '', $_GET['lib_name']);
    if($lib['user_id'] != NULL)
        $librarian = $db->get_surname($lib['user_id']);
    else {
        $librarian['name'] = '';
        $librarian['surname'] = '';
    }
    if ($lib['address_id'] != NULL){
        $address_tmp = $db->get_user_address($lib['address_id']);
        $address = $address_tmp['street'] . ", " . $address_tmp['number'] . ", " . $address_tmp['postal_code'] . ", " . $address_tmp['city'];
    }
    else
        $address = '';

    $hours = explode(' ', $lib['opening_hours']);
    ?>

    <div style="background-color:rgba(241,241,241,255); padding-bottom:20px; padding-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-5 text-center" style="margin: auto;">
                    <?php
                    echo '<img src="../images/libraries/' . $name . '.png" style="width:20vw" />';
                    ?>
                </div>
                <div class="col-md-7">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                        echo '<h2>'. $lib['name'] . '</h2>';
                        ?>
                        <hr/>
                    </div>
                    
                    <div class="col-md-12 text-center" style="margin-top:30px">
                        <?php
                        echo '<h4>Knihovník: '. $librarian['name'] . " " . $librarian['surname'] . '</h4>';
                        ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Adresa: '. $address . '</h4>';
                    ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Informácie: </h4>'. $lib['description'];
                    ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Otváracie hodiny: </h4>';
                        foreach($hours as $hour => $val) {
                            if($val == "-")
                                $val = "Zatvorené";
                            if($hour == 1)
                                echo "Pondelok: $val_before - $val<br>";
                            if($hour == 3)
                                echo "Utorok: $val_before - $val<br>";
                            if($hour == 5)
                                echo "Streda: $val_before - $val<br>";
                            if($hour == 7)
                                echo "Štvrtok: $val_before - $val<br>";
                            if($hour == 9)
                                echo "Piatok: $val_before - $val<br>";
                            if($hour == 11)
                                echo "Sobota: $val_before - $val<br>";
                            if($hour == 13)
                                echo "Nedeľa: $val_before - $val<br>";
                            $val_before = $val;
                          }
                    ?>
                    </div>
                    </div>
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