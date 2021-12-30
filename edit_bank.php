<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblBankMaster where BankID=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Bank</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;" class="red">
            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                <tr>
                    <td class="loginTxt" width="40%">Bank</td>
                    <td align="left" width="60%"><input name="txtBankName1" id="txtBankName1" type="text" value="<?=$row["BankName"]?>" autocomplete="off" /></td>
                    
                <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="BankId" id="BankId" value="<?=$id?>">
                        <input type="hidden" name="BankName" id="BankName" value="<?=$row["BankName"]?>">
                        <input name="btnEditBank" type="submit" class="button" id="btnEditBank" value="Submit"  />&nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" id="btnCancel" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<? }  ?>