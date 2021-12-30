<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql="select a.*,b.* from tblTransactionMaster a ,tblTransactionDetails b where a.TransactionID=b.TransactionID and a.TransactionID= '".$id."' ";
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmEditTransaction" name="frmEditTransaction" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Transaction</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td align="left" width="15%"><input name="txtClientName1" id="txtClientName1" type="text" value="" /></td>
                    <td class="loginTxt" width="15%">Company</td>
                    <td align="left" width="20%"><input name="txtCompany1" id="txtCompany1" type="text" value="" /></td>
                     <td class="loginTxt" width="15%">Code</td>
                    <td align="left" width="20%"><input name="txtCode1" id="txtCode1" type="text" value="" /></td>
                </tr>
                <tr>
                  	 <td class="loginTxt">Email</td>
                   	 <td align="left"><input name="txtEmail1" id="txtEmail1" type="text" value="" /></td>
                     <td class="loginTxt">Phone No.</td>
                    <td  align="left"><input name="txtPhone1" id="txtPhone1" type="text" value="" /></td>
                    <td class="loginTxt">Mobile No.</td>
                    <td align="left"><input name="txtMobileNo1" id="txtMobileNo1" type="text" value="" /></td>
                </tr>
           		
                <tr>
                    <td class="loginTxt">City</td>
                    <td align="left"><input name="txtCity1" id="txtCity1" type="text" value="" /></td>
                    <td class="loginTxt">Head</td>
                   	<td align="left">
					
				 	</td>
                     <td class="loginTxt">Address</td>
                    <td align="left"><textarea name="txtRegAdd1" id="txtRegAdd1" rows="1" cols="30"></textarea></td>
                </tr>
                
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="txtClientId" id="txtClientId" value="<?=$id?>" >
                        <input type="hidden" name="txtClientName1" id="txtClientName1" value="" >
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