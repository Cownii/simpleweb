<?php
include_once 'ConnectMysql.php';
$c = new Connect();
$dblink = $c->connectToPDO();  

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Register Form </title>
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
    <style>
        .dropdown:hover .dropdown-menu{
            display: block;
        }
    </style>
    <body>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark"> </nav>
            <div class="container">
                <h2> Member Registration</h2>
                    <?php
                        if(isset($_POST['btnRegister']) && isset($_POST['email'])):
                            $error ="";
                            $email = $_POST['email'];
                            $usrName = $_POST['usrName']; 
                            $gender = $_POST['grGender']; 
                            $address = $_POST['address']; 
                            $password = $_POST['pass']; 
                            $phone = $_POST['phone']; 
                            $birthday = $_POST['txtBirth']; 

                            if(strlen($usrName) >= 30 ){
                                $error .= " Username must be <= 30 <br> ";
                            }
                            
                            if(strlen($password) <= 5 ){
                                $error .= " Password must be > 5 <br> ";
                            }

                            $Cpass = $_POST['confirmpass'];
                            if($Cpass <> $password)
                            {
                            $error .= " Password does not match ";
                            }
                            if(strlen($error) > 0):
                            ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"></button>
                                    <strong> <?= $error ?> </strong>
                                </div>   
                            <?php
                            else: 
                                // check the email has been registered or not
                                $sql = "SELECT * FROM `users` WHERE email = ?";
                                $stmt = $dblink->prepare($sql);
                                $re = $stmt->execute(array("$email"));

                                $numrow = $stmt->rowCount();
                                $row = $stmt->fetch(PDO::FETCH_BOTH);
                                if($numrow>0):  
                                ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="btn-close"
                                        data-bs-dismiss="alert"></button>
                                        <strong> This email has already been used!
                                            <br>
                                            Please try another one </strong>
                                    </div>
                                <?php
                                else:
                                    $sql = "INSERT INTO `users`(`email`, `fullname`, `gender`, `address`, `password`, `role`, `phone`, `birthday`) 
                                    values(?,?,?,?,?,?,?,?)";
                                    $re = $dblink->prepare($sql);   
                                    $add = $re->execute(array("$email","$usrName","$gender","$address","$password","User","$phone","$birthday "));

                                    if($add): 
                                        header("Location: index.php");     
                                    else:
                                        echo "Failed";
                                    endif;
                                endif;
                            endif;
                        endif;
                    ?>
                    <form id="form1" name="form1" method="POST" action="" class="needs-validation">

                        <!-- User name -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="Username" > Username(*):   </label>
                            <div class="col-sm-10">
                                <input type="text" name="usrName" id="Username" class="form-control" required >
                                
                            </div>
                        </div>
                        
                    
                        <!-- password -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="password" > Password(*):   </label>
                            <div class="col-sm-10">
                                <input type="password" name="pass" id="password" class="form-control" required >
                                
                            </div>
                        </div>

                        <!-- Confirm password -->
                        <div class="row pb-3">
                                <label class="col-sm-2 col-form-label" for="Confirmpass" > Confirm password(*):   </label>
                                <div class="col-sm-10">
                                    <input type="password" name="confirmpass" id="Confirmpass" class="form-control" required >
                               
                                </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="Phone" > Phone(*):   </label>
                            <div class="col-sm-10">
                                <input type="number" name="phone" id="Phone" class="form-control" required >
                            </div>
                        </div>


                        <!-- Email -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="Email" > Email(*):   </label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="Email" class="form-control" required >
                            </div>
                        </div>
                        
                        <!-- Gender -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="password" > Gender(*):   </label>
                            <div class="col-sm-10 d-flex"> 
                                <div class="form-check my-auto"> 
                                    <input type="radio" name="grGender" id="maleRd" value="0" checked >
                                    <label for="maleRd" class="form-check-label"> Male </label>
                                </div>
                                <div class="form-check my-auto">
                                    <input type="radio" name="grGender" id="femaleRd" value="1" >
                                    <label for="femaleRd" class="form-check-label"> Female </label>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="Address" >  Address:  </label>
                            <div class="col-sm-10">
                                <input type="text" name="address" id="Address" class="form-control" required >
                            </div>
                        </div>

                        <!-- birthday -->
                        <div class="row pb-3">
                            <label class="col-sm-2 col-form-label" for="Birthday" > Birthday(*):   </label>
                            <div class="col-sm-10">
                                <input type="date" name="txtBirth" id="Birthday" class="form-control" required >
                            </div>
                        </div>
                        <div class="d-flex d-grid col-2 mx-auto">
                            <div class="row pb-3 mx-2">
                                    <input type="submit" value="Register" class="btn btn-primary" name="btnRegister" id="btnRegister">
                            </div>
                        </div>
                    </form>
            </div>
    </body>
</html>