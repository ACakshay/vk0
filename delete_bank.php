<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblBankMaster where BankID=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$rowuser = mysql_fetch_array($result);
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Delete Client</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
                <tr>
                    <td class="loginTxt" width="40%"><b>Bank</b></td>
                    <td align="left" width="60%"><?=$rowuser["BankName"]?></td>
                </tr>
                <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="BankId" id="BankId" value="<?=$id?>">
                        <input type="hidden" name="txtBankName" id="txtBankName" value="<?=$rowuser["BankName"]?>">
                        <input type="submit" value="Yes" name="btnDeleteYes" class="button" id="btnDeleteYes">
                        <input type="button" value="No" name="btnDeleteNo" class="button" id="btnDeleteNo" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" >
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<? }  ?>