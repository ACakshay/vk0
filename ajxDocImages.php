<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$message="" ;
$noOfDocs=$_GET["id"];
?>
<td colspan="2">
	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
	<?
		for($i=0;$i<$noOfDocs;$i++)
		{
	?>
		<tr><td align="center"><input type="file" name="txtDocsImg[]" id="txtDocsImg" /></td></tr>
	<?
        }
    ?>
	</table>
</td>