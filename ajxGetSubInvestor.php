<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
?>
    <td class="loginTxt1" width="12%">Sub Investor</td>
    <td align="left" width="25%">
    <select name="txtSubInvestor" id="txtSubInvestor" style="width:130px;" onchange="get_frm4('ajxInvestorBankDetails.php',this.value,'investorBank','<?=$id?>');"> 
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
    <div id="investorBank">
    <select name="txtInvestorBank" id="txtInvestorBank" style="width:130px;" required>
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
    <input type="text" style="width:130px;" name="txtInvestorChequeUTR" id="txtInvestorChequeUTR" autocomplete="off" required />
    </td>	
<?
}
?>