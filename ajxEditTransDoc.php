<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$recID = $_GET["id"];
$sql= "select * from tblTransactionDocument where RecID=".$recID." ";
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmTransDoc" name="frmTransDoc" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="left" border="0" class="myTableR">
   <tr>
        <td class="txtLeft">
        	<img src="<?=$transactionDocsUploadURL?><?=$row["DocImage"]?>" width="100px" height="100px" border="0" />
            <input type="file" id="txtDocsImg1" name="txtDocsImg1">
        </td>
    </tr>
    <tr bgcolor="#f2f2f2">
        <td align="center" height="40px">
            <input type="hidden" name="doc_id" id="doc_id" value="<?=$recID?>">
            <input name="btnEditDocument" type="submit" class="button" id="btnEditDocument" value="Update" />&nbsp;&nbsp;&nbsp;
            <input name="btnCancel" type="submit" class="button" id="btnCancel" value="Cancel" onclick="document.getElementById('div_<?=$id?>').innerHTML ='';" />
        </td>
    </tr>
</table>
</form>
<?
}
?>