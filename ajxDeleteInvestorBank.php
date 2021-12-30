<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
    $recID = $_GET["id"];
	$sql= "select * from tblInvestorsBankMaster where RecID=".$recID." ";
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
?>
<form id="frmEditBank" name="frmEditBank" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="left" border="0" class="myTableR">
   <tr>
        <td class="txtLeft" width="30%">Bank :</td>
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
        <td class="txtLeft">
        	<?=$row["TypeOfAccount"]?>
        </td>
    </tr>
    <tr bgcolor="#f2f2f2">
        <td align="center" colspan="6" height="40px">
            <input type="hidden" name="rec_id" id="rec_id" value="<?=$recID?>">
            <input type="hidden" name="txtBank" id="txtBank" value="<?=$rowuser["BankName"]?>">
            <input type="submit" value="Yes" name="btnDeleteYes" class="button" id="btnDeleteYes">&nbsp;&nbsp;
            <input type="submit" value="No" name="btnDeleteNo" class="button" id="btnDeleteNo" >
        </td>
    </tr>
</table></form>
<?
}
}
?>