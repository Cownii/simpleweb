<?php
    include_once 'Header.php';
    include_once 'ConnectMysql.php';
    $c = new Connect();
    $db_link = $c-> connectToPDO();

    if(isset($_SESSION['user_name'])): // check the user logged into the website or not
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];
        $total = 0;
        $sqlSelect = "Select * from cart c, product p where c.pid = p.pid and user_id=?";
        $stmt1 = $db_link->prepare($sqlSelect);
        $stmt1->execute(array($user_id));
        $rows = $stmt1->FETCHAll(PDO::FETCH_BOTH);
?>
<div class="container">
<h1 class="fw-bold mx-0 text-black"> <?=$user_name ?>'s order: </h1>
<br>
    <h5 class="mb-0 text-muted"> Number of item(s): <?=$stmt1->rowCount() ?></h5>
    <div class="col-10 mx-auto">
    <table class="table">
        <tr style="text-align:center;">
            <th class="col-5"> Product name </th>
            <th class="col-1"> Quantity </th>
            <th class="col-4"> Product cost </th>
            <th class="col-2"> Date </th>
        </tr>
        <?php
            foreach($rows as $row)
            {   
                $price = $row['pCount'] * $row['pPrice'];
                $total = $total + $price;
                ?>
                <tr>
                    <td> <?= $row['pName'] ?> </td>
                    <td>
                        <input id="form1" min="0" name="quantity" value="<?=$row['pCount'] ?>" type="number" 
                        class="form-control form-control-sm" /> </td>
                    <td> <h6 class="mb-0"> <?=$row['pCount'] ?> * <?=$row['pPrice'] ?> = <?= $price ?> <span>&#8363;</span></h6></td>
                    <td> <?= $row['date'] ?> </td>
                </tr>
                <?php
            }
        else:
            header("Location: LoginForm.php");
        endif;
?>    
    </table>    