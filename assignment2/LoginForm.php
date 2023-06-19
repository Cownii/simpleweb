
<?php
include_once 'ConnectMysql.php';
session_start();

if(isset($_POST['btnLogin']))
{ 
    if(isset($_POST['txtEmail']) && isset($_POST['txtPass'])):
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPass'];

        $c = new Connect();
        $dblink = $c->connectToPDO();  
        
        $sql = "SELECT * FROM `users` WHERE email = ? and password = ?";
        $stmt = $dblink->prepare($sql);
        $re = $stmt->execute(array("$email","$password"));

        $numrow = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_BOTH);
        if($numrow == 1):
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];      
            header("Location: index.php");
        else:
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
                <strong> Something is wrong with your information! Please check again </strong>
            </div>
        <?php 
        endif;
    else:
    ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
            <strong> Enter the correct email and password please! </strong>
        </div>
    <?php
    endif;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
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

        
    </head>

    <body> 
        
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid"> <!-- tràn viền -->
        </nav>
        <div class="container">
        <h2 class="pt-3"> Member Login </h2>
        <form id="form1" name="form1" method="POST" action="">

            <div class="row">
                <div class="form-group my-2">				    
                    <label for="txtEmail" class="col-sm-2 control-label"> Email </label>
                    <div class="col-sm-10">
                        <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email" value=""/>
                    </div>
                </div>  
                <div class="form-group my-2">
                    <label for="txtPass" class="col-sm-2 control-label"> Password </label>			
                    <div class="col-sm-10">
                            <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password" value=""/>
                    </div>
                </div> 
                <div class="form-group my-2">
                    <div class="d-flex d-grid col-6 mx-auto">
                        <div class="mx-2 my-3">
                            <input type="submit" name="btnLogin"  class="btn btn-primary" id="btnLogin" value="Login">
                        </div>
                </div>
            </div>
	    </form>
        </div>
    </body>
</html>  
