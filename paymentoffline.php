<?php include 'inc/header.php'; ?>

<?php
	$login = Session::get("cuslogin");
	if($login == false){
		header("Location:login.php");
	}
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
		$cmrId = Session::get("cmrId");
		$insertOrder = $ct->orderProduct($cmrId);
		$delData = $ct->delCustomerCart();
		header("Location:success.php");
	}
?>

<style>
	.division{width:50%; float:left;}
	.tblone{width:500px; margin:0 auto; border: 2px solid #ddd;}
	.tblone tr td{text-align:justify;}
	.tbltwo{float:right;text-align:left;width:45%;border: 2px solid #ddd;margin-right:80px;margin-top: 12px;}
	.tbltwo tr td{text-align: justify;padding: 5px 10px;}
	.ordernow{padding-bottom: 30px;}
	.ordernow a{width:200px; margin:20px auto 0;text-align:center;padding: 5px;font-size: 30px;display: block;background: #ff0000;color: #fff;border-radius: 3px;}
</style>
 <div class="main">
    <div class="content">
		<div class="section group">
			<div class="division">
		<!-- Cart Product Show -->
		<table class="tblone">
			<tr>
				<th>No</th>
				<th>Product</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
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
				<td>$<?php echo $result['price']; ?></td>
				<td><?php echo $result['quantity']; ?></td>
				<td>$<?php
					$total = $result['price'] * $result['quantity']; 
					echo $total; ?>
				</td>
			</tr>
			<?php
				$qty = $qty + $result['quantity']; 
				$sum = $sum + $total;
			?> 
			<?php } } ?>
		</table>
							
			<table class="tbltwo">
				<tr>
					<th>Sub Total</th>
					<td>:</td>
					<td>$<?php echo $sum; ?></td>
				</tr>
				<tr>
					<th>VAT</th>
					<td>:</td>
					<td>10%($<?php echo $gtotal = $sum * 0.1; ?>)</td>
				</tr>
				<tr>
					<th>Grand Total</th>
					<td>:</td>
					<?php 
						$gtotal = $sum * 0.1;
						$gdtotal = $sum + $gtotal;
					 ?>
					<td>$<?php echo $gdtotal; ?></td>
				</tr>
				<tr>
					<th>Quantity</th>
					<td>:</td>
					<td><?php echo $qty; ?></td>
				</tr>				
		   </table>
			</div>
			<div class="division">
			<?php
				$id = Session::get("cmrId");
				$getData = $cmr->getCustomerData($id);
				if($getData){
					while ($result = $getData->fetch_assoc()) {
			?>
			<!-- Profile Details Show -->
			<table class="tblone">
				<tr>
					<td colspan="3"><h2>Your Profile Details</h2></td>
				</tr>				
				<tr>
					<td width="20%">Name</td>
					<td width="5%">:</td>
					<td><?php echo $result['name']; ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $result['phone']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['email']; ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $result['address']; ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $result['city']; ?></td>
				</tr>
				<tr>
					<td>Zipcode</td>
					<td>:</td>
					<td><?php echo $result['zip']; ?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country']; ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><a href="editprofile.php">Update Details</a></td>
				</tr>
			</table>
		<?php } } ?>
			</div>
		</div>
       <div class="clear"></div>
    </div>
    <div class="ordernow"><a href="?orderid=order">Order</a></div>
 </div>

<?php include 'inc/footer.php'; ?>