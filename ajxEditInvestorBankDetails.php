<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$chq_chk = $_GET["id"];
	$investorType = 'SubInvestor';
	if($chq_chk=='')
	{
		$chq_chk = $_GET["id2"];
		$investorType = 'Head'; 
	}
?>
    <select name="txtInvestorBankE" id="txtInvestorBankE" style="width:170px;" required>
        <option value="">Select</option>
        <?
			$sqlBankIns ="select * from tblInvestorsBankMaster where InvestorID= '".$chq_chk."' and InvestorType like '".$investorType."' ";
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
<?
}
?>