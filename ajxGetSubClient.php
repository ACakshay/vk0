<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	if($id!='')
	{
		$sqlSubC ="select * from tblSubClientMaster where ClientID= '".$id."' ";
		$resultSubC = mysql_query ($sqlSubC) or die ("Error in  query : ".$sqlSubC."<br>".mysql_errno()." : ".mysql_error());
		if(mysql_num_rows($resultSubC)>0)
		{
		?>
		<select name="txtSubClient" id="txtSubClient" style="width:130px;">
			<option value="">Select Sub Client</option>
			<?
			while($rowSubC = mysql_fetch_array($resultSubC))
			{
			?>
				<option value="<?=$rowSubC["SubClientID"]?>"><?=$rowSubC["ClientName"]?></option>
			<?
			}
			?>
		</select>
<?
		}
	}else{
?>
	<select name="txtSubClient" id="txtSubClient" style="width:130px;" disabled="disabled"> 
     	<option value="">Select Sub Client</option>
     </select>
<?
	}
}
?>