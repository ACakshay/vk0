<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<?
$message="" ;
$investor_id=$_GET["id"];
if(isset($_GET["id"]))
{
	$sql= "select * from tblInvestorMaster where InvestorID=".$investor_id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
	
?>
<form id="frmEditInvestor" name="frmEditInvestor" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Investor</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$investor_id?>').style.visibility = 'hidden'" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center"><div id="alertMessage"><?=$message?></div></td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              	<tr>
                    <td class="loginTxt" width="18%">Name</td>
                    <td align="left" width="12%"><input name="txtInvestorName1" id="txtInvestorName1" type="text" value="<?=$row["InvestorName"]?>" /></td>
                    <td class="loginTxt" width="20%">Code</td>
                    <td align="left" width="15%"><input name="txtCode1" id="txtCode1" type="text" value="<?=$row["InvestorCode"]?>" /></td>
                     <td class="loginTxt" width="15%">Email</td>
                    <td align="left" width="20%"><input name="txtEmail1" id="txtEmail1" type="text" value="<?=$row["Email"]?>" /></td>
                </tr>
                <tr>
                  	 <td class="loginTxt">Phone No.</td>
                    <td  align="left"><input name="txtPhone1" id="txtPhone1" type="text" value="<?=$row["Phone"]?>" /></td>
                    <td class="loginTxt">Mobile No.</td>
                    <td align="left"><input name="txtMobileNo1" id="txtMobileNo1" type="text" value="<?=$row["MobileNo"]?>" /></td>
                    <td class="loginTxt">PAN No.</td>
                    <td align="left"><input name="txtPANNO1" id="txtPANNO1" type="text" value="<?=$row["PANNo"]?>" /></td>
                </tr>
           		
                <tr>
                    <td class="loginTxt">City</td>
                    <td align="left"><input name="txtCity1" id="txtCity1" type="text" value="<?=$row["City"]?>" /></td>
                    <td class="loginTxt">Address</td>
                    <td align="left"><textarea name="txtRegAdd1" id="txtRegAdd1" rows="1" cols="30"><?=$row["Address"]?></textarea></td>
                    <td class="loginTxt">Father's Name</td>
                    <td align="left"><input name="txtFather1" id="txtFather1" type="text" value="<?=$row["FatherName"]?>" /></td>
                </tr>
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="InvestorId" id="InvestorId" value="<?=$investor_id?>" >
                        <input name="btnEditInvestor" type="submit" class="button" id="btnEditInvestor" value="Submit"/> &nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$investor_id?>').style.visibility = 'hidden'" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<?
	}
}
?>