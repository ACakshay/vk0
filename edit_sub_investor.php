<? include ("inc/check_session.php"); ?>
<? include ("inc/functions.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<?
$message="" ;
$sub_investorid=$_GET["id"];
if(isset($_GET["id"]))
{
	$sql= "select * from tblSubInvestorMaster where SubInvestorID=".$sub_investorid;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
	
?>
<form id="frmEditSubInvestor" name="frmEditSubInvestor" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Edit Sub Investor</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$sub_investorid?>').style.visibility = 'hidden'" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center"><div id="alertMessage"><?=$message?></div></td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
            	<tr>
                    <td class="loginTxt" width="15%">Head</td>
                    <td align="left" width="15%" colspan="5"><?=getInvestorName($row["InvestorID"])?></td>
                </tr>
              	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td align="left" width="15%"><input name="txtInvestorName2" id="txtInvestorName2" type="text" value="<?=$row["InvestorName"]?>" /></td>
                    <td class="loginTxt" width="15%">Email</td>
                    <td align="left" width="20%"><input name="txtEmail2" id="txtEmail2" type="text" value="<?=$row["EmailID"]?>" /></td>
                     <td class="loginTxt" width="15%">Phone No.</td>
                    <td align="left" width="20%"><input name="txtPhone2" id="txtPhone2" type="text" value="<?=$row["PhoneNo"]?>" /></td>
                </tr>
                <tr>
                  	<td class="loginTxt">Mobile No.</td>
                    <td align="left"><input name="txtMobileNo2" id="txtMobileNo2" type="text" value="<?=$row["MobileNo"]?>" /></td>
                    <td class="loginTxt">PAN No.</td>
                    <td align="left"><input name="txtPANNO2" id="txtPANNO2" type="text" value="<?=$row["PANNo"]?>" /></td>
                	<td class="loginTxt">City</td>
                    <td align="left"><input name="txtCity2" id="txtCity2" type="text" value="<?=$row["City"]?>" /></td>
               <tr>
                    <td class="loginTxt">Address</td>
                    <td align="left" colspan="5"><textarea name="txtRegAdd2" id="txtRegAdd2" rows="1" cols="30"><?=$row["Address"]?></textarea></td>
                </tr>
                
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="SubInvestorId" id="SubInvestorId" value="<?=$sub_investorid?>" >
                        <input name="btnEditSubInvestor" type="submit" class="button" id="btnEditSubInvestor" value="Submit"/> &nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$sub_investorid?>').style.visibility = 'hidden'" value="Cancel" />
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