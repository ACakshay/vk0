<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<? 
	$flag=0;
	$message = "";
	$clientID=$_GET["cid"];
	$sqlDetails="select a.*,b.* from tblTransactionMaster a, tblTransactionDetails b where a.TransactionID=b.TransactionID";
	$sqlDetails= $sqlDetails." and a.ClientID ='".$clientID."' ";
    $resultDetails = mysql_query ($sqlDetails) or die ("Error in  query : ".$sqlDetails."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultDetails)>0)
	{
		$flag = 1;
	}
	else{
		$message = "No Record Found";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print | Client Summary</title>
<link href="inc/style.css" rel="stylesheet" type="text/css" />
<style>
.loginTxt1 {
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-align:left;
	padding-right:20px;
	color:#404040;
	font-weight:bold!important;
	font-size:11px;
}
</style>
</head>
<body>
<table width="900px" cellpadding="0" cellspacing="0" align="center" border="0" bgcolor="#FFFFFF" style="border:1px solid #CCCCCC;">
    <tr>
    	<td align="center" valign="top">
            <div style="padding:5px;"><img src="images/logo1.png" alt="VK" title="VK" width="100" /></div>
            <div class="comp_name">Client Summary</div><br>
        </td>
    </tr>
    <tr>
        <td class="message"><?=$message?></td>
    </tr>
<?
if($flag==1)
{
	$clientTrans = getTransactionDetails($clientID,'Client');
?>
    
       <tr>
    <td align="center" valign="top">
        <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            <tr bgcolor="#EFEFEF">
                <td class="heading" height="40px" style="font-size:14px;" width="70%">Client  : <?=getClientName($clientID)?></td>
                <td class="loginTxt1" style="font-size:16px;">Total Amount  : <?=$clientTrans["tSum"]?></td>
            </tr>
            <tr><td height="20px">&nbsp;</td></tr>
            <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" width="15%">S.No.</td>
                            <td class="tableHead" width="25%">Tenure <span style="color:#006600">(Due Date)</span></td>
                            <td class="tableHead" width="25%">Investor</td>
                            <td class="tableHead" width="20%">Amount</td>
                            <td class="tableHead" width="15%">Interest(%)</td>
                        </tr>
                       <?
							$count=1;
							$i=0;
							while($rowResult = mysql_fetch_array($resultDetails))
							{
								$frmDate = getDateNormalFormat($rowResult["TenureFrom"]);
								$toDate = getDateNormalFormat($rowResult["TenureTo"]);
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.<div id="div_1" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:50px; left:225px; z-index:1000; padding: 0px;"></div></td>
                            <td class="tbl_row"><?=$frmDate?> ~ <span style="color:#006600"><b><?=$toDate?></b></span></td>
                            <td class="tbl_row"><?=getInvestorName($rowResult["InvestorID"])?></td>
                            <td class="tbl_row"><? echo $trnsAmtRow[$i] = $rowResult["TransactionAmount"]; ?></td>
                            <td class="tbl_row"><?=$rowResult["FinancePercent"]?></td>
                        </tr>
                        <?	
							$i++; $count++;
							}
						?>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
    <tr><td height="10px">&nbsp;</td></tr>
    <tr><td valign="top" height="5px">&nbsp;</td></tr>
    <tr><td height="7px">&nbsp;</td></tr>
    <tr><td align="center"><a href="#" onclick="window.print();"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a></td></tr>
</table>
<?
}
?>
</body>
</html>
