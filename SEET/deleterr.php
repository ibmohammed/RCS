
<?php 
//$logs = $logs;
if(isset($_POST['Submit']))
{ 

  //			$ccode=$_POST['code'];
  $semester=$_POST['semester'];
  $session=$_POST['session'];
  $year=$_POST['year'];
  $programme=$_POST['programme'];
  $programme = mysqli_escape_string($logs, $programme);
  $nsemester = ($semester - 1);

  $sql= mysqli_query($logs, "DELETE FROM `results` 
                              WHERE `prog_id` = '$programme'  && `semester` ='$semester' && `session`= '$session' ") 
                              or die ('Err'.mysqli_error($logs));

  $sqls = mysqli_affected_rows($logs);

  if($sqls !== 0)
  {

    // Select Records entered to enable Delete 

    $qry = mysqli_query($logs, "SELECT * FROM `entered` WHERE 
                                `prog_id` = '$programme' && `session` = '$session' && `semester` = '$semester'") 
                                or die('selqry'.mysqli_error($logs));


    while($fid = mysqli_fetch_assoc($qry))
    {

      $eid = $fid['sn'];


      // Query to dalete Records Selected

      $delqry = mysqli_query($logs, "DELETE FROM `entered` WHERE `sn` = '$eid' ") or die('delqry'.mysqli_error($logs));

    }
    echo "<div style='color:green; font-style:italic;'>";
    echo $semester." Records Deleted Successfully<br/>";

    // Update Student Status 
    $query = mysqli_query($logs, "UPDATE  `studentsnm` SET status = '$nsemester' 
                                   WHERE `prog_id` = '$programme' && `year` = '$year'") 
                                  or die(mysqli_error($logs));

    if ($query)
    {
      echo "Data Updated Successfully<br/>";
      echo "</div>";
    }


  }else{

    echo "records not deleted for Semester ". $semester."<br/>";

  }


} 

?>
<hr>
<br>
<em style="color:green">Select Semeter, Programme, Session and Year(class) of records to delete</em>

<form action="" method="post" name="grade" id="grade">
      
      <table class="table table-bordered">
        <tr>
          <td><strong>PROGRAMME:</strong></td>
          <td> 
          <select name="programme" id="programme" class="form-control">
            <option selected="selected" value="">Select Programme</option>
            <?php include('dptcode.php') ;
           $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
           //	$queri = mysqli_query($logs,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
           while($pcd = mysqli_fetch_assoc($queri)){
           ?>
           <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
            <?php }?>                        
          </select>
          </td>
        </tr>
        <tr>
          <td><strong>SEMESTER:</strong></td>
          <td>
          <select name="semester" class="form-control">
            <option selected="selected" value="">Select Semester</option>
            <option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
            <option value="4">Fourth Semester</option>
            <option value="5">Fifth Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
        </tr>
        <tr>
          <td><strong>SESSION:</strong></td>
          <td>
          <select name="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
            <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
            <?php echo include('includes/sessions.php');?>
          </select>
            -
            <select name="year" id="year" class="form-control">
              <option selected="selected" value="">Select Year</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
              <option>13</option>
              <option>14</option>
              <option>15</option>
              <option>16</option>
              <?php
              for($i = 17; $i<=20; $i++)
              {
                echo "<option>".$i."</option>";
              }
              ?>
            </select>
            <input  type="hidden" name="start" value="0" />
          <input type="hidden" name="list" value="20" /></td>
        </tr>
        <tr>
          <td colspan=2>&nbsp; <input name="Submit" value="Delete" type="submit" class="btn btn-gradient-primary mr-2"/></td>
         
        </tr>
          </table>

     
  </form>
<hr>
  <br>
