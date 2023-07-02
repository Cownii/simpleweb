<div class="row">
<?php
    include_once 'ConnectMysql.php';
    include_once 'Header.php'; 
        $c = new Connect();
        $dblink = $c->connectToMySQL();
        $sql = 'SELECT * FROM product';
        $re = $dblink->query($sql);
        if ($re->num_rows > 0) :
            while ($row = $re->fetch_assoc()) :
        ?>
        <div class="col-md-4 pb-2 mx-0 my-2">
            <div class="card">
            <img src="../images/<?=$row['pImage']?>.png" class="card-img-top" style="width: 300px;" />
                <div class="card-body">
                    <a href="detail.php?id=<?=$row['pid']?>" class="text-decoration-none">
                        <h5 class="card-title"> <?=$row['pName']?> </h5></a>
                    <h6 class="card-subtitle mb-2 text-muted"><span> <?=$row['pPrice']?> &#8363;</span>
                    </h6>
                    <a href="detail.php?id=<?=$row['pid']?>" class="btn btn-primary">Click for more information</a>
                </div>
            </div>
        </div>
            <?php
                endwhile;
            else :
                echo "Not found";
            endif;
    include_once 'Footer.php';
    ?>
</div>