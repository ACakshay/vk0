<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
    $investor_id=$_GET["id"];
	$sql ="select * from tblInvestorMaster where InvestorID=".$investor_id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);

?>
<form id="frmDeleteInvestor" name="frmDeleteInvestor" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Delete Investor</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$investor_id?>').style.visibility='hidden'; " class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
            	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td class="trow" width="20%"><?=$row["InvestorName"]?></td>
                    <td class="loginTxt" width="15%">Code</td>
                    <td class="trow" width="15%"><?=$row["InvestorCode"]?></td>
                    <td class="loginTxt" width="15%">Company</td>
                    <td class="trow" width="20%"><?=$row["InvestorCompany"]?></td>
                </tr>
                <tr>
                    <td class="loginTxt">Email</td>
                    <td class="trow"><?=$row["Email"]?></td>
                    <td class="loginTxt">Contact No.</td>
                    <td class="trow"><?=$row["Phone"]?></td>
                    <td class="loginTxt">Address</td>
                    <td class="trow"><?=$row["Address1"]?> &nbsp;&nbsp;&nbsp;<?=$row["City"]?></td>
                </tr>
               <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="InvestorId" id="InvestorId" value="<?=$investor_id?>">
                        <input type="hidden" name="txtInvestorName" id="txtInvestorName" value="<?=$row["InvestorName"]?>">
                        <input type="submit" value="Yes" name="btnDeleteInvestor" class="button" id="btnDeleteInvestor"  >
                        <input type="button" value="No" onclick="document.getElementById('div_<?=$investor_id?>').style.visibility='hidden';" name="btnDeleteNo" class="button" id="btnDeleteNo">
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
