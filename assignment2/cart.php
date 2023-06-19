<?php
    include_once 'header.php';
    include_once 'ConnectMysql.php';
    $c = new Connect();
    $db_link = $c-> connectToPDO();

    if(isset($_SESSION['user_name'])) // check the user logged into the website or not
    {
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];

        if(isset($_GET['pid']))  //  get the product info when the user add to cart
        {
            $p_id = $_GET['pid'];
            $sqlSelect1 = "Select pid from cart where user_id = ? and pid = ? ";
            $re = $db_link-> prepare($sqlSelect1);
            $re->execute(array("$user_id","$p_id"));

            // check if the item has been added
            if($re->rowCount() == 0) //the item could not be found in user's cart
            {
                $query = "Insert into cart(user_id, pid, pCount, date) values(?,?,1,CURDATE())";
            }
            else // the item has been added 
            {   
                $query = "Update cart set pCount = pCount+1 where user_id = ? and pid = ? ";
            }
            $stmt = $db_link->prepare($query);
            $stmt->execute(array("$user_id","$p_id"));
        }
        else if(isset($_GET['del_id']))  // when the user delete
        {
            $cart_del = $_GET['del_id'];
            $query = "Delete from cart where order_id = ?";
            $stmt = $db_link->prepare($query);
            $stmt->execute(array($cart_del));
        }

        // show list of shopping cart
        $sqlSelect = "Select * from cart c, product p where c.pid = p.pid and user_id=?";
        $stmt1 = $db_link->prepare($sqlSelect);
        $stmt1->execute(array($user_id));
        $rows = $stmt1->FETCHAll(PDO::FETCH_BOTH);
    }   
    else
    {
        header("Location: LoginForm.php");
    }
?>

<div class="container">
    <h1 class="fw-bold mb-0 text-black"> Shopping Cart </h1>
    <h6 class="mb-0 text-muted"> <?=$stmt1->rowCount() ?> Item(s) </h6>
    <table class="table">
        <tr>
            <th> Product name </th>
            <th> Quantity </th>
            <th> Total </th>
            <th> Action </th>
        </tr>
        <?php
            foreach($rows as $row)
            {
                ?>
                <tr>
                    <td> <?= $row['pName'] ?> </td>
                    <td>
                        <input id="form1" min="0" name="quantity" value="<?=$row['pCount'] ?>" type="number" 
                        class="form-control form-control-sm text-muted" /> </td>
                    <td> <h6 class="mb-0"><span>&#8363;</span> <?=$row['pCount'] ?> * <?=$row['pPrice'] ?> </h6></td>
                    <td> <a href="cart.php?del_id=<?=$row['order_id'] ?>" class="text-muted text-decoration-none">x</a></td>
                </tr>
                <?php
            }
        ?>
    </table>
<hr class="my-4">
    <div class="pt-5">
        <h6 class="mb-0"><a href="index.php" class="text-body"> 
        <i class="fas fa-long-arrow-alt-left me-2"></i> Back to shop </a></h6>
    </div>
