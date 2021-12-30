<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
    $sub_investorid=$_GET["id"];
	$sql ="select * from tblSubInvestorMaster where SubInvestorID=".$sub_investorid;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);

?>
<form id="frmDeleteSubInvestor" name="frmDeleteSubInvestor" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Delete Sub Investor</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$sub_investorid?>').style.visibility='hidden'; " class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
            	<tr>
                    <td class="loginTxt" width="15%">Head</td>
                    <td class="trow" width="85%" colspan="5"><b><?=getInvestorName($row["InvestorID"])?></b></td>
                 </tr>
                <tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td class="trow" width="15%"><?=$row["InvestorName"]?></td>
                    <td class="loginTxt" width="15%">Email</td>
                    <td class="trow" width="20%"><?=$row["EmailID"]?></td>
                    <td class="loginTxt" width="15%">Contact No.</td>
                    <td class="trow" width="20%"><?=$row["PhoneNo"]?><? if($row["MobileNo"]!=''){echo ",&nbsp;".$row["MobileNo"];} ?></td>
                </tr>
                <tr>
                    <td class="loginTxt">PAN No.</td>
                    <td class="trow"><?=$row["PANNo"]?></td>
                    <td class="loginTxt">Address</td>
                    <td class="trow" colspan="3"><?=$row["Address"]?><? if($row["City"]!=''){echo ",&nbsp;".$row["City"];} ?></td>
                </tr>
               <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="subInvID" id="subInvID" value="<?=$sub_investorid?>">
                        <input type="hidden" name="txtInvestorName" id="txtInvestorName" value="<?=$row["InvestorName"]?>">
                        <input type="submit" value="Yes" name="btnDeleteSubInvestor" class="button" id="btnDeleteSubInvestor"  >
                        <input type="button" value="No" onClick="document.getElementById('div_<?=$sub_investorid?>').style.visibility='hidden';" name="btnDeleteNo" class="button" id="btnDeleteNo">
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
