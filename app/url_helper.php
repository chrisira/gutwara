<?php
	// Simple page redirect
	function redirect($userPhone,$password,$type){
		echo $userPhone." ".$password." ".$type;
		global $db;
		$page         = "";
		$loginPage    = "auth/login.php";
		$studentDashboard ="student/student-dashboard.php";

		if ($userPhone == '' || $userPhone == null) {
			$page = $loginPage;
		}else{

			if($password == 'true'){

				switch($type){

					case "student":

					if($db->check("SELECT * FROM `users` WHERE `users`.`phone` = ?",["$userPhone"]) == true){
						$page = $studentDashboard;
						
					}
					break;
					default:

					$page = $loginPage;
					break;

				}
				
			}else{
	
				$page =$loginPage;
			}
		}
		header('Location: ' . URLROOT . $page);
	}