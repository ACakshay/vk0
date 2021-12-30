<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET['id']))
{
	$id=$_GET["id"];
?>
<form id="frmAddDocImages" name="frmAddDocImages" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Add Documents Images</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              <tr>
                    <td class="loginTxt" width="50%">No. Of Documents</td>
                    <td align="left" width="50%"><input name="txtNoOfDocs" id="txtNoOfDocs" oninput="get_frm('ajxDocImages.php',this.value,'getResult');" type="number" min=1  /></td>
               </tr>
               <tr id="getResult"><td></td></tr>
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="txtTransId" id="txtTransId" value="<?=$id?>" >
                        <input name="btnAddDocs" type="submit" class="button" id="btnAddDocs" value="Submit"/> &nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$id?>').style.visibility = 'hidden'" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<?
}
?>