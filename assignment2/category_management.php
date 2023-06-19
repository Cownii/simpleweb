<?php
include_once 'header.php';
?>
<body>
    <div id="main" class="container">     
        <div className="page-heading pb-2 mt-4 mb-2 ">
        <h1>Product Category</h1>
        </div>
        <form name="frm" method="post" action="">
            <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" cellpading="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>Category ID</strong></th>
                        <th><strong>Category Name</strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once 'ConnectMysql.php';
                        $conn = new Connect();
                        $db_link = $conn->connectToMysql();
                        $sql = "select * from category";
                        $re =$db_link->query($sql);  
                        while( $row = $re->fetch_assoc() ):
                    ?>
                    
                    <!-- split table statement -->
                    <tr>  
                        <td><?=$row['cat_id']?> </td>
                        <td><?=$row['catName']?> </td>
                        <td style='text-align:center'>
                            <a  href="add_category.php?cid=<?=$row['cat_id']?>" class="text-decoration-none"> Edit </a> 
                        </td>
                        <td style='text-align:center'>
                            <a  href="delete_category.php?cid=<?=$row['cat_id']?>" class="text-decoration-none"> Delete </a> 
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    ?>
                </tbody>
            </table>  
        </form>   
        <p>
            <a href="add_category.php" class="btn btn-primary"> Add new category </a>
        </p>
    </div> <!--main-->
</body>

</html>