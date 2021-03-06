<?php 
if (!isset($_SESSION)) {
    session_start();
  }

require_once('Connections/logs.php'); 
//require_once('../../connections/connection.php');


$id = @$_SESSION['myaidi'];
$utyp = @$_SESSION['utyp'];

$id = preg_replace("/[^0-9]/", "", $id);
$utyp = preg_replace("/[^a-zA-Z0-9\s]/", "", $utyp);

//SELECT * FROM `logintbl`
function change_user_access($id, $lg, $tname, $username) 
{
    //require_once('connection.php');
    $query = "SELECT id, $username, password, status FROM `$tname` WHERE id=?";
    $stmt = mysqli_prepare($lg, $query) or die(mysqli_error($lg)."query error");
    mysqli_stmt_bind_param($stmt, "s", $id);

     return $stmt;
}



function updateuser_qry($tblname, $userid, $password, $lg)
{
    //$query = mysqli_query($lg, "update students_log set passowrd = ? where username = ?") or die(mysql_error());

    $sql = "UPDATE `$tblname` SET `password` = ? WHERE `$tblname`.`id` = ?";
    $stmt = mysqli_prepare($lg, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $password, $userid);
    $stmts = mysqli_stmt_execute($stmt);

    return $stmts;
}
    

if(isset($_POST['Submit']))
{
    $username = $_POST['username'];
    $opassword = $_POST['opassword'];
    $npassword = $_POST['npassword'];
    $cpassword = $_POST['cpassword'];
    $uid = $_POST['uid'];
    $usertype = $_POST['usertype'];

 
    
    if($npassword == $cpassword)
    {


            
            if($usertype !=="Student")
            {
                $stmt = change_user_access($uid, $logs, "logintbl", "username");


            }
            else
            {
                $stmt = change_user_access($uid, $logs, "students_log", "matric_no");   
            }

            // $stmt = change_user_access($uid, $logs);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id, $uname, $pwrd, $status);
                        mysqli_stmt_store_result($stmt);
                    mysqli_stmt_fetch($stmt);


            if(password_verify($opassword, $pwrd))
            { 
                    



                        $passwordlength= strlen($npassword);
                
                    if ($passwordlength < 6)
                    {
                            $output2= "<br><redtext> Password must be at least 6 characters</redtext>";
                            echo $output2;
                    }
                    elseif ($passwordlength > 15)
                    {
                            $output2= "<br><redtext> Password cannot be greater than 15 characters</redtext>";
                            echo $output2;
                    }
                    else
                    {

                        $options = [
                            'cost' => 11,
                        ];
                    
                        $hash = password_hash($npassword, PASSWORD_BCRYPT,  $options);


                        if($usertype!=="Student")
                        {
                        $done =  updateuser_qry("logintbl", $uid, $hash, $logs);    
                        }
                        else
                        {
                            $done =  updateuser_qry("students_log", $uid, $hash, $logs);
                        }

                        
                    }
                    if($done){
                        echo "Succesful";
                    }
                    else
                    {
                        echo "unsuccessful";
                    }
                    
            }else{

               // echo "<script>alert(Password missmached);</script";
                echo '<script type="text/javascript">
                alert("Incorrect password. Password not changed");
                location.replace("s_profile.php?setting");
                </script>';
            }
    }
    else
    {
        echo '<script type="text/javascript">
        alert("Password missmached");
        location.replace("useredit.php?id='.$uid.'");
        </script>';
    }

}

// end of isset(Submit)



if($utyp !=="Student")
{
    $stmt = change_user_access($id, $logs, "logintbl", "username");


}
else
{
    $stmt = change_user_access($id, $logs, "students_log", "matric_no");   
}
    

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $uname, $pwd, $status);
mysqli_stmt_store_result($stmt);
mysqli_stmt_fetch($stmt);

?>
<form name="forms" method="POST" action="">
<table class="table table-bordered">
<tr>
<td>Username</td>
<td><input name="username" type ="text" id="username" size = "30" value="<?php echo  $uname;//$uname;?>" class="form-control" /> <span style="color:red">*</span></td>
</tr>
<tr>
<td>Old Password</td>
<td><input name="opassword" type ="password" id="opassword" size = "30" class="form-control" placeholder="Enter Old Password"/> <span style="color:red">*</span></td>
</tr>
<tr>
<td>New password</td>
<td><input name="npassword" type ="password" id="npassword" size = "30" class="form-control" placeholder="Enter New password"/> <span style="color:red">*</span></td>
</tr>
<tr>
<td>Comfirm passwod</td>
<td><input name="cpassword" type ="password" id="cpassword" size = "30" class="form-control" placeholder="Comfirm New password"/> <span style="color:red">*</span></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</table>
<input name="uid" type ="hidden" value="<?php echo $id;?>"/>
<input name="usertype" type ="hidden"  value="<?php echo $utyp;?>"/>
<br>
<input class="btn btn-gradient-primary mr-2" name="Submit" value="Submit" type="submit" />
<br>
<hr>
</form>