<?php include 'inc/header.php'; ?>
<?php
	//delete cart
    if(isset($_GET['delcart'])){
    	//$id = $_GET['delcart'];
    	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcart']);
    	$delCart = $ct->delCartById($id);
    }  
    //quantity update 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $updateCart = $ct->updateCartQuantity($cartId, $quantity);
        if($quantity<=0){
        	$delCart = $ct->delCartById($cartId);
        }
    }     
?>

<?php 
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<?php
                    if(isset($updateCart)){
                        echo $updateCart ;
                    }
                    if(isset($delCart)){
                        echo $delCart ;
                    }                    
                ?>
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="25%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
						<?php 
							$getct = $ct->getAllCart();
							if($getct){
								$i = 0;
								$sum = 0;
								$qty = 0;
								while ($result = $getct->fetch_assoc()) {
									$i++;
						?>	
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" height="40px" width="60px"/></td>
								<td>$<?php echo $result['price']; ?></td>
								<td>
							<form action="" method="post">
								<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
								<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
								<input type="submit" name="submit" value="Update"/>
							</form>
								</td>
								<td>$<?php
									$total = $result['price'] * $result['quantity']; 
									echo $total; ?>
								</td>
								<td><a onclick="return confirm('Are you sure to delete!')" href="?delcart=<?php echo $result['cartId'];?>">X</a></td>
							</tr>
							<?php
								$qty = $qty + $result['quantity']; 
								$sum = $sum + $total;
								Session::set("qty", $qty);
								Session::set("sum", $sum); 
							?> 
							<?php } } ?>
						</table>
						<?php
							$getdata = $ct->checkCartTable();
								if($getdata){	
						?>							
							<table style="float:right;text-align:left;" width="40%">
								<tr>
									<th>Sub Total : </th>
									<td>$<?php echo $sum; ?></td>
								</tr>
								<tr>
									<th>VAT : </th>
									<td>10%</td>
								</tr>
								<tr>
									<th>Grand Total :</th>
									<?php 
									$gtotal = $sum * 0.1;
									$gdtotal = $sum + $gtotal;
									 ?>
									<td>$<?php echo $gdtotal; ?></td>
								</tr>
						   </table>
						<?php } else {
							header("Location:index.php");
						} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>