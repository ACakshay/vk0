<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblNegotiatorMaster where NegotiatorID=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmEditNegotiator" name="frmEditNegotiator" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Negotiator</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td align="left" width="15%"><input name="txtName1" id="txtName1" type="text" value="<?=$row["NegotiatorName"]?>" /></td>
                    <td class="loginTxt" width="15%">PAN No.</td>
                    <td align="left" width="20%"><input name="txtPAN1" id="txtPAN1" type="text" value="<?=$row["PANNo"]?>" /></td>
                     <td class="loginTxt" width="15%">City</td>
                    <td align="left" width="20%"><input name="txtCity1" id="txtCity1" type="text" value="<?=$row["City"]?>" /></td>
                </tr>
                <tr>
                	<td class="loginTxt">Address</td>
                    <td  align="left" colspan="4"><input name="txtAdd1" id="txtAdd1" type="text" value="<?=$row["Address"]?>" /></td>
                </tr>
           		<tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="NegotiatorID" id="NegotiatorID" value="<?=$id?>" >
                        <input name="btnEditNegotiator" type="submit" class="button" id="btnEditNegotiator" value="Submit"/> &nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$id?>').style.visibility = 'hidden'" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? }  ?>