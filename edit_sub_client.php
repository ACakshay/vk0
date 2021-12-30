<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblSubClientMaster where SubClientID=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmEditClient" name="frmEditClient" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Sub Client</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td align="left" width="15%"><input name="txtClientName1" id="txtClientName1" type="text" value="<?=$row["ClientName"]?>" /></td>
                   <td class="loginTxt" width="15%">Email</td>
                    <td align="left" width="20%"><input name="txtEmail1" id="txtEmail1" type="text" value="<?=$row["EmailID"]?>" /></td>
                    <td class="loginTxt" width="15%">Phone No.</td>
                    <td  align="left" width="20%"><input name="txtPhone1" id="txtPhone1" type="text" value="<?=$row["PhoneNo"]?>" /></td>
                    
                </tr>
                <tr>
                	<td class="loginTxt">Mobile No.</td>
                    <td align="left"><input name="txtMobileNo1" id="txtMobileNo1" type="text" value="<?=$row["MobileNo"]?>" /></td>
                    <td class="loginTxt">PAN No.</td>
                    <td align="left"><input name="txtPANNo1" id="txtPANNo1" type="text" value="<?=$row["PANNo"]?>" /></td>
                    <td class="loginTxt">City</td>
                    <td align="left"><input name="txtCity1" id="txtCity1" type="text" value="<?=$row["City"]?>" /></td>
                </tr>
           		<tr>
                    <td class="loginTxt">Address</td>
                    <td align="left" colspan="5"><textarea name="txtRegAdd1" id="txtRegAdd1" rows="1" cols="30"><?=$row["Address"]?></textarea></td>
                </tr>
                
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="txtSubClientId" id="txtSubClientId" value="<?=$id?>" >
                        <input name="btnEditSubClient" type="submit" class="button" id="btnEditSubClient" value="Submit"/> &nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$id?>').style.visibility = 'hidden'" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? }  ?>