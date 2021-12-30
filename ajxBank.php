<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$chq_chk = $_GET["id"];
	
	if($chq_chk!='0')
	{
		$sqlBank ="select * from tblBankMaster order by BankName";
		$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
		if(mysql_num_rows($resultBank)>0)
		{
		?>
		<select name="txtBankName" id="txtBankName" style="width:150px;"  onchange="get_frm4('ajxChequeNo.php',this.value,'chqDiv','<?=$chq_chk?>');" >
			<option value="">--Select Bank--</option>
			<?
			while($rowBank = mysql_fetch_array($resultBank))
			{
			?>
				<option value="<?=$rowBank["BankID"]?>"><?=$rowBank["BankName"]?></option>
			<?
			}
			?>
		</select>
		<?
		}
												   
 
 	}else{
?>
		<input name="txtBankName" id="txtBankName" type="text" disabled="disabled" /><? 
	}
}	
?>