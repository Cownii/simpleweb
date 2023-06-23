<?php
include_once 'ConnectMysql.php';
include_once 'Header.php';

if(isset($_POST['btnSubmit']))
{
      $c = new Connect();
      $dblink = $c->connectToPDO();
      $pID = $_POST['txtpID'];
      $pName = $_POST['txtpName'];
      $pPrice = $_POST['txtpPrice'];
      $pStatus = $_POST['txtpStatus'];
      $pDescription = $_POST['txtpDescription'];
      $quantity = $_POST['txtquantity'];
      $store_ID = $_POST['txtstore_ID'];
      $sup_id = $_POST['txtsup_id'];
      $cat_id = $_POST['txtcat_id'];
        
      $Image = str_replace(' ','-',$_FILES['Image']['name']);

      $storedPath = "./images";
      $flag = move_uploaded_file($_FILES['Image']['tmp_name'],$storedPath.$Image);

      if($flag)
    {
        $sql = "INSERT INTO `product`(`pID`, `pName`, `pPrice`, `pStatus`,
         `pDescription`, `pImage`, `pQuantity`, `cat_id`, `store_ID`, `sup_id`)
          VALUES (?,?,?,?,?,?,?,?,?,?)";
        $re = $dblink->prepare($sql);
            
        $stmt = $re->execute(array("$pName","$pPrice","$pStatus","$pDescription","$Image","$quantity",
                                    "$cat_id","$store_ID","$sup_id"));      

        if($stmt)
        {
            echo "Successful";
        }
        else
        {
            echo "Failed";
        }
    }
    }
?>

<div id="main" class="container mt-4">     
    <form class="form form-vertical" method="POST" action="#"  enctype="multipart/form-data">
        <div class="form-body">
            <div class="row">
            <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical">Toy ID </label>
                        <input type="text" name="txtpID" id="txtpID" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical">Toy Name </label>
                        <input type="text" name="txtpName" id="txtpName" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Price </label>
                        <input type="number" name="txtpPrice" id="txtpPrice" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Status </label>
                        <input type="text" name="txtpStatus" id="txtpStatus" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Description </label>
                        <input type="text" name="txtpDescription" id="txtpDescription" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Image</label>
                        <input type="file" name="Image" id="Image" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Quantity </label>
                        <input type="number" name="txtquantity" id="txtquantity" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Cate ID </label>
                        <input type="text" name="txtcat_id" id="txtcat_id" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Store ID </label>
                        <input type="text" name="txtstore_ID" id="txtstore_ID" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical"> Supplier ID </label>
                        <input type="text" name="txtsup_id" id="txtsup_id" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12 d-flex mt-3 justify-content-center">
                    <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill" name="btnSubmit"> Add </button>
                </div>
            </div>
        </div>
    </form> 
</div>

<?php
include_once 'Footer.php';
?>