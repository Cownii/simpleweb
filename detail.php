<?php
include_once 'header.php';
?>

<div class="container px-4 py-5">
    <?php
        if(isset($_GET['id'])):
            $pid = $_GET['id'];

            require_once 'ConnectMysql.php';
            $conn = new Connect();
            $db_link = $conn->connectToPDO();

            $sql = " select * from product where pid = ? ";
            $stmt = $db_link->prepare($sql);    
            $stmt-> execute(array($pid));
            $re = $stmt-> Fetch(PDO::FETCH_BOTH);
    ?>      
        <div class="d-flex">
            <div class="mx-3">
                <img src="../images/<?=$re['pImage']?>.png" class="col-sm-6 col-form-label" style=" width: 500px;">
            </div>
            <div>
                <h2><?=$re['pName']?></h2>
                <ul style="list-style-type:none ;" class="list-group">
                    <h5>Price: </h4> <li class="list-group-item"> <?= $re['pPrice'] ?> &#8363;</li>
                    <h5>Remaining stock: </h4><li class="list-group-item"> <?= $re['pQuantity'] ?> </li>
                    <h5>Description: </h4><li class="list-group-item"> <?= $re['pDescription'] ?> </li>
                </ul>
                <form action="cart.php" method="GET">
                    <div class="col-lg-9">
                        <input type="hidden" name="pid" value="<?=$pid?>">
                        <input type="submit" class=" btn btn-primary shop-button mx-3 my-3" name="btnAdd" value=" Add to cart "/>
                </form>
            </div>
        </div>
    <?php
        else:
            ?>
            <h2> We have nothing to show you. </h2>
            <?php
        endif;
    ?>
</div>
<?php
    include_once 'footer.php';
?>
