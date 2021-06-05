<?php 
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/Format.php');
 ?>

<?php
class Customer {
	private $db;
	private $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function customerRegistration($data){
		//$name = $this->fm->validation($data['name']);
		//catch the variavble
		$name = mysqli_real_escape_string($this->db->link, $data['name']);		
		$city 		 = mysqli_real_escape_string($this->db->link, $data['city']);
		$zip 	 = mysqli_real_escape_string($this->db->link, $data['zip']);
		$email 		 = mysqli_real_escape_string($this->db->link, $data['email']);
		$address 		 = mysqli_real_escape_string($this->db->link, $data['address']);
		$country 		 = mysqli_real_escape_string($this->db->link, $data['country']);
		$phone 		 = mysqli_real_escape_string($this->db->link, $data['phone']);
		$pass 		 = mysqli_real_escape_string($this->db->link, md5($data['pass']));

	    if($name == "" || $city == "" || $zip == "" || $email == "" || $address == ""  || $country == "" || $phone == "" || $pass == ""){
	    		$msg = "<span class='error'>Field must not emplty !</span>";
				return $msg;
	    } 
	    
	    //email check or uniquely define
	    $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
	    $mailchk = $this->db->select($mailquery);

	    if($mailchk != false){
	    	$msg = "<span class='error'>Email already exist !</span>";
			return $msg;
	    }else{
	        $query = "INSERT INTO tbl_customer(name,city,zip,email,address,country,phone,pass) VALUES('$name','$city','$zip','$email','$address','$country','$phone','$pass')";
			$inserted_row = $this->db->insert($query);
			if($inserted_row) {
				$msg = "<span class='success'>Customer data inserted successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Customer data not inserted.</span>";
				return $msg;				
			}
	    }
	}
	public function customerLogin($data){
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass  = mysqli_real_escape_string($this->db->link, md5($data['pass']));

		if(empty($email) || empty($pass)) {
			$msg = "Username or Password must not emplty !";
			return $msg;
		}
		$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND 
		pass = '$pass'";
		$result = $this->db->select($query);
		if($result != false) {
			$value = $result->fetch_assoc();
			Session::set("cuslogin", true);
			Session::set("cmrId", $value['id']);
			Session::set("cmrName", $value['name']);
			header("Location:cart.php");
		} else{
			$msg = "Email or Password not match !";
			return $msg;				
		}
	}
	public function getCustomerData($id){
		$query = "SELECT * FROM tbl_customer WHERE id = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function customerUpdate($data,$cmrId){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);		
		$city 		 = mysqli_real_escape_string($this->db->link, $data['city']);
		$zip 	 = mysqli_real_escape_string($this->db->link, $data['zip']);
		$email 		 = mysqli_real_escape_string($this->db->link, $data['email']);
		$address 		 = mysqli_real_escape_string($this->db->link, $data['address']);
		$country 		 = mysqli_real_escape_string($this->db->link, $data['country']);
		$phone 		 = mysqli_real_escape_string($this->db->link, $data['phone']);


	    if($name == "" || $city == "" || $zip == "" || $email == "" || $address == ""  || $country == "" || $phone == ""){
	    		$msg = "<span class='error'>Field must not emplty !</span>";
				return $msg;

	    }else{
	    	$query = "UPDATE tbl_customer 
		  		SET 
			 name = '$name',
			 city = '$city',
			 zip = '$zip',
			 email = '$email',
			 address = '$address',
			 country = '$country',
			 phone = '$phone'
			 WHERE id = '$cmrId'";
			 $updated_row = $this->db->update($query);
			if($updated_row) {
				$msg = "<span class='success'>Customer Details updated successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Customer Details not updated.</span>";
				return $msg;				
				}
	    }		
	}
}
?>