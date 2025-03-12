<?php
require "services/component.php";
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
            <a class="navbar-brand" href="./index.php" style="color: white;">Knižnica</a>
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
                        echo '<a class="nav-link" href="./user/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                    } 
                    else if($_SESSION['role'] == 2)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./orders/orders.php" style="text-align:center; color: white; background-color:black; width:120px">Objednávky</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                    }
                    else if($_SESSION['role'] == 3)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./librarian/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./librarian/order.php" style="text-align:center; color: white; background-color:black; width:120px">Objednať</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                    } 
                    else if($_SESSION['role'] == 4)
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./admin/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./admin/add_books.php" style="text-align:center; color: white; background-color:black; width:120px">Pridať</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./admin/user_management.php" style="text-align:center; color: white; background-color:black; width:120px">Upraviť</a>';
                        echo '</li>';
                    }

                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="./shared/profile.php" style="text-align:center; color: white; background-color:black; width:120px">Profil</a>';
                    echo '</li>';
                }
                ?>
                <li class="nav-item">
                <a class="nav-link" href="./shared/contact.php" style="text-align:center; color: white; background-color:black; width:120px">Kontakt</a>
                </li>
                <li class="nav-item">
                <?php
                
                if(isset($_SESSION['username']))
                {
                    echo '<a href="./login/logout.php"><button type="button" class="btn btn-primary" style="width:120px">Odhlásiť</button></a>';
                } else
                {
                    echo '<a href="./login/login.php"><button type="button" class="btn btn-primary" style="width:120px">Prihlásiť</button></a>';
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
            <img class="d-block w-100" src="images/header_images/image3.png" alt="First slide" style="position:absolute;top:60;">
            </div>
            
            <div class="carousel-item"  style="position:absolute;top:60;">
            <img class="d-block w-100" src="images/header_images/image2.png" alt="Second slide">
            </div>

            <div class="carousel-item">
            <img class="d-block w-100" src="images/header_images/image1.png" alt="Third slide">
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
    $genres = $db->get_genres();
    ?>

    <div style="background-color:rgba(241,241,241,255); padding-bottom:20px">
        <div class="container" style="background-color:rgba(241,241,241,255); padding-top:20px">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <h3>Filter</h3>
                    <hr>
                </div>
            </div>
            <form method='get'>
                <div class="form-row">
                    <div class="form-group col-md-3">
                    <label for="inputEmail4">Názov knihy</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Názov knihy" name="nazov" 
                    <?php 
                    if(count($_GET) == 0)
                    {
                        ;
                    } else
                    {
                        if (!(empty($_GET['nazov'])))
                        {
                            echo 'value="'.$_GET['nazov'].'"';
                        }
                    }
                    ?>>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="inputPassword4">Vydavateľstvo</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Vydavateľstvo" name="vydavatelstvo"
                    <?php 
                    if(count($_GET) == 0)
                    {
                        ;
                    } else
                    {
                        if (!(empty($_GET['vydavatelstvo'])))
                        {
                            echo 'value="'.$_GET['vydavatelstvo'].'"';
                        }
                    }
                    ?>>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="inputPassword4">Autor</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Autor" name="autor"
                    <?php 
                    if(count($_GET) == 0)
                    {
                        ;
                    } else
                    {
                        if (!(empty($_GET['autor'])))
                        {
                            echo 'value="'.$_GET['autor'].'"';
                        }
                    }
                    ?>>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="inputState">Žáner</label>
                    <select id="inputState" class="form-control" name="zaner"
                    <?php 
                    if(count($_GET) == 0)
                    {
                        ;
                    } else
                    {
                        if (!(empty($_GET['zaner'])))
                        {
                            echo 'value="'.$_GET['zaner'].'"';
                        }
                    }
                    ?>>
                        <option selected>-</option>
                        <?php
                        while($genre = $genres->fetch())
                        {
                            if((count($_GET) != 0) && (!(empty($_GET['zaner'])))){
                                if ($_GET['zaner'] === $genre['genre']){
                                    echo "<option selected>".$genre['genre']."</option>";
                                } else {
                                    echo "<option>".$genre['genre']."</option>";
                                }
                            } else {
                                echo "<option>".$genre['genre']."</option>";
                            }
                            
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6 text-left">
                        <button type="button" class="btn btn-primary"style="width:100px" onclick="window.location='./index.php';">Zrušit</button>  
                    </div>
                    <div class="form-group col-6 text-right">
                        <button type="submit" class="btn btn-primary" style="width:100px">Filtrovať</button>  
                    </div>
                </div>
            </form>

            <table class="table table-striped table-dark" style="margin-bottom:0px">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Kniha</th>
                    <th scope="col">Názov</th>
                    <th scope="col">Autori</th>
                    <th class="hide" scope="col">Žáner</th>
                    <th class="hide" scope="col">Ks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // listing all books from db, when there is no filter set
                    if(count($_GET) == 0)
                    {
                        $books = $db->get_books();
                        while($book = $books->fetch())
                        {
                            echo "<tr>";
                            echo '<td> <img src="images/books/'.$book['isbn'].'.png" style="width:120px"/> </td>';
                            echo '<td style="vertical-align:middle"><b>'.$book['name'].'</b><br/><button type="button" onclick="window.location.href='."'./book/book.php?isbn=". $book['isbn']. "'" . '" class="btn btn-primary" style="margin-top:10px">Otvoriť</button></td>';
                            echo '<td style="vertical-align:middle"><b>'.$book['authors'].'</b></td>';
                            echo '<td class="hide" style="vertical-align:middle"><b>'.$book['genre'].'</b></td>';

                            // i need to know how many pieces of each book there are available
                            $count = $db->get_total_sum_of_book($book['isbn']);
                            echo '<td class="hide" style="vertical-align:middle"><b>'.$count['count'].'</b></td>';
                            echo '</tr>';
                        }
                    } else 
                    {
                        // if nothing is set to anything then i also display all books
                        if(empty($_GET['nazov']) && empty($_GET['vydavatelstvo']) && empty($_GET['autor']) && ($_GET['zaner'] === '-' ))
                        {
                            $books = $db->get_books();
                            while($book = $books->fetch())
                            {
                                echo "<tr>";
                                echo '<td> <img src="images/books/'.$book['isbn'].'.png" style="width:120px"/> </td>';
                                echo '<td style="vertical-align:middle"><b>'.$book['name'].'</b><br/><button type="button" onclick="window.location.href='."'./book/book.php?isbn=". $book['isbn']. "'" . '" class="btn btn-primary" style="margin-top:10px">Otvoriť</button></td>';
                                echo '<td style="vertical-align:middle"><b>'.$book['authors'].'</b></td>';
                                echo '<td class="hide" style="vertical-align:middle"><b>'.$book['genre'].'</b></td>';

                                // i need to know how many pieces of each book there are available
                                $count = $db->get_total_sum_of_book($book['isbn']);
                                echo '<td class="hide" style="vertical-align:middle"><b>'.$count['count'].'</b></td>';
                                echo '</tr>';
                            }
                        } else 
                        {
                            // this else handles filter -> creates string that will be send to db and after that handle the rendering of filtered books
                            $final_string = "SELECT isbn, name, authors, publisher, genre FROM book WHERE";
                            $number_of_conditions = 0;
                            $number_of_handled = 0;
                            if(!empty($_GET['nazov'])) $number_of_conditions++;
                            if(!empty($_GET['vydavatelstvo'])) $number_of_conditions++;
                            if(!empty($_GET['autor'])) $number_of_conditions++;
                            if($_GET['zaner'] !== '-') $number_of_conditions++;
                            
                            if(!empty($_GET['nazov']))
                            {
                                $final_string = $final_string . " name regexp '" . $_GET['nazov'] . "'";
                                $number_of_handled++;
                            }

                            if(!empty($_GET['vydavatelstvo']))
                            {
                                if($number_of_handled == 0)
                                {
                                    $final_string = $final_string . " publisher regexp '" . $_GET['vydavatelstvo'] . "'";
                                } else 
                                {
                                    $final_string = $final_string . " AND publisher regexp '" . $_GET['vydavatelstvo'] . "'";
                                }
                                $number_of_handled++;
                            }

                            if(!empty($_GET['autor']))
                            {
                                if($number_of_handled == 0)
                                {
                                    $final_string = $final_string . " authors regexp '" . $_GET['autor'] . "'";
                                } else 
                                {
                                    $final_string = $final_string . " AND authors regexp '" . $_GET['autor'] . "'";
                                }
                                $number_of_handled++;
                            }

                            if($_GET['zaner'] !== '-')
                            {
                                if($number_of_handled == 0)
                                {
                                    $final_string = $final_string . " genre regexp '" . $_GET['zaner'] . "'";
                                } else 
                                {
                                    $final_string = $final_string . " AND genre regexp '" . $_GET['zaner'] . "'";
                                }
                                $number_of_handled++;
                            }

                            //echo $final_string;

                            $books = $db->get_filtered($final_string);
                            while($book = $books->fetch())
                            {
                                echo "<tr>";
                                echo '<td> <img src="images/books/'.$book['isbn'].'.png" style="width:120px"/> </td>';
                                echo '<td style="vertical-align:middle"><b>'.$book['name'].'</b><br/><button type="button" onclick="window.location.href='."'./book/book.php?isbn=". $book['isbn']. "'" . '" class="btn btn-primary" style="margin-top:10px">Otvoriť</button></td>';
                                echo '<td style="vertical-align:middle"><b>'.$book['authors'].'</b></td>';
                                echo '<td class="hide" style="vertical-align:middle"><b>'.$book['genre'].'</b></td>';

                                // i need to know how many pieces of each book there are available
                                $count = $db->get_total_sum_of_book($book['isbn']);
                                echo '<td class="hide" style="vertical-align:middle"><b>'.$count['count'].'</b></td>';
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
    include './static/footer.php';
    ?>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>