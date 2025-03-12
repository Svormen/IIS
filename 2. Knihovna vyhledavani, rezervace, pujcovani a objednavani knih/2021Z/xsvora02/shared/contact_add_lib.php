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

if(isset($_POST['submit'])){
    if(isset($_POST['from0'])){
        if($_POST['from0'] == '')
            $_POST['from0'] = "-";
        if($_POST['to1'] == '')
            $_POST['to1'] = "-";

        if($_POST['from2'] == '')
            $_POST['from2'] = "-";
        if($_POST['to3'] == '')
            $_POST['to3'] = "-";
        
        if($_POST['from4'] == '')
            $_POST['from4'] = "-";
        if($_POST['to5'] == '')
            $_POST['to5'] = "-";

        if($_POST['from6'] == '')
            $_POST['from6'] = "-";
        if($_POST['to7'] == '')
            $_POST['to7'] = "-";

        if($_POST['from8'] == '')
            $_POST['from8'] = "-";
        if($_POST['to9'] == '')
            $_POST['to9'] = "-";

        if($_POST['from10'] == '')
            $_POST['from10'] = "-";
        if($_POST['to11'] == '')
            $_POST['to11'] = "-";

        if($_POST['from12'] == '')
            $_POST['from12'] = "-";
        if($_POST['to13'] == '')
            $_POST['to13'] = "-";
        $new_opening_hours = $_POST['from0'] ." " . $_POST['to1'] . " " .$_POST['from2'] ." " . $_POST['to3'] . " " .$_POST['from4'] ." " . $_POST['to5'] . " " .$_POST['from6'] ." " . $_POST['to7'] . " " .$_POST['from8'] ." " . $_POST['to9'] . " " .$_POST['from10'] ." " . $_POST['to11'] . " " .$_POST['from12'] ." " . $_POST['to13'];
    }
    if(!($db->library_exist($_POST['name']))){
        $db->add_library($_POST, $new_opening_hours);
        $isbns = $db->get_books();
        while($isbn = $isbns->fetch()){
            $db->set_availability($isbn['isbn'], $_POST['name']);
        }
        
        $name = str_replace(' ', '', $_POST['name']);
        //Stores the tempname as it is given by the host when uploaded.
        $imagetemp = $_FILES['pic']['tmp_name'];

        //The path you wish to upload the image to
        $imagePath = "../images/libraries/" . $name . ".png";

        if (is_uploaded_file($imagetemp)) {
            move_uploaded_file($imagetemp, $imagePath);    
        }
    }
    else{
        $error['name'] = "error";
    }
    header("location: ./contact.php");
}

?>

<html>
<head>
        <!-- META TAGS -->
		<meta charset="utf-8">
        
        <!-- TITLE -->
        <title>Knižnica</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/styles.css">
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
                        echo '<a class="nav-link" href="../user/reservations.php" style="text-align:center; color: white; background-color:black; width:120px">Objednávky</a>';
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

    <div style="background-color:rgba(241,241,241,255); padding-bottom:20px; padding-top:20px">
        <div class="container">
            <form id="add-form" class="form" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php if(isset($error['name'])) { echo '<script type="text/javascript">
                            alert("Knižnica so zadaným názvom existuje!");
                            </script>';}
                        ?>
                            <h2>Nová knižnica</h2>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Názov" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" required>

                            <hr/>
                        </div>
                    
                    <div class="col-md-6">                        
                            <div class="row">                            
                                

                                <div class="col-md-2 text-center" style="margin-top:30px">
                                    <h4>Adresa:</h4>
                                </div>
                                <div class="col-md-10 text-center" style="margin-top:30px">
                                    <input type="text" name="street" id="street" class="form-control" placeholder="Ulica" value="<?php if(isset($_POST['street'])){echo $_POST['street'];}?>" required>
                                </div>
                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="number" name="number" id="number" class="form-control" placeholder="Číslo domu" value="<?php if(isset($_POST['number'])){echo $_POST['number'];}?>" required>
                                </div>
                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="PSČ" value="<?php if(isset($_POST['postal_code'])){echo $_POST['postal_code'];}?>" pattern="[0-9]{5}">
                                </div>
                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="text" name="city" id="city" class="form-control" placeholder="Mesto" value="<?php if(isset($_POST['city'])){echo $_POST['city'];}?>" required>
                                </div>

                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <h4>Informácie:</h4>
                                </div>
                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="text" name="description" id="description" class="form-control" value="" required>
                                </div>
                            </div>                        
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="row">  
                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <h4>Otváracie hodiny:</h4>
                                </div>

                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Pondelok:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from0" value="<?php echo $hours[0]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to1" value="<?php echo $hours[1]; ?>"> </div>
                                    
                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Utorok:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from2" value="<?php echo $hours[2]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to3" value="<?php echo $hours[3]; ?>"> </div>

                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Streda:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from4" value="<?php echo $hours[4]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to5" value="<?php echo $hours[5]; ?>"> </div>

                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Štvrtok:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from6" value="<?php echo $hours[6]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to7" value="<?php echo $hours[7]; ?>"> </div>

                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Piatok:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from8" value="<?php echo $hours[8]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to9" value="<?php echo $hours[9]; ?>"> </div>

                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Sobota:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from10" value="<?php echo $hours[10]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to11" value="<?php echo $hours[11]; ?>"> </div>

                                <!-- Hodiny-->
                                <div class="col-md-3 text-center"> <label>Nedela:</label> </div>    
                                <div class="col-md-3 text-center"> <input type="time" name="from12" value="<?php echo $hours[12]; ?>"> </div>
                                <div class="col-md-3 text-center"> <label>-</label> </div>
                                <div class="col-md-3 text-center">  <input type="time" name="to13" value="<?php echo $hours[13]; ?>"> </div>                                          

                                <div class="col-md-3 text-center" style="margin-top: 30px;"> <label for:"pic">Obrázok</label> </div>
                                <div class="col-md-3 text-center" style="margin-top: 30px;"> <input type="file" name="pic"/> </div>

                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Uložiť">
                                </div>
                        </div>                                                
                    </div>
                </div>
            </form>
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