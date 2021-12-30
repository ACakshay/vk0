<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<script language="javascript" type="text/javascript">
function popitup(url) {
	newwindow=window.open(url,'name','width=920, height=700, scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<? 
	$flag=0;
	$message = "";
	$transid=$_GET["tid"];
	$tType=$_GET["tt"];
	$tStatus=$_GET["st"];
	if($tStatus==0)
	{
		if($tType=='Bank'){ $tbl = 'tblBankTransactionDetails'; }else{  $tbl = 'tblCashTransactionDetails'; }
	}elseif($tStatus==1){
		 $tbl = 'tblExtendedTransaction';
	}
	
	$sqlDetails = "select a.*,b.* from tblTransactionMaster a ,".$tbl." b where a.TransactionID=b.TransactionID ";
	$sqlDetails = $sqlDetails." and a.TransactionMode = '".$tType."' and a.TransactionID='".$transid."' ";
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
<title>Print | Transaction Detail</title>
<link href="inc/style.css" rel="stylesheet" type="text/css" />
<style>
/*.loginTxt1 {
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-align:left;
	padding-right:20px;
	color:#404040;
	font-weight:bold!important;
	font-size:11px;
}*/
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
        <td class="message"><?=$message?></td>
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
                    <td width="450" valign="top" class="Txt11" style="text-align:left;">Tenure : <b><?=getDateDBFormat($rowResult["TenureFrom"])?> - To - <?=getDateDBFormat($rowResult["TenureTo"])?></b></td>
                    <td width="450px" valign="top" class="Txt11" style="text-align:right;">Transaction Mode : <b><?=$rowResult["TransactionMode"]?></b></td>
                </tr>
                 <tr>
                    <td width="900px" class="Txt11" style="text-align:left;">Transaction Amount : <b><?=$rowResult["TransactionAmount"]?></b></td>
                </tr>
            </table>
        </td>
    </tr>
    <?
		if($tType=='Bank')
		{
	?>
   <tr>
        <td align="center" valign="top">
            <table width="900px" cellpadding="2" cellspacing="0" align="center" border="0" class="myTableR">
                <tr bgcolor="#EFEFEF">
                	<td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" width="15%" colspan="4"><?=getInvestorName($rowResult["InvestorID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubInvestorID"]!='0'){  ?> ~~ &nbsp;&nbsp;&nbsp;<?=getSubInvestorName($rowResult["SubInvestorID"])?> <? } ?></td>
                </tr>
                <tr>
                  	<td class="loginTxt1" width="150px">Bank</td>
                    <td class="txt12" width="300px"><?=getBankName($rowResult["InvestorBankID"])?></td>
                  	<td class="loginTxt1" width="200px">Cheque/UTR No.</td>
                    <td class="txt12" width="250px"><?=$rowResult["InvestorChequeUTRNo"]?></td>
                </tr>
               	<tr bgcolor="#EFEFEF">
                    <td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" width="15%" colspan="4"><?=getClientName($rowResult["ClientID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubClientID"]!='0'){  ?> ~~ &nbsp;&nbsp;&nbsp;<?=getSubClientName($rowResult["SubClientID"])?> <? } ?></td>
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
                 <tr>
                    <td class="loginTxt1">Remark</td>
                    <td class="txt12" colspan="4"><?=$rowResult["Remark"]?></td>
                </tr>
            </table>
        </td>
    </tr>
    <?
		$sqlExt="select * from tblExtendedTransaction where TransactionID='".$transid."' ";
		$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
		if (mysql_num_rows($resultExt)>0)
		{
	?>
    <tr>
        <td colspan="4" class="loginTxt2">Extended</td>
    </tr>
    <?
			while($rowExt = mysql_fetch_array($resultExt))
			{
	?>
    	<tr>
        	<td width="450" valign="top" class="Txt11" style="text-align:left;">Tenure : <b><?=getDateDBFormat($rowExt["TenureFrom"])?> - To - <?=getDateDBFormat($rowExt["TenureTo"])?></b></td>
        </tr>
    	<tr>
            <td align="center" valign="top">
                <table width="900px" cellpadding="2" cellspacing="0" align="center" border="0" class="myTableR">
                	<tr>
                	<td colspan="4">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                        <tr>
                             <td class="loginTxt1" width="60%" colspan="2">Bank</td>
                             <td class="loginTxt1" width="40%">Cheque No.</td>
                        </tr>
                         <tr>
                            <td class="loginTxt1" width="20%">Repayment</td>
                            <td class="txt12" width="40%"><? $clientBankDetails = getClientBankDetails($rowExt["RepaymentBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                           <td class="txt12" width="40%"><?=$rowExt["RepaymentChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="loginTxt1">Interest</td>
                            <td class="txt12"><? $clientBankDetails = getClientBankDetails($rowExt["InterestBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txt12"><?=$rowExt["InterestChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="loginTxt1">Commission</td>
                            <td class="txt12"><? $clientBankDetails = getClientBankDetails($rowExt["CommissionBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txt12"><?=$rowExt["CommissionChequeNo"]?></td>
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
                                            <td class="txt12"><?=$rowExt["InvesPercent"]?></td>
                                            <td class="txt12"><?=$rowExt["InvesBankPercent"]?></td>
                                            <td class="txt12"><?=$rowExt["InvesCashPercent"]?></td>
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
                                            <td class="txt12"><?=$rowExt["FinancePercent"]?></td>
                                            <td class="txt12"><?=$rowExt["FinanceBankPercent"]?></td>
                                            <td class="txt12"><?=$rowExt["FinanceCashPercent"]?></td>
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
                                            <td class="txt12"><?=$rowExt["NegotiatorPercent"]?></td>
                                            <td class="txt12"><?=$rowExt["NegotiatorBankPercent"]?></td>
                                            <td class="txt12"><?=$rowExt["NegotiatorCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="loginTxt1" width="200px">Investor TDS %</td>
                    <td class="txt12" width="250px"><?=$rowExt["InvestorTDSPercent"]?></td>
                    <td class="loginTxt1" width="200px">Negotiator TDS %</td>
                    <td class="txt12" width="250px"><?=$rowExt["NegotiatorTDSPercent"]?></td>
                </tr>
                </table>
            </td>
       </tr>	
    <?
			}
		}
		}else{
	?>
    	<tr>
        <td align="center" valign="top">
            <table width="900px" cellpadding="2" cellspacing="0" align="center" border="0" class="myTableR">
                <tr bgcolor="#EFEFEF">
                    <td class="loginTxt1" style="font-size:16px; text-align:center; font-weight:bold;" colspan="4"><?=getInvestorName($rowResult["InvestorID"])?> &nbsp;&nbsp;&nbsp;<? if($rowResult["SubInvestorID"]!=0){  ?><?=getSubInvestorName($rowResult["SubInvestorID"])?> <? } ?></td>
                </tr>
                <tr><td height="5px;" colspan="4">&nbsp;</td></tr>
                <tr bgcolor="#EFEFEF">
                    <td class="loginTxt1" style="font-size:16px; text-align:center; font-weight:bold;" colspan="4"><?=getClientName($rowResult["ClientID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubClientID"]!=0){  ?><?=getSubClientName($rowResult["SubClientID"])?> <? } ?></td>
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
                                <td align="left"><?=$rowResult["InvesPercent"]?></td>
                                <td align="left"><?=$rowResult["FinancePercent"]?></td>
                                <td align="left"><?=$rowResult["NegotiatorPercent"]?></td>
                            </tr>
                            <tr>
                                <td class="loginTxt1">Remark</td>
                                <td class="txt12" colspan="2"><?=$rowResult["Remark"]?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
             </table>
        </td>
    </tr>
    <?
		}
	?>
    
    <tr><td height="10px">&nbsp;</td></tr>
    <?
		 $sqlDoc="select * from tblTransactionDocument where TransactionID=".$transid." ";
      	 $resultDoc=mysql_query($sqlDoc) or die ("Query Failed ".mysql_error());
      	 if (mysql_num_rows($resultDoc)>0)
         {
	?>
    <tr>
    	<td>
        	<table width="900px" cellpadding="2" cellspacing="0" align="center" border="0" class="myTableR">
            	<tr><td colspan="4">Documents</td></tr>
                <tr>
                	<? $count =1; while($rowDoc = mysql_fetch_array($resultDoc)){ ?>
    				<td><a href="<?=$transactionDocsUploadURL?><?=$rowDoc["DocImage"]?>" onClick="
                    
                     document.body.innerHTML +='<div onclick='window.history.back();'>Back</div>';
                    "><img src="<?=$transactionDocsUploadURL?><?=$rowDoc["DocImage"]?>" width="150px" height="150px;" border="0" alt="Not Available" title="Doc Image" /></a></td>
       				<? $count++;  if($count>4) { echo "<tr bgcolor='#EFEFEF'></tr>"; $count=1;} }?>
                </tr>
            </table>
        </td>
   </tr>
   <?
   		}
   ?>
    <tr><td height="7px">&nbsp;</td></tr>
    <tr><td align="center"><a href="#" onClick="window.print();"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a></td></tr>
</table>
<?
}
?>
</body>
</html>
