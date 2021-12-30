<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$transactionID=$_GET["id"];
	$transStatus=$_GET["id2"];
	if($transStatus!=0)
	{
		$divId = $transStatus;
		$extTransDetails = getExtendedTransRecID($transStatus);
		$transactionID = $extTransDetails["TransactionID"];
		$where =" and RecID='".$transStatus."' "; $tbl = "tblExtendedTransaction";
		
	}else{ $where =" and TransactionID='".$transactionID."' "; $divId= $transactionID;  $tbl = "tblBankTransactionDetails"; }
	$sqlTrans ="select * from tblTransactionMaster where TransactionID=".$transactionID;
	$resultTrans = mysql_query ($sqlTrans) or die ("Error in  query : ".$sqlTrans."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultTrans)>0)
	{
		$rowTrans = mysql_fetch_array($resultTrans);
		$clientId = $rowTrans["ClientID"];
		$clientType = 'Head';
		if($rowTrans["SubClientID"]!='0')
		{
			$clientId = $rowTrans["SubClientID"];
			$clientType = 'SubClient';
		}
		$sqlTransD = "select * from ".$tbl." where 1 ".$where." ";
		$resultTransD = mysql_query ($sqlTransD) or die ("Error in  query : ".$sqlTransD."<br>".mysql_errno()." : ".mysql_error());
		if(mysql_num_rows($resultTransD)>0)
		{
			$rowTransD = mysql_fetch_array($resultTransD);
			if($transStatus==0)
			{
				$frmDate = $rowTrans["TenureFrom"];
				$toDate = $rowTrans["TenureTo"];
			}else{ $frmDate = $rowTransD["TenureFrom"]; $toDate = $rowTransD["TenureTo"]; } 
?>
<form id="frmExtendBTransaction" name="frmExtendBTransaction" method="post" onsubmit="return validateFormValue(this.name);">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Extend Transaction</div>
        	<div style="float:right;"><input type="button" onClick="document.getElementById('div_<?=$divId?>').style.visibility='hidden';" class="btnClose" /></div>
        </td>
    </tr>
    <tr><td class="message" align="center"><div id="alertMsgP"></div></td></tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<div style="overflow-y:scroll; height:300px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
                 <tr>
                    <td class="loginTxt1" width="35%"><b>Renewal Tenure From</b><br />
                    <input type="text" name="txtRenewalTenureFrm" id="txtRenewalTenureFrm" readonly="readonly" style="width:150px;" value="<?=getDateDBFormat($toDate)?>" />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtendBTransaction.txtRenewalTenureFrm); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                     <td class="loginTxt1" width="35%" colspan="2"><b>Renewal Tenure To</b><br />
                    <input type="text" name="txtRenewalTenureTo" id="txtRenewalTenureTo" style="width:150px;" value="<?//=getDateDBFormat($toDate)?>" />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtendBTransaction.txtRenewalTenureTo); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                </tr>
                <tr>
                    <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="3">Client</td>
                </tr>
                <tr>
                    <td class="loginTxt1" width="35%">Re-payment Bank<br />
                        <select name="txtClientReBank" id="txtClientReBank" style="width:90%;" required>
                                    <?
										$sqlReBank ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
										$resultReBank = mysql_query ($sqlReBank) or die ("Error in  query : ".$sqlReBank."<br>".mysql_errno()." : ".mysql_error());
										if(mysql_num_rows($resultReBank)>0)
										{
											while($rowReBank = mysql_fetch_array($resultReBank))
											{
									?>
											<option value="<?=$rowReBank["RecID"]?>" <? if($rowTransD["RepaymentBankID"]==$rowReBank["RecID"]) { ?> selected="selected" <? } ?>><?=getBankName($rowReBank["BankID"])?></option>
									<?
											}
										}
									?>
                            </select>
                    </td>	
                    <td class="loginTxt1" width="35%">Interest Bank<br />
                      <select name="txtClientInBank" id="txtClientInBank" style="width:90%;" required>
                                   <?
										$sqlInBank ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
										$resultInBank = mysql_query ($sqlInBank) or die ("Error in  query : ".$sqlInBank."<br>".mysql_errno()." : ".mysql_error());
										if(mysql_num_rows($resultInBank)>0)
										{
											while($rowInBank = mysql_fetch_array($resultInBank))
											{
									?>
											<option value="<?=$rowInBank["RecID"]?>" <? if($rowTransD["InterestBankID"]==$rowInBank["RecID"]) { ?> selected="selected" <? } ?>><?=getBankName($rowInBank["BankID"])?></option>
									<?
											}
										}
									?>
                            </select>
                   </td>
                    <td class="loginTxt1" width="30%">Commission Bank<br />
                        <select name="txtClientComBank" id="txtClientComBank" style="width:90%;" required>
							  <?
                                    $sqlComBank ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
                                    $resultComBank = mysql_query ($sqlComBank) or die ("Error in  query : ".$sqlComBank."<br>".mysql_errno()." : ".mysql_error());
                                    if(mysql_num_rows($resultComBank)>0)
                                    {
                                        while($rowComBank = mysql_fetch_array($resultComBank))
                                        {
                                ?>
                                        <option value="<?=$rowComBank["RecID"]?>" <? if($rowTransD["CommissionBankID"]==$rowComBank["RecID"]) { ?> selected="selected" <? } ?>><?=getBankName($rowComBank["BankID"])?></option>
                                <?
                                        }
                                    }
                                ?>
                            </select>
                   </td>	
                </tr>
                <tr>
                    <td class="loginTxt1">Cheque No.<br />
                    	<input name="txtRepaymentChequeNoE" id="txtRepaymentChequeNoE" style="width:90%;" value="<?=$rowTransD["RepaymentChequeNo"]?>" type="text" autocomplete="off" required />
                    </td>
                    <td class="loginTxt1">Cheque No.<br />
                        <input name="txtInterestChequeNoE" id="txtInterestChequeNoE" style="width:90%;" value="<?=$rowTransD["InterestChequeNo"]?>" type="text" autocomplete="off" required />
                    </td>
                          
                    <td class="loginTxt1">Cheque No.<br />
                    	<input name="txtCommissionChequeNoE" id="txtCommissionChequeNoE" style="width:90%;" value="<?=$rowTransD["CommissionChequeNo"]?>" type="text" autocomplete="off" required />
                    </td>
                </tr>
                <tr>
                    <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="3">Other Details</td>
                </tr>
                <tr>
                     <td class="loginTxt1">Investment %<br />
                        <input type="text" style="width:25%;" name="txtInvestmentPer" id="txtInvestmentPer" value="<?=$rowTransD["InvesPercent"]?>" autocomplete="off" onchange="			
                              	var diff = parseFloat(document.forms['frmExtendBTransaction']['txtNegotiatorPer'].value) + parseFloat(this.value);
                                document.forms['frmExtendBTransaction']['txtFinancePer'].value= parseFloat(diff).toFixed(2); "
                                required />
                        &nbsp; <input type="text" name="txtInvestmentBankPer" id="txtInvestmentBankPer" value="<?=$rowTransD["InvesBankPercent"]?>" autocomplete="off" onchange="
                              
                                var iSum = parseFloat(document.forms['frmExtendBTransaction']['txtNegotiatorBankPer'].value) +  parseFloat(this.value);
                                document.forms['frmExtendBTransaction']['txtFinanceBankPer'].value=parseFloat(iSum).toFixed(2);" required placeholder="Bank %" style="width:25%;"/>
                        &nbsp; <input type="text" name="txtInvestmentCashPer" id="txtInvestmentCashPer" value="<?=$rowTransD["InvesCashPercent"]?>" autocomplete="off"
                        onchange="
                                var cSum = parseFloat(document.forms['frmExtendBTransaction']['txtNegotiatorCashPer'].value) + parseFloat(this.value);
                                document.forms['frmExtendBTransaction']['txtFinanceCashPer'].value=parseFloat(cSum).toFixed(2);"
                         required placeholder="Cash %" style="width:25%;" /> 
                        
                    </td>
                    <td class="loginTxt1">Negotiator %<br />
                    		<input type="text" style="width:25%;" name="txtNegotiatorPer" id="txtNegotiatorPer" value="<?=$rowTransD["NegotiatorPercent"]?>" autocomplete="off" onchange="
                            var nSum = parseFloat(document.forms['frmExtendBTransaction']['txtInvestmentPer'].value) + parseFloat(this.value);
                             document.forms['frmExtendBTransaction']['txtFinancePer'].value= parseFloat(nSum).toFixed(2);"
                              required/>
                     &nbsp; <input type="text" name="txtNegotiatorBankPer" id="txtNegotiatorBankPer" value="<?=$rowTransD["NegotiatorBankPercent"]?>" autocomplete="off" required onchange="
                             var nbSum = parseFloat(document.forms['frmExtendBTransaction']['txtInvestmentBankPer'].value) + parseFloat(this.value);
                             document.forms['frmExtendBTransaction']['txtFinanceBankPer'].value= parseFloat(nbSum).toFixed(2);"
                              placeholder="Bank %" style="width:25%;"/>
                     &nbsp; <input type="text" name="txtNegotiatorCashPer" id="txtNegotiatorCashPer" value="<?=$rowTransD["NegotiatorCashPercent"]?>" autocomplete="off" onchange="
                            var ncSum = parseFloat(document.forms['frmExtendBTransaction']['txtInvestmentCashPer'].value) + parseFloat(this.value);
                            document.forms['frmExtendBTransaction']['txtFinanceCashPer'].value=parseFloat(ncSum).toFixed(2); " required placeholder="Cash %" style="width:25%;" /> 
                    </td>
                    <td class="loginTxt1">Finance %<br />
                    	<input type="text" name="txtFinancePer" style="width:25%;" id="txtFinancePer" value="<?=$rowTransD["FinancePercent"]?>" readonly="readonly" autocomplete="off" required />
                    &nbsp; <input type="text" name="txtFinanceBankPer" id="txtFinanceBankPer" value="<?=$rowTransD["FinanceBankPercent"]?>" readonly="readonly" autocomplete="off" required placeholder="Bank %" style="width:25%;" /> 
                    &nbsp; <input type="text" name="txtFinanceCashPer" id="txtFinanceCashPer" value="<?=$rowTransD["FinanceCashPercent"]?>" readonly="readonly" autocomplete="off" required placeholder="Cash %" style="width:25%;" /> 
                    
                    </td>	
                    
                </tr>
                <tr>
                     <td class="loginTxt1">Investor TDS %<br />
                        <input type="text" style="width:90%;" name="txtInvestorTDSPer" id="txtInvestorTDSPer" value="<?=$rowTransD["InvestorTDSPercent"]?>" autocomplete="off" />
                    </td>
                    <td class="loginTxt1" colspan="2">Negotiator TDS %<br />
                    	<input type="text" style="width:90%;" name="txtNegotiatorTDSPer" id="txtNegotiatorTDSPer" value="<?=$rowTransD["NegotiatorTDSPercent"]?>" autocomplete="off" />
                    </td>
                </tr>
               <tr>
                    <td align="center" style="padding:5px;" colspan="3">
                        <input type="hidden" name="txtTransactionID" id="txtTransactionID" value="<?=$transactionID?>">
                        <input type="hidden" name="txtTransStatus" id="txtTransStatus" value="<?=$transStatus?>">
                        <input type="hidden" name="txtTransactionMode" id="txtTransactionMode" value="<?=$rowTrans["TransactionMode"]?>">
                        <input type="submit" value="Submit" name="btnExtendTrans" class="button" id="btnExtendTrans">
                        <input type="button" value="Cancel" name="btnCancel" class="button" onClick="document.getElementById('div_<?=$divId?>').style.visibility='hidden';" id="btnCancel">
                    </td>
                </tr>
            </table>
            </div>
        </td>
    </tr>
</table>
</form>
<? } } } ?>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>