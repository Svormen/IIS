<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();
if(!isset($_SESSION['id'])){
    header("location: ../index.php");
}
if($_SESSION['role'] != 4){
    header("location: ../index.php");
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
                            echo '<a class="nav-link" href="../user/add_user.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                            echo '</li>';
                        }
                        else if($_SESSION['role'] == 3)
                        {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Objednať</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../user/add_user.php" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
                            echo '</li>';
                        } 
                        else if($_SESSION['role'] == 4)
                        {
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
                        <div class="form-group col-md-3">
                        <label for="mail">E-mail</label>
                        <input type="text" class="form-control" id="mail" placeholder="E-mail" name="mail" value="<?php if(isset($_GET['mail'])){echo $_GET['mail'];}?>">                        
                        </div>

                        <div class="form-group col-md-3">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" placeholder="Meno" name="name" value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>">
                        </div>

                        <div class="form-group col-md-3">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" placeholder="Priezvisko" name="surname" value="<?php if(isset($_GET['surname'])){echo $_GET['surname'];}?>">
                        </div>

                        <div class="form-group col-md-3">
                        <label for="role">Rola</label>
                        <select name="role" id="role" class="form-control">
                            <option <?php if(count($_GET) != 0){if($_GET['role'] == '0'){echo "selected";}} ?> value="0">-</option>
                            <option <?php if(count($_GET) != 0){if($_GET['role'] === '1'){echo "selected";}} ?> value="1">Čitateľ</option>
                            <option <?php if(count($_GET) != 0){if($_GET['role'] == '2'){echo "selected";}} ?> value="2">Distribútor</option>
                            <option <?php if(count($_GET) != 0){if($_GET['role'] == '3'){echo "selected";}} ?> value="3">Knihovník</option>
                            <option <?php if(count($_GET) != 0){if($_GET['role'] == '4'){echo "selected";}} ?> value="4">Admin</option>
                        </select>
                        </div>

                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6 text-left">
                            <button type="button" class="btn btn-primary"style="width:100px" onclick="window.location='./user_management.php';">Zrušit</button>  
                        </div>
                        <div class="form-group col-6 text-right">
                            <button type="submit" class="btn btn-primary" style="width:100px">Filtrovať</button>  
                        </div>
                    </div>
                </form>

                <table class="table table-striped table-dark" style="margin-bottom:0px">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Meno</th>
                        <th scope="col">Priezvisko</th>
                        <th class="hide" scope="col">Rola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $users;
                            if(count($_GET) == 0){
                                $users = $db->get_users();
                            }
                            else {
                                if(empty($_GET['mail']) && empty($_GET['name']) && empty($_GET['surname']) && ($_GET['role'] == '0')){
                                    $users = $db->get_users();
                                }
                                else
                                {
                                    $final_string = "SELECT id, mail, name, surname, role FROM user WHERE ";
                                    $number_of_handled = 0;

                                    if(!empty($_GET['mail']))
                                    {
                                        $final_string = $final_string . " mail regexp '" . $_GET['mail'] . "'";
                                        $number_of_handled++;
                                    }
                                    
                                    if(!empty($_GET['name']))
                                    {
                                        if($number_of_handled == 0)
                                        {
                                            $final_string = $final_string . " name regexp '" . $_GET['name'] . "'";
                                        } else 
                                        {
                                            $final_string = $final_string . " AND name regexp '" . $_GET['name'] . "'";
                                        }
                                        $number_of_handled++;
                                    }

                                    if(!empty($_GET['surname']))
                                    {
                                        if($number_of_handled == 0)
                                        {
                                            $final_string = $final_string . " surname regexp '" . $_GET['surname'] . "'";
                                        } else 
                                        {
                                            $final_string = $final_string . " AND surname regexp '" . $_GET['surname'] . "'";
                                        }
                                        $number_of_handled++;
                                    }
                                
                                    if($_GET['role'] != '0')
                                    {
                                        if($number_of_handled == 0)
                                        {
                                            $final_string = $final_string . " role= '" . $_GET['role'] . "'";
                                        } else 
                                        {
                                            $final_string = $final_string . " AND role= '" . $_GET['role'] . "'";
                                        }
                                        $number_of_handled++;                                        
                                    }

                                    $users = $db->get_filtered($final_string);
                                }
                            }
                            
                            while($user = $users->fetch())
                            {
                                if($user['role'] == 1){$role = "Čitateľ";}
                                else if($user['role'] == 2){$role = "Distribútor";}
                                else if($user['role'] == 3){$role = "Knihovník";}
                                 else if($user['role'] == 4){$role = "Admin";}
                                echo "<tr>";
                                echo '<td style="vertical-align:middle"><b>'.$user['mail'].'</b></td>';
                                echo '<td style="vertical-align:middle"><b>'.$user['name'].'</b></td>';
                                echo '<td style="vertical-align:middle"><b>'.$user['surname'].'</b></td>';
                                echo '<td style="vertical-align:middle"><b>'.$role.'</b></td>';
                                echo '<td style="vertical-align:middle"><b> <button type="button" onclick="window.location.href='."'./change_user_role.php?mail=". $user['mail']. "&name=" . $user['name'] . "&surname=" . $user['surname'] . "&role=" . $user['role'] .  "&id=" . $user['id'] . "'" . '" class="btn btn-primary" style="margin-top:10px">Spravovať</button></b></td>';
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