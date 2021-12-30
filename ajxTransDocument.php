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
<form id="frmTransDoc" name="frmTransDoc" method="post">
<div style="overflow-y:scroll;">
<table width="100%" cellpadding="0" cellspacing="0" align="left" border="0" class="myTableR">
   <tr>
        <td class="txtLeft"><img src="<?=$transactionDocsUploadURL?><?=$row["DocImage"]?>" border="0" /></td>
    </tr>
    <tr bgcolor="#f2f2f2">
        <td align="center" height="40px">
            <input type="submit" value="Close" name="btnDeleteNo" class="button" id="btnDeleteNo" >
        </td>
    </tr>
</table>
</div>
<?
}
?>