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
    <select name="txtInvestorBank" id="txtInvestorBank" style="width:130px;" required>
        <option value="">Select</option>
        <?
			$sqlB ="select * from tblInvestorsBankMaster where InvestorID= '".$chq_chk."' and InvestorType like '".$investorType."' ";
			$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
			if(mysql_num_rows($resultB)>0)
			{
        		while($rowB = mysql_fetch_array($resultB))
       			{
        ?>
            <option value="<?=$rowB["RecID"]?>"><?=getBankName($rowB["BankID"])?></option>
        <?
        		}
			}
        ?>
    </select>
<?
}
?>