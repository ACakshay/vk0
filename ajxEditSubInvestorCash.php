<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
?>
     <select name="txtSubInvestorE" id="txtSubInvestorE" style="width:170px;"> 
     <option value="">Select</option>
    	 <?
		 	$sqlSubIns ="select * from tblSubInvestorMaster where InvestorID= '".$id."' ";
			$resultSubIns = mysql_query ($sqlSubIns) or die ("Error in  query : ".$sqlSubIns."<br>".mysql_errno()." : ".mysql_error());
			if(mysql_num_rows($resultSubIns)>0)
			{
				while($rowSubIns = mysql_fetch_array($resultSubIns))
				{
		?>
        <option value="<?=$rowSubIns["SubInvestorID"]?>"><?=$rowSubIns["InvestorName"]?></option>
		<?
        		}
			}
        ?>
     </select>
<?
}
?>