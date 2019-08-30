
<?php 
if (isset($_POST['Submit']))
{
  //echo '<h3>'..'</h3>';
  ?>
  <style>
#thisTable {
    color: #2b2b2b;
    font-family: "Roboto Condensed";
}

th {
    text-align: left;
    color: #4679bd;
}

tbody > tr:nth-of-type(even) {
    background-color: #daeaff;
}

button {
    cursor: pointer;
    margin-top: 1rem;
}
</style>


<script>

function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(filename) {
	var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

</script>

<?php 
  
$dept = $_POST['dept'];
$year=$_POST['year'];
$result =  score_templates($logs, $dept, $year);

?>
<hr>
<em style="color:green">Click on "Generate Template" button below to download score template</em>
<table class="table table-bordered" id ="thisTable">
<tr><th>Number</th><th>Score</th>
<?php
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
  ?>
  <tr><td><?php echo $row['matno'];?></td>
  <td></td>
  </tr>
  <?php   
}
 ?>
</table>
<button onClick="export_table_to_csv('table.csv')" class="btn btn-gradient-primary mr-2">Download template</button>

 <?php 
 // exit;
 $templates = 0;
}?>

<br>
<hr>
<?php 
if($templates == 2)
{
  require("template_foem.php");
}
?>