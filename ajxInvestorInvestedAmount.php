<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	 $investment_id = $_GET["id"];
	 $investor_id = getInvestorIdFromInvestment($investment_id);
	 if($investor_id!='')
	 {
	 	$sub_investor = getSubInvestor($investor_id);
	 	array_push($sub_investor,$investor_id);
	 	if(count($sub_investor)!='0')
	 	{
			 $investor_str = implode(",",$sub_investor);
		 	$sqlList ="select SUM(Amount) as totalAmount from tblInvestmentMaster where InvestorID in(".$investor_str.") and isReturned='0' ";
		 	$result = mysql_query ($sqlList) or die ("Error in  query :  ".$sqlList." <br>".mysql_errno()." : ".mysql_error());
		 	if(mysql_num_rows($result)>0)
		 	{	 
				 $row = mysql_fetch_array($result);
		 	}
?>
				<input name="txtInvestorAmount" id="txtInvestorAmount" type="text" value="<?=$row["totalAmount"]?>" readonly />
<?
			}else{
?>
				<input name="txtInvestorAmount" id="txtInvestorAmount" type="text" disabled="disabled" />
<?
		}
	}
}
?>