<?php
require "../services/component.php";
$db = new MainComponent();
$db->auto_update_reservations();
session_start();
if(!isset($_SESSION['id'])){
    header("location: ../index.php");
}
if($_SESSION['role'] == 1){
    header("location: ../index.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        if(!($db->book_exist($_POST['isbn']))){
            //add book information to database
            $data = $db->add_book($_POST);
            $url = $_POST['photo'];
    
            $img = "../images/books/" . $_POST['isbn'] . ".png"; 
    
            // Function to write image into file
            file_put_contents($img, file_get_contents($url));
            $libs = $db->get_libs();
            while($lib = $libs->fetch())
            {
                $db->add_new_book_availability($_POST, $lib['name']);
            }

            // Redirect user to welcome page
            header("location: ../index.php");
        }
        else {
            $error['isbn'] = "Kniha so zadaným isbn existuje!";
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
                        echo '<a class="nav-link" href="#" style="text-align:center; color: white; background-color:black; width:120px">Nová kniha</a>';
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

    <div style="background-color:rgba(241,241,241,255); padding-bottom:20px; padding-top:20px">
        <h1 style = "text-align: center;">Nová kniha</h1>
            <?php if(isset($error['isbn'])) { echo '<script type="text/javascript">
                alert("Kniha so zadaným ISBN existuje!");
                </script>';
            ?>
            <p class="errorMsg text-center" style="color: red; font-size: 15px; margin: 0;"><?php echo $error['isbn'] ?></p>
        <?php } ?>
        <div class="container">
            <form id="add-form" class="form" action="" method="post">
                <div class="row">
                    <div class="col-md-5 text-center">                                               
                        <h2>URL obrázku </h2>                            
                        <input type="url" onchange="myFunction()" name="photo" id="photo" class="form-control" placeholder="Zadajte URL k obrázku s titulnou fotografiou knihy" value="<?php if(isset($_POST['photo'])){echo $_POST['photo'];}?>" required>
                         <hr/>
                        <div class="col-md-12 text-center">
                                <img id="image" alt="obrázok" src= "<?php if(isset($_POST['photo'])) {echo $_POST['photo'];} else{echo "../images/books/ref.png";}?>" style="width:20vw">
                        </div>                                                
                    </div>
                    <div class="col-md-7">                        
                            <div class="row">                            
                                <div class="col-md-12 text-center">
                                    <h2>Názov knihy</h2>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" required>
                                    <hr/>
                                </div>
                            
                                <div class="col-md-4 text-center" style="margin-top:30px">
                                    <h4>Vydavateľ:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:30px">
                                    <input type="text" name="publisher" id="publisher" class="form-control" value="<?php if(isset($_POST['publisher'])){echo $_POST['publisher'];}?>" required>
                                </div>

                                <div class="col-md-4 text-center" style="margin-top:30px">
                                    <h4>Autori:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:30px">
                                    <input type="text" name="authors" id="authors" class="form-control" value="<?php if(isset($_POST['authors'])){echo $_POST['authors'];}?>" required>
                                </div>

                                <div class="col-md-4 text-center" style="margin-top:30px">
                                    <h4>Rok vydania:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:30px">
                                    <input type="number" name="year" id="year" class="form-control" value="<?php if(isset($_POST['year'])){echo $_POST['year'];}?>" required>
                                </div>

                                <?php 
                                    $genres = $db->get_genres();
                                ?>
                                <div class="col-md-4 text-center" style="margin-top:30px">
                                    <h4>Žáner:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:30px">
                                    <input type="text" name="genre" list="genre_options" id="genre" class="form-control" value="<?php if(isset($_POST['genre'])){echo $_POST['genre'];}?>" required>
                                    <datalist id="genre_options">
                                        <?php
                                        while($genre = $genres->fetch())
                                        {
                                            echo "<option>" . $genre['genre'] . "</option>";
                                            
                                        }
                                        ?>
                                    </datalist>
                                </div>

                                <div class="col-md-4 text-center" style="margin-top:30px">
                                    <h4>Hodnotenie:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:30px">
                                    <input type="text" name="rating" id="rating" class="form-control" value="<?php if(isset($_POST['rating'])){echo $_POST['rating'];}?>" required>
                                </div>

                                <div class="col-md-4 text-center" style="margin-top:30px">
                                    <h4>ISBN:</h4>
                                </div>
                                <div class="col-md-8 text-center" style="margin-top:30px">
                                    <input type="text" name="isbn" id="isbn" class="form-control" value="<?php if(isset($_POST['isbn'])){echo $_POST['isbn'];}?>" required>
                                </div>

                                <div class="col-md-12 text-center" style="margin-top:30px">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Pridať">
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