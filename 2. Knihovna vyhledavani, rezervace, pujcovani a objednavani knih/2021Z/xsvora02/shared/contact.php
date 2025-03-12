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
                            echo '<a class="nav-link" href="../book/add_book.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../admin/user_management.php" style="text-align:center; color: white; background-color:black; width:120px">Upraviť</a>';
                            echo '</li>';
                        }

                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="./profile.php" style="text-align:center; color: white; background-color:black; width:120px">Profil</a>';
                        echo '</li>';
                    }
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Kontakt</a>
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
                        <h3>Filter</h3>
                        <hr>
                    </div>
                </div>
                <form method='get'>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="name">Názov</label>
                        <input type="text" class="form-control" id="name" placeholder="Názov" name="name" value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>">
                        </div>

                        <div class="form-group col-md-4">
                        <label for="city">Mesto</label>
                        <input type="text" class="form-control" id="city" placeholder="Mesto" name="city" value="<?php if(isset($_GET['city'])){echo $_GET['city'];}?>">
                        </div>

                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4 text-right">
                            <button type="button" class="btn btn-primary"style="width:100px" onclick="window.location='./contact.php';">Zrušit</button>  
                        </div>
                        <div class="form-group col-4 text-right">
                            <button type="submit" class="btn btn-primary" style="width:100px">Filtrovať</button>  
                        </div>
                        <div class="form-group col-4 text-right">
                            <button type="button" class="btn btn-primary"  onclick="window.location.href='./contact_add_lib.php'">Pridať Knižnicu</button>  
                        </div>
                    </div>
                </form>

                <table class="table table-striped table-dark" style="margin-bottom:0px">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Knižnica</th>
                        <th scope="col">Názov</th>
                        <th scope="col">Knihovník</th>
                        <th scope="col">Mesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $libs;
                            if(count($_GET) == 0){
                                $libs = $db->get_libs();
                            }
                            else {
                                if(empty($_GET['name']) && empty($_GET['city'])){
                                    $libs = $db->get_libs();
                                }
                                else
                                {
                                    $final_string = "SELECT * FROM library LEFT JOIN address ON library.address_id = address.id WHERE ";
                                    $number_of_handled = 0;

                                    if(!empty($_GET['name']))
                                    {
                                        $final_string = $final_string . " library.name regexp '" . $_GET['name'] . "'";
                                        $number_of_handled++;
                                    }
                                    
                                    if(!empty($_GET['city']))
                                    {
                                        if($number_of_handled == 0)
                                        {
                                            $final_string = $final_string . " address.city regexp '" . $_GET['city'] . "'";
                                        } else 
                                        {
                                            $final_string = $final_string . " AND address.city regexp '" . $_GET['city'] . "'";
                                        }
                                        $number_of_handled++;
                                    }

                                    $libs = $db->get_filtered($final_string);
                                }
                            }
                            
                            while($lib = $libs->fetch())
                            {   
                                $name = str_replace(' ', '', $lib['name']);
                                if($lib['user_id'] != NULL)
                                    $librarian = $db->get_surname($lib['user_id']);
                                else{
                                    $librarian['name'] = '';
                                    $librarian['surname'] = '';
                                }
                                if($lib['address_id'] != NULL)
                                    $address = $db->get_user_address($lib['address_id']);
                                else
                                    $address['city'] = '';
                                echo "<tr>";
                                echo '<td style="vertical-align:middle"><img src="../images/libraries/'.$name.'.png" style="width:180px"/></td>';
                                echo '<td style="vertical-align:middle"><b>'.$lib['name'].'</b></td>';
                                echo '<td style="vertical-align:middle"><b>'.$librarian['name'] . " " . $librarian['surname'] .'</b></td>';
                                echo '<td style="vertical-align:middle"><b>'.$address['city'].'</b></td>';
                                if((!isset($_SESSION['id'])) || ($_SESSION['role'] == 1)){ echo '<td style="vertical-align:middle"><button type="button" onclick="window.location.href='."'./contact_user.php?lib_name=". $lib['name']. "'" . '" class="btn btn-primary" style="margin-top:10px">Otvoriť</button></td>';}
                                
                                if((isset($_SESSION['id'])) && ($_SESSION['role'] == 3) && ($lib['user_id'] != $_SESSION['id'])){ echo '<td style="vertical-align:middle"><button type="button" onclick="window.location.href='."'./contact_user.php?lib_name=". $lib['name']. "'" . '" class="btn btn-primary" style="margin-top:10px">Otvoriť</button></td>';}
                                if((isset($_SESSION['id'])) && ($_SESSION['role'] == 3) && ($lib['user_id'] == $_SESSION['id'])){ echo '<td style="vertical-align:middle"><button type="button" onclick="window.location.href='."'./contact_admin.php?lib_name=". $lib['name']. "'" . '" class="btn btn-primary" style="margin-top:10px">Spravovať</button></td>';}
                                
                                if((isset($_SESSION['id'])) && ($_SESSION['role'] == 4)){ echo '<td style="vertical-align:middle"><button type="button" onclick="window.location.href='."'./contact_admin.php?lib_name=". $lib['name']. "'" . '" class="btn btn-primary" style="margin-top:10px">Spravovať</button></td>';}
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
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