<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<? 
	$flag=0;
	$message = "";
	$transid=$_GET["tid"];

	$sqlDetails = "select a.*,b.* from tblTransactionMaster a ,tblTransactionDetails b where a.TransactionID=b.TransactionID ";
	$sqlDetails = $sqlDetails." and a.TransactionID='".$transid."' ";;
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
<title>Print | Summary Detail</title>
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
            <div class="comp_name">Transaction Details</div><br>
        </td>
    </tr>
    <tr>
        <td class="message">Message<?=$message?></td>
    </tr>
<?
if($flag==1)
{
	$rowResult = mysql_fetch_array($resultDetails);
?>
    <tr>
    	<td align="center">
        	<table width="900px" cellpadding="4" cellspacing="0" align="center" border="0">
                <tr>
                    <td width="450" valign="top" class="Txt11" style="text-align:left;">Tenure : <b><?=getDateNormalFormat($rowResult["TenureFrom"])?> - To - <?=getDateNormalFormat($rowResult["TenureTo"])?></b></td>
                    <td width="450px" valign="top" class="Txt11" style="text-align:right;">Transaction Mode : <b><?=$rowResult["TransactionMode"]?></b></td>
                </tr>
                 <tr>
                    <td width="900px" class="Txt11" style="text-align:left;">Transaction Amount : <b><?=$rowResult["TransactionAmount"]?></b></td>
                </tr>
            </table>
        </td>
    </tr>
   <tr>
        <td align="center" valign="top">
            <table width="900px" cellpadding="2" cellspacing="0" align="center" border="0" class="myTableR">
                <tr bgcolor="#EFEFEF">
                    <td class="loginTxt1" colspan="4">Investor  : <?=getInvestorName($rowResult["InvestorID"])?></td>
                </tr>
                <tr>
                  	<td class="loginTxt1" width="150px">Bank</td>
                    <td class="txt12" width="300px"><?=getBankName($rowResult["InvestorBankID"])?></td>
                  	<td class="loginTxt1" width="200px">Cheque/UTR No.</td>
                    <td class="txt12" width="250px"><?=$rowResult["InvestorChequeUTRNo"]?></td>
                </tr>
               	<tr bgcolor="#EFEFEF">
                    <td class="loginTxt1" colspan="4">Client Name : <?=getClientName($rowResult["ClientID"])?></td>
                </tr>
                <tr>
                	<td colspan="4">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                        <tr>
                             <td class="loginTxt1" width="60%" colspan="2">Bank</td>
                             <td class="loginTxt1" width="40%">Cheque No.</td>
                        </tr>
                         <tr>
                            <td class="loginTxt1" width="20%">Repayment</td>
                            <td class="txt12" width="40%"><? $clientBankDetails = getClientBankDetails($rowResult["RepaymentBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                           <td class="txt12" width="40%"><?=$rowResult["RepaymentChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="loginTxt1">Interest</td>
                            <td class="txt12"><? $clientBankDetails = getClientBankDetails($rowResult["InterestBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txt12"><?=$rowResult["InterestChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="loginTxt1">Commission</td>
                            <td class="txt12"><? $clientBankDetails = getClientBankDetails($rowResult["CommissionBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txt12"><?=$rowResult["CommissionChequeNo"]?></td>
                        </tr>
                      </table>
                    </td>
                </tr>
                <tr bgcolor="#EFEFEF">
                    <td class="loginTxt1" colspan="4">Other Details</td>
                </tr>
                <tr>
                	<td colspan="4">
                    	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                            <tr>
                                <td class="loginTxt1">Investment %</td>
                                <td class="loginTxt1">Finance %</td>
                                <td class="loginTxt1">Negotiator %</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txt12">&nbsp;</td>
                                            <td class="loginTxt1">Bank %</td>
                                            <td class="loginTxt1">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txt12"><?=$rowResult["InvesPercent"]?></td>
                                            <td class="txt12"><?=$rowResult["InvesBankPercent"]?></td>
                                            <td class="txt12"><?=$rowResult["InvesCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txt12">&nbsp;</td>
                                            <td class="loginTxt1">Bank %</td>
                                            <td class="loginTxt1">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txt12"><?=$rowResult["FinancePercent"]?></td>
                                            <td class="txt12"><?=$rowResult["FinanceBankPercent"]?></td>
                                            <td class="txt12"><?=$rowResult["FinanceCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txt12">&nbsp;</td>
                                            <td class="loginTxt1">Bank %</td>
                                            <td class="loginTxt1">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txt12"><?=$rowResult["NegotiatorPercent"]?></td>
                                            <td class="txt12"><?=$rowResult["NegotiatorBankPercent"]?></td>
                                            <td class="txt12"><?=$rowResult["NegotiatorCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="loginTxt1">Investor TDS %</td>
                    <td class="txt12"><?=$rowResult["InvestorTDSPercent"]?></td>
                    <td class="loginTxt1">Negotiator TDS %</td>
                    <td class="txt12"><?=$rowResult["NegotiatorTDSPercent"]?></td>
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
