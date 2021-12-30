<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$bankId = $_GET["id"];
	$sql ="select * from tblClientBankMaster where RecID=".$bankId." ";
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
?>
<form id="frmDltBank" name="frmDltBank" method="post">
    <table width="100%" cellpadding="0" cellspacing="0" align="left" border="0" class="myTableR">
       <tr>
            <td  width="30%" class="txtLeft">Bank :</td>
            <td class="txtLeft"><? echo $bankName= getBankName($row["BankID"]); ?></td>
        </tr>
        <tr>
            <td class="txtLeft">Name :</td>
            <td class="txtLeft"><?=$row["AccountHolderName"]?></td>
        </tr>
        <tr>
            <td class="txtLeft">Account No. :</td>
            <td class="txtLeft"><?=$row["AccountNo"]?></td>
        </tr>
        <tr>
            <td class="txtLeft">Branch :</td>
            <td class="txtLeft"><?=$row["BankBranch"]?></td>
        </tr>
        <tr>
            <td class="txtLeft">IFSC Code :</td>
            <td class="txtLeft"><?=$row["IFSCCode"]?></td>
        </tr>
        <tr>
            <td class="txtLeft">Account Type :</td>
            <td class="txtLeft"><?=$row["TypeOfAccount"]?></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center" colspan="6" height="40px">
                <input type="hidden" name="client_bank_id" id="client_bank_id" value="<?=$bankId?>">
                <input type="hidden" name="txtBank" id="txtBank" value="<?=$row["BankName"]?>">
                <input type="submit" value="Yes" name="btnDeleteYes" class="button" id="btnDeleteYes">&nbsp;&nbsp;
                <input type="submit" value="No" name="btnDeleteNo" class="button" id="btnDeleteNo" >
            </td>
        </tr>
    </table>
</form>
<?
	}
}
?>