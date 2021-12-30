<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblClientMaster where ClientID=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmEditClient" name="frmEditClient" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Client</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td align="left" width="15%"><input name="txtClientNameH" id="txtClientNameH" type="text" value="<?=$row["ClientName"]?>" /></td>
                    <td class="loginTxt" width="15%">Code</td>
                    <td align="left" width="20%"><input name="txtCodeH" id="txtCodeH" type="text" value="<?=$row["ClientCode"]?>" /></td>
                     <td class="loginTxt" width="15%">Email</td>
                    <td align="left" width="20%"><input name="txtEmailH" id="txtEmailH" type="text" value="<?=$row["Email"]?>" /></td>
                </tr>
                <tr>
                	<td class="loginTxt">Phone No.</td>
                    <td  align="left"><input name="txtPhoneH" id="txtPhoneH" type="text" value="<?=$row["Phone"]?>" /></td>
                    <td class="loginTxt">Mobile No.</td>
                    <td align="left"><input name="txtMobileNoH" id="txtMobileNoH" type="text" value="<?=$row["MobileNo"]?>" /></td>
                    <td class="loginTxt">PAN No.</td>
                    <td align="left"><input name="txtPANNoH" id="txtPANNoH" type="text" value="<?=$row["PANNo"]?>" /></td>
                </tr>
           		
                <tr>
                    <td class="loginTxt">City</td>
                    <td align="left"><input name="txtCityH" id="txtCityH" type="text" value="<?=$row["City"]?>" /></td>
                    <td class="loginTxt">Address</td>
                    <td align="left"><textarea name="txtRegAddH" id="txtRegAddH" rows="1" cols="30"><?=$row["Address"]?></textarea></td>
                    <td class="loginTxt">Father's Name</td>
                    <td align="left"><input name="txtFather1" id="txtFather1" type="text" value="<?=$row["FatherName"]?>" /></td>
                </tr>
                
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="txtClientId" id="txtClientId" value="<?=$id?>" >
                        <input name="btnEditClient" type="submit" class="button" id="btnEditClient" value="Submit"/> &nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$id?>').style.visibility = 'hidden'" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? }  ?>