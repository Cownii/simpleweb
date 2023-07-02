<?php
    require_once 'ConnectMysql.php';
    $conn = new Connect();
    $db_link = $conn->connectToPDO();
    if(isset($_GET['cid'])):  // this is delete action build
        $value = $_GET['cid'];
        $sqlSelect = " DELETE FROM `category` where cat_id = ? ";
        $stmt = $db_link->prepare($sqlSelect);
        $execute = $stmt->execute(array("$value"));
        if($execute){
            header("Location: category_management.php");
        }else{
                echo "Failed".$execute;
        }       
    endif;
?>
