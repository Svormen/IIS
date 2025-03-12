<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();

if(isset($_GET['equipped']))
{
    $db->order_done($_GET['count'], $_GET['lib'], $_GET['isbn']);
    $db->delete_from_order($_GET['id_ord']);
    header("location: ./orders.php");
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
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Rezervácie</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Objednať</a>';
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
                <h3>Objednávky:</h3>
                <hr>
            </div>
        </div>
        <form method='get'>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputEmail4">V knižnici</label>
                    <select id="inputState" class="form-control" name="lib">
                    <option selected>-</option>
                    <?php
                    $libs = $db->get_libs();
                    while($lib = $libs->fetch())
                    {
                        echo "<option";
                        if(count($_GET) != 0 && $_GET['lib'] == $lib['name'])
                        {
                        echo " selected";
                        }
                        echo ">".$lib['name']."</option>";
                    }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6 text-left">
                    <button type="button" class="btn btn-primary"style="width:100px" onclick="window.location='./orders.php';">Zrušit</button>
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
                <th scope="col">Knižnica</th>
                <th scope="col">Ks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!isset($_GET['submit']))
                {
                    // when filter is not applied then i have to list all reservations from system in library in which this librarian works in
                    $orders = $db->get_orders_in_all_libraries();
                    while($order = $orders->fetch())
                    {
                        echo "<tr>";
                        echo '<td> <img src="../images/books/'.$order['book_isbn'].'.png" style="width:10vw"/> </td>';
                        echo '<td style="vertical-align:middle"><b>'. $order['lib_name'] .'</b></td>';
                        echo '<td style="vertical-align:middle"><b>'. $order['count'] . '</b></td>';

                        echo '<td style="vertical-align:middle"><br>';
                        echo '<form method="get">';
                        echo '<input type="hidden" name="id_ord" value="'. $order['id'] . '">';
                        echo '<input type="hidden" name="count" value="'. $order['count'] . '">';
                        echo '<input type="hidden" name="lib" value="'. $order['lib_name'] . '">';
                        echo '<input type="hidden" name="isbn" value="'. $order['book_isbn'] . '">';
                        echo '<button type="submit" name="equipped" class="btn btn-primary">Potvrdiť</button>';
                        echo '</form>';
                        echo '</b></td>';
                        echo '</tr>';
                    }
                } else
                {
                    if ($_GET['lib'] == '-')
                    {
                        $orders = $db->get_orders_in_all_libraries();
                        while($order = $orders->fetch())
                        {
                            echo "<tr>";
                            echo '<td> <img src="../images/books/'.$order['book_isbn'].'.png" style="width:10vw"/> </td>';
                            echo '<td style="vertical-align:middle"><b>'. $order['lib_name'] .'</b></td>';
                            echo '<td style="vertical-align:middle"><b>'. $order['count'] . '</b></td>';

                            echo '<td style="vertical-align:middle"><br>';
                            echo '<form method="get">';
                            echo '<input type="hidden" name="id_ord" value="'. $order['id'] . '">';
                            echo '<input type="hidden" name="count" value="'. $order['count'] . '">';
                            echo '<input type="hidden" name="lib" value="'. $order['lib_name'] . '">';
                            echo '<input type="hidden" name="isbn" value="'. $order['book_isbn'] . '">';
                            echo '<button type="submit" name="equipped" class="btn btn-primary" style="margin-top:10px">Potvrdiť</button>';
                            echo '</form>';
                            echo '</b></td>';
                            echo '</tr>';
                        }
                    } else
                    {
                        $final_string = "SELECT * FROM orders WHERE";

                        if(!empty($_GET['lib']))
                        {
                            if($_GET['lib'] != '-')
                            {
                                $final_string = $final_string . " lib_name='" . $_GET['lib'] . "'";
                            }

                        }


                        $orders = $db->get_filtered($final_string);
                        while($order = $orders->fetch())
                        {
                            echo "<tr>";
                            echo '<td> <img src="../images/books/'.$order['book_isbn'].'.png" style="width:10vw"/> </td>';
                            echo '<td style="vertical-align:middle"><b>'. $order['lib_name'] .'</b></td>';
                            echo '<td style="vertical-align:middle"><b>'. $order['count'] . '</b></td>';

                            echo '<td style="vertical-align:middle"><br>';
                            echo '<form method="get">';
                            echo '<input type="hidden" name="id_ord" value="'. $order['id'] . '">';
                            echo '<input type="hidden" name="count" value="'. $order['count'] . '">';
                            echo '<input type="hidden" name="lib" value="'. $order['lib_name'] . '">';
                            echo '<input type="hidden" name="isbn" value="'. $order['book_isbn'] . '">';
                            echo '<button type="submit" name="equipped" class="btn btn-primary" style="margin-top:10px">Potvrdiť</button>';
                            echo '</form>';
                            echo '</b></td>';
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>