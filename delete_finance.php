<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
if($id!="")
{
	$sql ="select * from tblFinanceMaster where FinanceID=".$id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
		$investorName12 = getInvestorName($row["InvestmentID"]);
		$ClientName12 = getClientName($row["ClientID"]);
	}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Delete Finance</div>
        	<div style="float:right;"><input type="submit" value="" onClick="window.close()" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="5" cellspacing="0" align="center" border="0" style="border:2px solid #f4f4f4;">
               <tr>
                    <td class="loginTxt">Investment</td>
                    <td class="trow" align="center"><?=$investorName12?></td>
                    <td class="loginTxt">Client Name</td>
                    <td class="trow" align="center"><?=$ClientName12?></td>
                    <td class="loginTxt">Finance Amount</td>
                    <td class="trow" align="center"><?=$row["Amount"]?></td>
                </tr>
                <tr>
                    <td class="loginTxt">Finance Date</td>
                    <td  class="trow" align="center"><?=$row["FinanceDate"]?></td>
                    <td class="loginTxt" valign="top">Finance Percent</td>
                    <td class="trow" align="center"><?=$row["Percent"]?></td>
                    <td class="loginTxt" valign="top">Due Date</td>
                    <td class="trow" align="center"><?=$row["ReturnDate"]?></td>
                </tr>
                <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="financeId" id="financeId" value="<?=$id?>">
                        <input type="submit" value="Yes" name="btnDeleteYes" class="button" id="btnDeleteYes">
                        <input type="submit" value="No" name="btnDeleteNo" class="button" id="btnDeleteNo">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?
}
?>