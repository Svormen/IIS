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
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Objednávky</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
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
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                    } 
                    else if($_SESSION['role'] == 4)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
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
                <a class="nav-link" href="../shared/contact.php" style="text-align:center; color: white; background-color:black; width:120px">Kontakt</a>
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
    # preparing information about book
    $book = $db->get_book($_GET['isbn']);
    ?>

    <div style="background-color:rgba(241,241,241,255); padding-bottom:20px; padding-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-5 text-center">
                    <?php
                    echo '<img src="../images/books/' . $book['isbn'] . '.png" style="width:20vw" />';
                    ?>
                </div>
                <div class="col-md-7">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                        echo '<h2>'. $book['name'] . '</h2>';
                        ?>
                        <hr/>
                    </div>
                    
                    <div class="col-md-12 text-center" style="margin-top:30px">
                        <?php
                        echo '<h4>Vydavateľ: '. $book['publisher'] . '</h4>';
                        ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Autori: '. $book['authors'] . '</h4>';
                    ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Rok vydania: '. $book['year'] . '</h4>';
                    ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Žáner: '. $book['genre'] . '</h4>';
                    ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>Hodnotenie: '. $book['rating'] . '</h4>';
                    ?>
                    </div>
                    <div class="col-md-12 text-center">
                    <?php
                        echo '<h4>ISBN: '. $book['isbn'] . '</h4>';
                    ?>
                    </div>
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-md-12">
                    <h2>Dostupnosť:
                    <?php
                    if(!isset($_SESSION['username']))
                    {
                        echo ' (Pre rezerváciu je potrebné sa prihlásiť)';
                    }
                    ?>
                    </h2>
                </div>
            </div>
            
            <table class="table table-striped table-dark" style="margin-bottom:0px">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Knižnica</th>
                    <th scope="col">Názov</th>
                    <th scope="col">Počet ks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // generating information about availability in libraries
                    $libraries = $db->get_libs();
                    while ($library = $libraries->fetch())
                    {
                        $name = str_replace(' ', '', $library['name']);
                        echo "<tr>";
                        echo '<td> <img src="../images/libraries/'.$name.'.png" style="width:180px"/> </td>';
                        echo '<td style="vertical-align:middle"><b>'.$library['name'].'</b></td>';
                        // need to know how many pieced there is in each library of specific book
                        $count = $db->get_num_of_books_in_lib($book['isbn'], $library['name']);
                        echo '<td style="vertical-align:middle"><b>'.$count['count'].'</b>';
                        if(isset($_SESSION['username']))
                        {
                            // rendering buttons depending on roles of users and availability of book
                            if(($_SESSION['role'] == 1) &&($count['count'] > 0))
                            {
                                $reservation = $db->reservation_exists($_SESSION['id'], $book['isbn']);
                                
                                if($reservation['count'] == 0)
                                {
                                    echo '<br/>';
                                    
                                    echo '<button type="button" onclick="window.location.href='."'../user/confirm_res.php?isbn=". $book['isbn']. "&lib_name=". $library['name'] . "'" . '" class="btn btn-primary" style="margin-top:10px">Rezervovať</button>';
                                    
                                    
                                } else {
                                    echo '<br/>';
                                    echo '<button type="button" onclick="window.location.href='."'#". "'" . '" class="btn btn-primary" style="margin-top:10px" disabled>Aktuálne rezervované</button>';
                                    
                                }
                                
                            } else if (($_SESSION['role'] == 1) &&($count['count'] == 0))
                            {
                                $vote = $db->user_vote($_SESSION['id'], $book['isbn'], $library['name']);
                                if(array_key_exists('button1', $_POST)) 
                                { 
                                    if($vote['count'] == 0)
                                    {
                                        $db->add_vote($_SESSION['id'], $book['isbn'], $library['name']);
                                    } 
                                    echo '<br/>';
                                    echo '<form method="post"> ';
                                    echo '<button disabled type="submit" name="button1" class="btn btn-primary" style="margin-top:10px">Už ste hlasovali za dokúpenie</button>';
                                    echo '</form> ';
                                } else if($vote['count'] != 0) 
                                { 
                                    echo '<br/>';
                                    echo '<form method="post"> ';
                                    echo '<button disabled type="submit" name="button1" class="btn btn-primary" style="margin-top:10px">Už ste hlasovali za dokúpenie</button>';
                                    echo '</form> ';
                                } else if($vote['count'] == 0)
                                {
                                    echo '<br/>';
                                    echo '<form method="post"> ';
                                    echo '<button type="submit" name="button1" class="btn btn-primary" style="margin-top:10px">Hlasovať za dokúpenie</button>';
                                    echo '</form> ';
                                }
                                
                                
                            }
                            
                        } else 
                        {
                            echo '<br/>';
                            echo '<button type="button" onclick="window.location.href='."'../login/login.php". "'" . '" class="btn btn-primary" style="margin-top:10px">Prihlásiť sa</button>';
                        }
                           
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php

            ?>
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