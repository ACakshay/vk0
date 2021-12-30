<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	if($id!='')
	{
	$transId = $_GET["id2"];
	$transDetails = getBankTransactionMaster($transId);
	
?>
    <td class="loginTxt1" width="12%">Sub Investor</td>
    <td align="left" width="25%">
    <select name="txtSubInvestorE" id="txtSubInvestorE" style="width:170px;" onchange="get_frm4('ajxEditInvestorBankDetails.php',this.value,'EditInvestorBank','<?=$id?>');"> 
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
    </td>	
    <td class="loginTxt1" width="12%">Bank</td>
    <td align="left" width="20%">
    <div id="EditInvestorBank">
    <select name="txtInvestorBankE" id="txtInvestorBankE" style="width:170px;" required>
        <option value="">Select</option>
         <?
		 	$sqlBankIns ="select * from tblInvestorsBankMaster where InvestorID= '".$id."' and InvestorType like 'Head' ";
			$resultBankIns = mysql_query ($sqlBankIns) or die ("Error in  query : ".$sqlBankIns."<br>".mysql_errno()." : ".mysql_error());
			if(mysql_num_rows($resultBankIns)>0)
			{
				while($rowBankIns = mysql_fetch_array($resultBankIns))
				{
		?>
         <option value="<?=$rowBankIns["RecID"]?>"><?=getBankName($rowBankIns["BankID"])?></option>
		<?
				}
			}
        ?>
  	</select>
  </div>
    </td>
    <td class="loginTxt1" width="11%">Cheque/UTR No.</td>
    <td align="left" width="20%">
    <input type="text" style="width:170px;" name="txtInvesChequeNoE" id="txtInvesChequeNoE" value="<?=$transDetails["InvestorChequeUTRNo"]?>" autocomplete="off" required />
    </td>	
<?
	}
}
?>