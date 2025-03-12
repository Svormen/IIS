<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();
if($_SESSION['role'] == 1 || $_SESSION['role'] == 2 || $_SESSION['role'] == 4){
    header("location: ../index.php");
}
if(!isset($_SESSION['role'])){
    header("location: ../index.php");
}
// need to know in which library this librarian works
$library = $db->what_library($_SESSION['id'])['name'];

if(isset($_GET['picked']))
{
    $db->reservation_is_picked($_GET['id_res']);
    header("location: ./reservations.php");
}

if(isset($_GET['returned']))
{
    $db->book_returned($_GET['id_res']);
    header("location: ./reservations.php");
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
                        echo '<a class="nav-link" href="./add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
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
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="../admin/add_books.php" style="text-align:center; color: white; background-color:black; width:120px">Pridať</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Upraviť</a>';
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

    <div style="background-color:rgba(241,241,241,255); padding-bottom:20px">
        <div class="container" style="background-color:rgba(241,241,241,255); padding-top:20px">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <h3>Rezervácie v knižnici: <?php echo $library;?></h3>
                    <hr>
                </div>
            </div>
            <form method='get'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ID čitateľa</label>
                        <input type="number" class="form-control" id="inputEmail4" placeholder="ID Čitateľa" name="reader" 
                        <?php 
                        if(count($_GET) == 0)
                        {
                            ;
                        } else
                        {
                            if (!(empty($_GET['reader'])))
                            {
                                echo 'value="'.$_GET['reader'].'"';
                            }
                        }
                        ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Stav rezervácie</label>
                        <select id="inputState" class="form-control" name="status">
                        <option selected>-</option>
                        <option <?php if(count($_GET) != 0 && $_GET['status'] == 'Vytvorená'){echo 'selected';}?>>Vytvorená</option>
                        <option <?php if(count($_GET) != 0 && $_GET['status'] == 'Vyzdvihnutá'){echo 'selected';}?>>Vyzdvihnutá</option>
                        <option <?php if(count($_GET) != 0 && $_GET['status'] == 'Zrušená'){echo 'selected';}?>>Zrušená</option>
                        <option <?php if(count($_GET) != 0 && $_GET['status'] == 'Po splatnosti'){echo 'selected';}?>>Po splatnosti</option>
                        <option <?php if(count($_GET) != 0 && $_GET['status'] == 'Vrátená'){echo 'selected';}?>>Vrátená</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6 text-left">
                        <button type="button" class="btn btn-primary"style="width:100px" onclick="window.location='./reservations.php';">Zrušit</button>  
                    </div>
                    <div class="form-group col-6 text-right">
                        <button type="submit" class="btn btn-primary" style="width:100px" name="submit">Filtrovať</button>  
                    </div>
                </div>
            </form>

            <table class="table table-striped table-dark" style="margin-bottom:0px">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Kniha</th>
                    <th scope="col">Stav</th>
                    <th scope="col">ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!isset($_GET['submit']))
                    {
                        // when filter is not applied then i have to list all reservations from system in library in which this librarian works in
                        $reservations = $db->get_reservations_in_library($library);
                        while($reservation = $reservations->fetch())
                        {
                            if($reservation['status'] == 1) $status = 'Vytvorená';
                            else if ($reservation['status'] == 2) $status = 'Vyzdvihnutá';
                            else if ($reservation['status'] == 3) $status = 'Zrušená';
                            else if ($reservation['status'] == 4) $status = 'Po splatnosti';
                            else $status = 'Vrátená';

                            $name = $db->get_surname($reservation['user_id'])['name'];
                            $surname = $db->get_surname($reservation['user_id'])['surname'];

                            echo "<tr>";
                            echo '<td> <img src="../images/books/'.$reservation['book_isbn'].'.png" style="width:10vw"/> </td>';
                            echo '<td style="vertical-align:middle"><b>'. $status;
                            if($reservation['status'] == 1)
                            {
                                echo '<br/> Vyzdvihnúť do: ';
                                echo $reservation['date_end'];
                                echo '<form method="get">';
                                echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                echo '<button type="submit" name="picked" class="btn btn-primary" style="margin-top:10px">Vyzdvihnutá</button>';
                                echo '</form>';
                            } else if ($reservation['status'] == 2)
                            {
                                // reservation is in state when reader has book at home, so i need to display date when resrevation is ending
                                echo '<br/> Vrátiť do: ';
                                echo $reservation['date_end'];
                                // also i need to add button that signals that reader returned the book to library so i need to change status to 5
                                echo '<form method="get">';
                                echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                echo '<button type="submit" name="returned" class="btn btn-primary" style="margin-top:10px">Vrátená</button>';
                                echo '</form>';
                            } else if ($reservation['status'] == 4)
                            {
                                // if reservation is in status 4 -> that means that reader forgot to return book in a specific time
                                echo '<br/> Kniha mala byť vrátená: ';
                                echo $reservation['date_end'];
                                echo '<form method="get">';
                                echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                echo '<button type="submit" name="returned" class="btn btn-primary" style="margin-top:10px">Zaplatil pokutu a vrátil</button>';
                                echo '</form>';
                            }
                            echo '</b></td>';
                            echo '<td style="vertical-align:middle"><br>' . $reservation['user_id'] . '</br>' . $name . ' ' .$surname . '</b></td>';
                            echo '</tr>';
                        }
                    } else
                    {
                        if(empty($_GET['reader']) && $_GET['status'] == '-')
                        {
                            $reservations = $db->get_reservations_in_library($library);
                            while($reservation = $reservations->fetch())
                        {
                            if($reservation['status'] == 1) $status = 'Vytvorená';
                            else if ($reservation['status'] == 2) $status = 'Vyzdvihnutá';
                            else if ($reservation['status'] == 3) $status = 'Zrušená';
                            else if ($reservation['status'] == 4) $status = 'Po splatnosti';
                            else $status = 'Vrátená';

                            $name = $db->get_surname($reservation['user_id'])['name'];
                            $surname = $db->get_surname($reservation['user_id'])['surname'];

                            echo "<tr>";
                            echo '<td> <img src="../images/books/'.$reservation['book_isbn'].'.png" style="width:10vw"/> </td>';
                            echo '<td style="vertical-align:middle"><b>'. $status;
                            if($reservation['status'] == 1)
                            {
                                echo '<br/> Vyzdvihnúť do: ';
                                echo $reservation['date_end'];
                                echo '<form method="get">';
                                echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                echo '<button type="submit" name="picked" class="btn btn-primary" style="margin-top:10px">Vyzdvihnutá</button>';
                                echo '</form>';
                            } else if ($reservation['status'] == 2)
                            {
                                // reservation is in state when reader has book at home, so i need to display date when resrevation is ending
                                echo '<br/> Vrátiť do: ';
                                echo $reservation['date_end'];
                                // also i need to add button that signals that reader returned the book to library so i need to change status to 5
                                echo '<form method="get">';
                                echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                echo '<button type="submit" name="returned" class="btn btn-primary" style="margin-top:10px">Vrátená</button>';
                                echo '</form>';
                            } else if ($reservation['status'] == 4)
                            {
                                // if reservation is in status 4 -> that means that reader forgot to return book in a specific time
                                echo '<br/> Kniha mala byť vrátená: ';
                                echo $reservation['date_end'];
                                echo '<form method="get">';
                                echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                echo '<button type="submit" name="returned" class="btn btn-primary" style="margin-top:10px">Zaplatil pokutu a vrátil</button>';
                                echo '</form>';
                            }
                            echo '</b></td>';
                            echo '<td style="vertical-align:middle"><br>' . $reservation['user_id'] . '</br>' . $name . ' ' .$surname . '</b></td>';
                            echo '</tr>';
                        }
                        } else
                        {
                            $final_string = "SELECT * FROM reservation WHERE lib_name='" . $library . "'";
                            if(!empty($_GET['reader']))
                            {
                                $final_string = $final_string . " and user_id=" . $_GET['reader'];
                            }

                            if(!empty($_GET['status']))
                            {
                                if($_GET['status'] != '-')
                                {
                                    if($_GET['status'] == 'Vytvorená') $st = 1;
                                    else if($_GET['status'] == 'Vyzdvihnutá') $st = 2;
                                    else if($_GET['status'] == 'Zrušená') $st = 3;
                                    else if($_GET['status'] == 'Po splatnosti') $st = 4;
                                    else $st = 5;
                                    $final_string = $final_string . " and status=" . $st;
                                }
                                
                            }

                            $reservations = $db->get_filtered($final_string);
                            while($reservation = $reservations->fetch())
                            {
                                if($reservation['status'] == 1) $status = 'Vytvorená';
                                else if ($reservation['status'] == 2) $status = 'Vyzdvihnutá';
                                else if ($reservation['status'] == 3) $status = 'Zrušená';
                                else if ($reservation['status'] == 4) $status = 'Po splatnosti';
                                else $status = 'Vrátená';

                                $name = $db->get_surname($reservation['user_id'])['name'];
                                $surname = $db->get_surname($reservation['user_id'])['surname'];

                                echo "<tr>";
                                echo '<td> <img src="../images/books/'.$reservation['book_isbn'].'.png" style="width:10vw"/> </td>';
                                echo '<td style="vertical-align:middle"><b>'. $status;
                                if($reservation['status'] == 1)
                                {
                                    echo '<br/> Vyzdvihnúť do: ';
                                    echo $reservation['date_end'];
                                    echo '<form method="get">';
                                    echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                    echo '<button type="submit" name="picked" class="btn btn-primary" style="margin-top:10px">Vyzdvihnutá</button>';
                                    echo '</form>';
                                } else if ($reservation['status'] == 2)
                                {
                                    // reservation is in state when reader has book at home, so i need to display date when resrevation is ending
                                    echo '<br/> Vrátiť do: ';
                                    echo $reservation['date_end'];
                                    // also i need to add button that signals that reader returned the book to library so i need to change status to 5
                                    echo '<form method="get">';
                                    echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                    echo '<button type="submit" name="returned" class="btn btn-primary" style="margin-top:10px">Vrátená</button>';
                                    echo '</form>';
                                } else if ($reservation['status'] == 4)
                                {
                                    // if reservation is in status 4 -> that means that reader forgot to return book in a specific time
                                    echo '<br/> Kniha mala byť vrátená: ';
                                    echo $reservation['date_end'];
                                    echo '<form method="get">';
                                    echo '<input type="hidden" name="id_res" value="'. $reservation['id'] . '">';
                                    echo '<button type="submit" name="returned" class="btn btn-primary" style="margin-top:10px">Zaplatil pokutu a vrátil</button>';
                                    echo '</form>';
                                }
                                echo '</b></td>';
                                echo '<td style="vertical-align:middle"><br>' . $reservation['user_id'] . '</br>' . $name . ' ' .$surname . '</b></td>';
                                echo '</tr>';
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include '../static/footer.php';
    ?>
    <!--function for setting URL to image src--> 
    <script type="text/javascript">
        function myFunction() {
            var url = document.getElementById("photo").value;
            var image = document.getElementById('image');
            if(url == ""){
                image.src = "../images/books/ref.png";
            }
            else{            
                image.src = url;
            }
        }
    </script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>