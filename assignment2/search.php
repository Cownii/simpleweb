<?php
    include_once 'ConnectMysql.php';
    $c = new Connect();
    $dblink = $c->connectToPDO(); 
?>
<div class = "container">
<div class="row d-flex justify-content-center align-items-center p-3">
<div class="col-md-8">
<div class="search ">
    <i class="fa fa-search cus-fa"></i>
    <form class="example1 d-flex mx-auto" action="index.php">      
        <input type="text" class="form-control my-2" placeholder="Search..."  name="search"><br> 
        <?php
            if(isset($_GET['btnSearch']))
            {
                $nameP = $_GET['search'];
            } 
        ?>
        <button class="btn btn-primary mx-3 my-2" name="btnSearch">Search</button>
    </form>  
</div>
</div>
</div>
    <div class="row">
    <?php
        if(isset($_GET['btnSearch'])):
        ?>
            <h3>Result for <b><i><?= $nameP ?> </b></i>: </h3> <br>
        <?php
            $nameP = $_GET['search'];
            $sql="Select * from product where pName LIKE ?";
            $re = $dblink->prepare($sql);
            $re->execute(array("%$nameP%"));
            $rows = $re->FETCHAll(PDO::FETCH_BOTH);
            if($rows):
            foreach ($rows as $r):
        ?>
        <div class="col-md-4 pb-2 mx-auto my-2">
            <div class="card">
            <img src="../images/<?=$r['pImage']?>.png" class="card-img-top" style="width: 295px;" />
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
        ?>
    </div>
</div>