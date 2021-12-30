<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET['id']))
{
	$id=$_GET["id"];
	$sql ="select * from tblLoginMaster where rec_id=".$id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$rowuser = mysql_fetch_array($result);
?>
<form id="frmDeleteUser" name="frmDeleteUser" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Delete USer</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
                <tr>
                    <td class="form_txt" width="15%">User</td>
                    <td class="trow" width="20%"><?=$rowuser["UserName"]?></td>
                    <td class="form_txt" width="15%">Email</td>
                    <td class="trow" width="20%"><?=$rowuser["UserEmail"]?></td>
                    <td class="form_txt" width="15%">Login Id</td>
                    <td class="trow" width="15%"><?=$rowuser["LoginId"]?></td>
                </tr>
                <tr>
                	<td class="form_txt">Password</td>
                    <td class="trow"><?=$rowuser["Password"]?></td>
                    <td class="form_txt">Login Type</td>
                    <td class="trow" colspan="3"><? if($rowuser["LoginType"]=='1') { ?> Admin <? }else{ ?>User<? } ?></td>
                </tr>
                <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="txtRecId" id="txtRecId" value="<?=$id?>">
                        <input type="hidden" name="txtUserName" id="txtUserName" value="<?=$rowuser["UserName"]?>">
                        <input type="submit" value="Yes" name="btnDeleteYes" class="button" id="btnDeleteYes">
                        <input type="button" value="No" name="btnDeleteNo" class="button" id="btnDeleteNo" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" >
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? } }  ?>