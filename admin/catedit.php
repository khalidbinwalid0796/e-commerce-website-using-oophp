<?php include'../classes/Category.php';?>
<?php
    //edit Category catch the catid which passed from catlist
if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
    echo "<script>window.location = 'catlist.php';</script>";
    }else{
        //$id = $_GET['catid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
    }
    //uptate Category
    $cat = new Category();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName   = $_POST['catName'];
        $updatecat = $cat->catUpdate($catName, $id);
    }
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($updatecat)){
                        echo $updatecat ;
                    }
                ?>
                <!-- show edited category -->
                <?php
                    $getCat = $cat->getCatById($id);
                    if($getCat){
                        while ($result = $getCat->fetch_assoc()) {
                    
                ?>
                <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name= "catName" value = "<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>