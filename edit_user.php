<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblLoginMaster where rec_id=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmEditUser" name="frmEditUser" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit User</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;" class="red">
            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                <tr>
                	<td class="form_txt" width="15%">User Name</td>
                    <td class="trow" width="20%"><input type="text" id="txtUserName" name="txtUserName" required value="<?=$row["UserName"]?>" /></td>
                    <td class="form_txt" width="15%">Email</td>
                    <td class="trow" width="20%"><input type="text" id="txtEmail" name="txtEmail" value="<?=$row["UserEmail"]?>" /></td>
                    <td class="form_txt" width="15%">Login Id</td>
                    <td class="trow" width="15%"><input type="text" id="txtLoginId" name="txtLoginId" required value="<?=$row["LoginId"]?>" /></td>
               </tr>
                <tr>
                	<td class="form_txt">Password</td>
                    <td class="trow"><input type="text" id="txtPassword" name="txtPassword" required value="<?=$row["Password"]?>" /></td>
                    <td class="form_txt">Login Type</td>
                    <td class="trow" colspan="3">
                    	<input type="radio" id="txtLoginType" name="txtLoginType" <? if($row["LoginType"]=='1') { ?> checked="checked" <? } ?> value="1" />Admin &nbsp;<input type="radio" id="txtLoginType" name="txtLoginType" <? if($row["LoginType"]=='0') { ?> checked="checked" <? } ?> value="0" />User
                    </td>
                </tr>
                <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="txtRecId" id="txtRecId" value="<?=$id?>">
                        <input name="btnEditUser" type="submit" class="button" id="btnEditUser" value="Submit"  />&nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" id="btnCancel" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? }  ?>