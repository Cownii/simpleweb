<div class="row">
<?php
    include_once 'ConnectMysql.php';
    include_once 'Header.php'; 
    $c = new Connect();
    $dblink = $c->connectToPDO(); 

    if(isset($_GET['cid'])):  // this is update action build
        $value = $_GET['cid'];
        $sql = "SELECT DISTINCT pName, pPrice, pImage, pid from product as p, category as c where p.cat_id = ?" ;
        $re = $dblink->prepare($sql);
        $re->execute(array("$value"));
        $rows = $re->FETCHAll(PDO::FETCH_BOTH);
        if($rows):
        foreach ($rows as $r):
    ?>
        <div class="col-md-4 pb-2 mx-auto my-2">
            <div class="card">
            <img src="../images/<?=$r['pImage']?>.png" class="card-img-top" style="width: 350px;" />
                <div class="card-body">
                    <a href="detail.php?id=<?=$r['pid']?>" class="text-decoration-none">
                        <h5 class="card-title"> <?=$r['pName']?> </h5></a>
                    <h6 class="card-subtitle mb-2 text-muted"><span> <?=$r['pPrice']?> &#8363;</span>
                    </h6>
                    <a href="detail.php?id=<?=$r['pid']?>" class="btn btn-primary">Click for more information</a>
                </div>
            </div>
        </div>
    <?php
        endforeach;
    else:
    ?>  
        <br>
        <h4> We do not have this to show you. </h4>
    <?php
    endif;
endif;
include_once 'Footer.php';
?>  
</div>