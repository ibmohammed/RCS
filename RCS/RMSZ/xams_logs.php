<?php

if (!isset($_SESSION))
{
  session_start();
}
	//Exxams and records login  
	
		$_SESSION['username'] = $uname;
		$_SESSION['password'] = $pwrd;
		$_SESSION['deptcode'] = $prog;
		$_SESSION['stid'] = $id;
		
		
		$stff = login_scomfirm($number, $logs);
		//mysqli_stmt_bind_param($stff, "s", $uname);
		mysqli_stmt_execute($stff);
		mysqli_stmt_bind_result($stff, $stfid, $name, $number, $contact, $dept_id);
		mysqli_stmt_store_result($stff);
		mysqli_stmt_fetch($stff);	

		//if ($loginFoundUser) 
		if (password_verify($password, $pwrd)) 
		{
			$_SESSION['users_types'] = 3;
			$_SESSION['page_name']= "NSPZ RMS-Exams_Records";
			$_SESSION['themenu'] = "newmenus_exams.php" ;
			$page_dir = "index.php";
			//$page_dir = "exams_records.php";
			include("dchronicle.php");
		}
		else 
		{
			echo '<script type="text/javascript">
            alert("incorrect login");
            location.replace("logins.php");
            </script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
		}

