<?php 
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/Format.php');
 ?>

 <?php
class Product {
	private $db;
	private $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function productInsert($data, $file){
		//$productName = $this->fm->validation($data['productName']);
		//catch the variavble
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);		
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);

	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == ""  || $type == ""){
	    		$msg = "<span class='error'>Field must not emplty !</span>";
				return $msg;

	    }elseif ($file_size >1048567) {
	     	echo "<span class='error'>Image Size should be less then 1MB!
	     	</span>";

	    } elseif (in_array($file_ext, $permited) === false) {
	     	echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

	    } else {
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image', 
		    		'$type')";
				$inserted_row = $this->db->insert($query);
				if($inserted_row) {
					$msg = "<span class='success'>Product inserted successfully.</span>";
					return $msg;
				} else{
					$msg = "<span class='error'>Product not inserted.</span>";
					return $msg;				
				}
	    }
	}
	public function getAllProduct(){
		//using aliases
		$query = "SELECT p.*, c.catName, b.brandName
					FROM tbl_product as p, tbl_category as c, tbl_brand as b
					WHERE p.catId = c.catId AND p.brandId = b.brandId
				  ORDER BY p.productId DESC";
		/*
		using inner join		
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
					FROM tbl_product
					INNER JOIN tbl_category
					ON tbl_product.catId = tbl_category.catId
					INNER JOIN tbl_brand
					ON tbl_product.brandId = tbl_brand.brandId
				  ORDER BY tbl_product.productId DESC";
		*/
		$result = $this->db->select($query);
		return $result;
	}
	public function getProductById($id){
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function productUpdate($data, $file, $id){
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);		
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);

	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
	    		$msg = "<span class='error'>Field must not emplty !</span>";
				return $msg;

    	}else {
    		if(!empty($file_name)){
				    if ($file_size >1048567) {
				     	echo "<span class='error'>Image Size should be less then 1MB!
				     </span>";

				    } elseif (in_array($file_ext, $permited) === false) {
				     	echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

				    }else{
				    	move_uploaded_file($file_temp, $uploaded_image);
				    	$query = "UPDATE tbl_product 
					  		SET 
						 productName = '$productName',
						 catId = '$catId',
						 brandId = '$brandId',
						 body = '$body',
						 price = '$price',
						 image = '$uploaded_image',
						 type = '$type'
						 WHERE productId = '$id'";
						 $updated_row = $this->db->update($query);
							if($updated_row) {
								$msg = "<span class='success'>Product updated successfully.</span>";
								return $msg;
							} else{
								$msg = "<span class='error'>Product not updated.</span>";
								return $msg;				
							}
						}	
		    } else {
				    $query = "UPDATE tbl_product 
					  SET 
					 productName = '$productName',
					 catId = '$catId',
					 brandId = '$brandId',
					 body = '$body',
					 price = '$price',
					 type = '$type'
					 WHERE productId = '$id'";
					 $updated_row = $this->db->update($query);
						if($updated_row) {
							$msg = "<span class='success'>Product updated successfully.</span>";
							return $msg;
						} else{
							$msg = "<span class='error'>Product not updated.</span>";
							return $msg;				
						}
		    		}
				}			    
			}

	public function delProductById($id){
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$getdata = $this->db->select($query);
		if($getdata){
			while ($delImg = $getdata->fetch_assoc()) {
				$dellink = $delImg['image'];
				unlink($dellink);
			}
		}	
		$delquery = "DELETE  FROM tbl_product WHERE productId = '$id'";
		$deldata = $this->db->delete($delquery);
		if($deldata) {
			$msg = "<span class='success'>Product deleted successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product not deleted.</span>";
				return $msg;				
			}
		}

	public function getFeaturedProduct(){
		$query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}	

	public function getNewProduct(){
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function getSingleProductById($id){
		//using aliases
		$query = "SELECT p.*, c.catName, b.brandName
					FROM tbl_product as p, tbl_category as c, tbl_brand as b
					WHERE p.catId = c.catId AND p.brandId = b.brandId
				  AND p.productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromIphone(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromSamsung(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromAcer(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromCanon(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getProductByCat($id){
		$query = "SELECT * FROM tbl_product WHERE catId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertCompareData($cmprid,$cmrId){
		$cmrId = mysqli_real_escape_string($this->db->link, $cmrId);		
		$productId 		 = mysqli_real_escape_string($this->db->link, $cmprid);

		$chquery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId' ";
		$getpro = $this->db->select($chquery);
		if($getpro) {
				$msg = "Product already added !";
				return $msg;
		}	
		$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($query)->fetch_assoc();	
		if($result){
			 $productId = $result['productId'];
			 $productName = $result['productName'];
			 $price = $result['price'];
			 $image = $result['image'];		
		    	$query = "INSERT INTO tbl_compare(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
				$inserted_row = $this->db->insert($query);
				if($inserted_row) {
					$msg = "<span class='success'>Added ! Check Compare Page.</span>";
					return $msg;
				} else{
					$msg = "<span class='error'>Not Added !!.</span>";
					return $msg;
			}	
		
		}	
	
	}
	public function getCompareData($cmrId){
		$query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC ";
		$result = $this->db->select($query);
		return $result;
	}
	public function delCompareData($cmrId){
		$delquery = "DELETE  FROM tbl_compare WHERE cmrId = '$cmrId'";
		$deldata = $this->db->delete($delquery);		
	}
	public function saveWishListData($id, $cmrId){
		$chquery = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$id' ";
		$getpro = $this->db->select($chquery);
		if($getpro) {
				$msg = "Product already added !";
				return $msg;
		}		
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query)->fetch_assoc();	
		if($result){
			 $productId = $result['productId'];
			 $productName = $result['productName'];
			 $price = $result['price'];
			 $image = $result['image'];		
		    	$query = "INSERT INTO tbl_wlist(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
				$inserted_row = $this->db->insert($query);
				if($inserted_row) {
					$msg = "<span class='success'>Added ! Check WishList Page.</span>";
					return $msg;
				} else{
					$msg = "<span class='error'>Not Added !!.</span>";
					return $msg;
			}		
		}
	}
	public function getWlistData($cmrId){
		$query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC ";
		$result = $this->db->select($query);
		return $result;		
	}
	public function delWlistData($cmrId,$productId){
		$query = "DELETE  FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
		$deldata = $this->db->delete($query);		
	}
}
?>	