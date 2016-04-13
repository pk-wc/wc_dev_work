<?php
session_start();
require_once("custom/funcs/functions.php");
if($_POST['bank'])
{
	$bank=$_POST['bank'];
		
	$res = runQuery("SELECT distinct state FROM banks_branch_info WHERE bank='$bank' order by state");
	?><option selected="selected">Select State</option><?php
	while($row = mysqli_fetch_array($res))
	{
	
		?>
        	<option value="<?php echo $row['state']; ?>"><?php echo $row['state']; ?></option>
        <?php
	}
}
?>