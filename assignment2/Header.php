<?php
    include_once 'ConnectMysql.php';
    $c = new Connect();
    $dblink = $c->connectToMySQL();
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Homepage </title>
        <meta name="viewport" 
        content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" 
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" 
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" 
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../simpleweb/Header.css" >
        
    </head>
    <style>
        .dropdown:hover .dropdown-menu{
            display: block;
        }
    </style>
    <body> 
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid"> <!-- tràn viền -->
                <a class="navbar-brand"> Ctechs </a>
            
                <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" 
                data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span> 
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <div class="navbar-nav">
                        <a href="index.php" class="nav-link"> Home </a>
                        <a href="cart.php" class="nav-link"> Cart </a>
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                data-bs-toggle="dropdown">
                                    Management 
                                </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="Allproduct.php"> All Product </a>
                                        <a class="dropdown-item" href="Order.php"> Order </a>   
                                        <a class="dropdown-item" href="category_management.php"> Category management </a>
                                    </div>
                            </div>

                            <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">
                                Catagories
                            </a>
                                <div class="dropdown-menu">
                                    <?php
                                        $sql = "SELECT DISTINCT c.catName,c.cat_id FROM category c, product p where p.cat_id = c.cat_id ";
                                        $re = $dblink->query($sql);
                                        while($row = $re->fetch_assoc()):
                                    ?>  
                                        <a class="dropdown-item" href="Categories.php?cid=<?=$row['cat_id']?>"> 
                                        <?=$row['catName'];?>
                                     </a>   
                                    <?php
                                        endwhile;
                                    ?>
                                </div>
                    </div>
                    <div class="navbar-nav ms-auto">
                        <?php
                            if(isset($_SESSION['user_name'])):
                        ?>
                        <a href="#" class="nav-item nav-link"> Welcome, <?=$_SESSION['user_name'] ?> </a>
                        <a href ="logout.php" class="nav-item nav-link"> Logout </a>
                        <?php
                            else:
                        ?>  
                        <a href="LoginForm.php" class="nav-item nav-link"> Login </a>
                        <a href="Register Form.php" class="nav-item nav-link"> Register </a>

                        <?php   
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </nav>