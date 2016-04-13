<?php
session_start();
require_once("custom/funcs/functions.php");
if($_POST['state'])
{
	
	$state=$_POST['state'];
	$bank=$_POST['bank'];
	
	$res = runQuery("SELECT distinct city FROM banks_branch_info WHERE state='$state' and bank='$bank' order by city");
	?><option selected="selected">Select City</option><?php
	while($row = mysqli_fetch_array($res))
	{
	
		?>
        	<option value="<?php echo $row['city']; ?>"><?php echo $row['city']; ?></option>
        <?php
	}
}
?>