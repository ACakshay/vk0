<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$transStatus=$_GET["id2"];

	$sqlTrans ="select * from tblTransactionMaster where TransactionID=".$id;
	$resultTrans = mysql_query ($sqlTrans) or die ("Error in  query : ".$sqlTrans."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultTrans)>0)
	{
		$rowTrans= mysql_fetch_array($resultTrans);
		if($transStatus!=0)
		{
			$recid = $transStatus;
			$where =" and RecID='".$transStatus."' "; $tbl = "tblExtendedTransaction";
		}else{ $recid = $id; $where =" and TransactionID='".$id."' "; if($rowTrans["TransactionMode"]=='Bank'){ $tbl = "tblBankTransactionDetails"; }else{ $tbl = "tblCashTransactionDetails"; }  }
		
		$sql="select* from ".$tbl." where 1 ".$where." ";
		$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
		if(mysql_num_rows($result)>0)
		{
			$row = mysql_fetch_array($result);
?>
<form id="frmDeleteTranscation" name="frmDeleteTranscation" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Delete Transcation</div>
            <div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$recid?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<div style="overflow-y:scroll; height:350px;">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
            	<?
				if($rowTrans["TransactionMode"]=='Bank')
				{
				?> 
              	<tr>
                    <td class="loginTxt" width="15%">Tenure</td>
                    <td align="left" width="20%"><?=getDateDBFormat($rowTrans["TenureFrom"])?> - <?=getDateDBFormat($rowTrans["TenureTo"])?></td>
                    <td class="loginTxt" width="15%">Transaction Mode</td>
                    <td align="left" width="15%"><?=$rowTrans["TransactionMode"]?></td>
                    <td class="loginTxt" width="15%">Transaction Amount</td>
                    <td align="left" width="20%"><?=$rowTrans["TransactionAmount"]?></td>
                </tr>
                <tr>
                	<td class="loginTxt">Investor Name</td>
                    <td align="left"><?=getInvestorName($rowTrans["InvestorID"])?></td>
                    <td class="loginTxt">Sub Investor</td>
                    <td align="left" colspan="3"><? if($rowTrans["SubInvestorID"]!='0'){  ?><?=getSubInvestorName($rowTrans["SubInvestorID"])?> <? } ?></td>
                </tr>
                <tr>
                	<td class="loginTxt">Bank</td>
                    <td align="left"><?=getBankName($row["InvestorBankID"])?></td>
                    <td class="loginTxt">Cheque/UTR No.</td>
                    <td align="left" colspan="3"><?=$row["InvestorChequeUTRNo"]?></td>
                </tr>
           		<tr>
                	<td class="loginTxt">Client</td>
                    <td align="left"><?=getClientName($rowTrans["ClientID"])?></td>
                    <td class="loginTxt">Sub Client</td>
                    <td align="left" colspan="3"><? if($rowTrans["SubClientID"]!='0'){  ?><?=getSubClientName($rowTrans["SubClientID"])?> <? } ?></td>
                </tr>
                <tr>
                	<td colspan="6">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                        <tr>
                             <td class="txtLeft" width="60%" colspan="2">Bank</td>
                             <td class="txtLeft" width="40%">Cheque No.</td>
                        </tr>
                         <tr>
                            <td class="txtLeft" width="20%">Repayment</td>
                            <td class="txtLeft" width="40%"><? $clientBankDetails = getClientBankDetails($row["RepaymentBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                           <td class="txtLeft" width="40%"><?=$row["RepaymentChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="txtLeft">Interest</td>
                            <td class="txtLeft"><? $clientBankDetails = getClientBankDetails($row["InterestBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txtLeft"><?=$row["InterestChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="txtLeft">Commission</td>
                            <td class="txtLeft"><? $clientBankDetails = getClientBankDetails($row["CommissionBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txtLeft"><?=$row["CommissionChequeNo"]?></td>
                        </tr>
                      </table>
                    </td>
                </tr>
                <tr bgcolor="#EFEFEF">
                    <td class="txtLeft" colspan="6">Other Details</td>
                </tr>
                <tr>
                	<td colspan="6">
                    	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                            <tr>
                                <td class="txtLeft">Investment %</td>
                                <td class="txtLeft">Finance %</td>
                                <td class="txtLeft">Negotiator %</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">&nbsp;</td>
                                            <td class="txtLeft">Bank %</td>
                                            <td class="txtLeft">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft"><?=$row["InvesPercent"]?></td>
                                            <td class="txtLeft"><?=$row["InvesBankPercent"]?></td>
                                            <td class="txtLeft"><?=$row["InvesCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">&nbsp;</td>
                                            <td class="txtLeft">Bank %</td>
                                            <td class="txtLeft">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft"><?=$row["FinancePercent"]?></td>
                                            <td class="txtLeft"><?=$row["FinanceBankPercent"]?></td>
                                            <td class="txtLeft"><?=$row["FinanceCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">&nbsp;</td>
                                            <td class="txtLeft">Bank %</td>
                                            <td class="txtLeft">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft"><?=$row["NegotiatorPercent"]?></td>
                                            <td class="txtLeft"><?=$row["NegotiatorBankPercent"]?></td>
                                            <td class="txtLeft"><?=$row["NegotiatorCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="txtLeft">Investor TDS %</td>
                    <td class="txtLeft"><?=$row["InvestorTDSPercent"]?></td>
                    <td class="txtLeft">Negotiator TDS %</td>
                    <td class="txtLeft" colspan="3"><?=$row["NegotiatorTDSPercent"]?></td>
                </tr>
                 <tr>
                    <td class="txtLeft">Remark</td>
                    <td class="txtLeft" colspan="6"><?=$rowTrans["Remark"]?></td>
                </tr>
               <?
			   }else{ 
			   ?>
               <tr>
                    <td align="center" valign="top">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                            <tr>
                                <td class="loginTxt" width="15%">Tenure</td>
                                <td align="left" width="20%"><?=getDateDBFormat($rowTrans["TenureFrom"])?> - <?=getDateDBFormat($rowTrans["TenureTo"])?></td>
                                <td class="loginTxt" width="15%">Transaction Mode</td>
                                <td align="left" width="15%"><?=$rowTrans["TransactionMode"]?></td>
                                <td class="loginTxt" width="15%">Transaction Amount</td>
                                <td align="left" width="20%"><?=$rowTrans["TransactionAmount"]?></td>
                            </tr>
                            <tr>
                                <td class="loginTxt">Investor Name</td>
                                <td align="left"><?=getInvestorName($rowTrans["InvestorID"])?></td>
                                <td class="loginTxt">Sub Investor</td>
                                <td align="left" colspan="3"><? if($rowTrans["SubInvestorID"]!='0'){  ?><?=getSubInvestorName($rowTrans["SubInvestorID"])?> <? } ?></td>
                            </tr>
                            <tr>
                                <td class="loginTxt">Client</td>
                                <td align="left"><?=getClientName($rowTrans["ClientID"])?></td>
                                <td class="loginTxt">Sub Client</td>
                                <td align="left" colspan="3"><? if($rowTrans["SubClientID"]!='0'){  ?><?=getSubClientName($rowTrans["SubClientID"])?> <? } ?></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                    <tr>
                                         <td class="txtLeft" width="60%" colspan="2">Bank</td>
                                         <td class="txtLeft" width="40%">Cheque No.</td>
                                    </tr>
                                     <tr>
                                        <td class="txtLeft" width="20%">Repayment</td>
                                        <td class="txtLeft" width="40%"><? $clientBankDetails = getClientBankDetails($row["RepaymentBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                                       <td class="txtLeft" width="40%"><?=$row["RepaymentChequeNo"]?></td>
                                    </tr>
                                  </table>
                                </td>
                            </tr>
                            <tr bgcolor="#EFEFEF">
                                <td class="txtLeft" colspan="6">Other Details</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">Investment %</td>
                                            <td class="txtLeft">Finance %</td>
                                            <td class="txtLeft">Negotiator %</td>
                                        </tr>
                                        <tr>
                                            <td align="left"><?=$row["InvesPercent"]?></td>
                                            <td align="left"><?=$row["FinancePercent"]?></td>
                                            <td align="left"><?=$row["NegotiatorPercent"]?></td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft">Remark</td>
                                            <td class="txtLeft" colspan="2"><?=$row["Remark"]?></td>
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
               <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="TransactionID" id="TransactionID" value="<?=$id?>">
                        <input type="hidden" name="txtTransStatus" id="txtTransStatus" value="<?=$transStatus?>" />
                        <input type="submit" value="Yes" name="btnDeleteTranscation" class="button" id="btnDeleteTranscation"  >
                        <input type="button" value="No" onclick="document.getElementById('div_<?=$recid?>').style.visibility='hidden';" name="btnDeleteNo" class="button" id="btnDeleteNo">
                    </td>
                </tr>
            </table>
            </div>
        </td>
    </tr>
</table>
</form>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<?
		}
	}
}
?>
