<?php
session_start();
require_once("custom/funcs/functions.php");
if($_POST['city'])
{
	
	$state=$_POST['state'];
	$bank=$_POST['bank'];
	$city=$_POST['city'];
	
	$res = runQuery("SELECT distinct branch,ifsc FROM banks_branch_info WHERE state='$state' and bank='$bank' and city='$city' order by branch");
	?><option selected="selected">Select Branch</option><?php
	while($row = mysqli_fetch_array($res))
	{
	
		?>
        	<option value="<?php echo $row['ifsc']; ?>"><?php echo $row['branch']; ?></option>
        <?php
	}
}
?>