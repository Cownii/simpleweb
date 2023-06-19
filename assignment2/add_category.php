<?php
include_once 'header.php';
?>
<body>
    <div id="main" class="container">     
        <div className="page-heading pb-2 mt-4 mb-2 ">
        <h1>Product Category</h1>
        </div>
        <?php
                require_once 'ConnectMysql.php';
                $conn = new Connect();
                $db_link = $conn->connectToPDO();
                if(isset($_GET['cid'])):  // this is update action build
                        $value = $_GET['cid'];
                        $sqlSelect = " select * from category where cat_id = ? ";
                        $stmt = $db_link->prepare($sqlSelect);
                        $stmt->execute(array("$value"));
                        if($stmt->rowCount()>0):
                                $re = $stmt->fetch(PDO::FETCH_ASSOC);
                                $catName = $re['catName'];
                        endif;
                endif;

                if(isset($_POST['txtID'])&&isset($_POST['txtName'])): // check the admin enter or not
                        $cid = $_POST['txtID'];
                        $cname = $_POST['txtName'];
                        if(isset($_POST['btnAdd'])):  //  add action
                                $sqlInsert = "INSERT INTO `category`(`cat_id`,`catName`) VALUES(?,?)";
                                $stmt = $db_link->prepare($sqlInsert);
                                $execute = $stmt->execute(array("$cid","$cname"));
                                if($execute){
                                        header("Location: category_management.php");
                                }else{
                                        echo "Failed".$execute;
                                }
                        else:   // update action        
                                $sqlUpdate = "UPDATE `category` SET `catName`=? WHERE `cat_id`=? ";
                                $stmt = $db_link->prepare($sqlUpdate);
                                $execute = $stmt->execute(array("$cname","$cid"));
                                if($execute){
                                        header("Location: category_management.php");
                                }else{
                                        echo "Failed".$execute;
                                }       
                        endif;
                endif;
        ?>
        <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
            <div class="form-group pb-3">
                    <label for="txtTen" class="col-sm-2 control-label">Category ID(*):  </label>
                    <div class="col-sm-10">
                        <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" 
                                value='<?php echo isset($_GEt["cid"])?($_GET["cid"]):""; ?>'>
                    </div>
            </div>	
            <div class="form-group pb-3">
                    <label for="txtTen" class="col-sm-2 control-label">Category Name(*):  </label>
                    <div class="col-sm-10">
                        <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" 
                                value="<?php echo isset($catName)?($catName):""; ?>">
                    </div>
            </div>
                    
            <div class="form-group pb-3">
                <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit"  class="btn btn-primary" 
                                name="<?php echo isset($_GET["cid"])?"btnEdit":"btnAdd";?>" 
                                id="btnAction" value='<?php echo isset($_GET["cid"])?"Edit":"Add new"; ?> '/>     

                        <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" 
                        value="Back to list" onclick="window.location.href='category_management.php'" />
                </div>
            </div>
        </form>
    </div> <!--main-->
</body>

</html>