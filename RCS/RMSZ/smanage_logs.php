<?php
		
		$_SESSION['username'] = $uname;
		$_SESSION['password'] = $pwrd;
		$_SESSION['deptcode'] = $prog;
		$_SESSION['stid'] = $id;


		if (password_verify($password, $pwrd)) 
		{
		
		
			$loginStrGroup = "";
			//declare two session variables and assign them
			$_SESSION['MM_Usernames'] = $loginUsername;
			$_SESSION['MM_UserGroups'] = $loginStrGroup;	      
			
			if (isset($_SESSION['PrevUrl']) && true) 
			{
				$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
			}
			
			echo '<script type="text/javascript">
			location.replace("smanage.php");
			</script>';
			// exit(header("Location: " . $MM_redirectLoginSuccess ));
			// echo "Yes";
		}
		else 
		{
			echo '<script type="text/javascript">
			alert("incorrect login details'.$uname.$pwrd.'");
			location.replace("logins.php");
			</script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
        }
        ?>