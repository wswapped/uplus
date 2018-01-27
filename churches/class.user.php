<?php
    class user{
    	 function getUser(){
	        global $conn;
	        if (isset($_SESSION['loginusername'])) {
	            $loginusername = $_SESSION['loginusername'];
	            $loginpassword = $_SESSION['loginpassword'];
	            $selectid = $conn ->query("SELECT * FROM users WHERE loginName='$loginusername' AND loginpsw='$loginpassword'");
	            $fetchid = mysqli_fetch_array($selectid);
	            $userId = $fetchid['Id'];
	            return $userId;
	        }else return false;
	    }
	    function church($userID){
	        //Function to find user's church from $userID
	        global $conn;
	        $query = $conn->query("SELECT church FROM users WHERE id = \"$userID\"")  or die($conn->error());
	        if($query->num_rows){
	        	$data = $query->fetch_assoc();
	        	return $data['church'];
	        }else return false;
    	}
    	function churchDet($id){
    		//Church details of $user $id
    		global $conn;

    		$query = mysqli_query($conn, "SELECT branches.name as branch, church.name as church FROM users JOIN branches ON users.church = branches.id JOIN church ON branches.church = church.id WHERE users.id= \"$id\"")  or die($conn->error());
    		if(mysqli_num_rows($query)){
    			$data = mysqli_fetch_assoc($query);
    			return $data;
    		}else return false;
    	}
    	function id2name($id){
    		global $conn;
    		$query = $conn->query("SELECT lname, fname FROM users WHERE id = \"$id\"")  or die($conn->error());
	        if($query->num_rows){
	        	$data = $query->fetch_assoc();
	        	return $data;
	        }else return false;
    	}
    }
    $User = new user();
?>