<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql ="select * from tblTransactionMaster where TransactionID=".$id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$rowuser = mysql_fetch_array($result);
		$lastDueDate = $rowuser["TenureTo"];
		$sqlE = "select * from tblExtendedTransaction where TransactionID='".$id."' order by ExtendedID DESC limit 0,1 ";
		$resultE = mysql_query ($sqlE) or die ("Error in  query : ".$sqlE."<br>".mysql_errno()." : ".mysql_error());
		if(mysql_num_rows($resultE)>0)
		{
			$rowE = mysql_fetch_array($resultE);
			$lastDueDate = $rowE["RenewalDueDate"];
		}
?>
<form id="frmExtendTransaction" name="frmExtendTransaction" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Extend Transaction</div>
        	<div style="float:right;"><input type="button" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
                <tr>
                    <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Client</td>
                </tr>
                 <tr>
                    <td class="loginTxt1" width="12%"><b>Renewal Due Date</b></td>
                     <td align="left" width="25%" colspan="5">
                    <input type="text" name="txtRenewalDueDate" id="txtRenewalDueDate" style="width:150px;" value="<?=getDateNormalFormat($lastDueDate)?>" required />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtendTransaction.txtRenewalDueDate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                </tr>
                <tr>
                    <td class="loginTxt1" width="12%">Re-payment Bank</td>
                    <td align="left" width="25%">
                        <div id="divClientBank">
                            <select name="txtClientBank[]" id="txtClientBank" style="width:130px;" disabled="disabled">
                                    <option value="">--Select Bank--</option>
                            </select>
                        </div>
                    </td>	
                    <td class="loginTxt1" width="12%">Interest Bank</td>
                    <td align="left" width="20%">
                      <div id="divClientBank1">
                      
                            <select name="txtClientBank[]" id="txtClientBank1" style="width:130px;" disabled="disabled" required>
                                    <option value="">--Select Bank--</option>
                            </select>
                        </div>
                    </td>
                    <td class="loginTxt1" width="11%">Commission Bank</td>
                    <td align="left" width="20%">
                        <div id="divClientBank2">
                            <select name="txtClientBank[]" id="txtClientBank2" style="width:130px;" disabled="disabled" required>
                                    <option value="">--Select Bank--</option>
                            </select>
                        </div>
                    </td>	
                </tr>
                <tr>
                    <td class="loginTxt1" width="12%">Cheque No.</td>
                    <td align="left" width="25%"><input name="txtRepaymentChequeNo" id="txtRepaymentChequeNo" style="width:130px;" type="text" autocomplete="off" required /></td>
                    <td class="loginTxt1" width="12%">Cheque No.</td>
                    <td align="left" width="20%">
                        <input name="txtInterestChequeNo" id="txtInterestChequeNo" style="width:130px;" type="text" autocomplete="off" />
                    </td>
                          
                    <td class="loginTxt1" width="11%">Cheque No.</td>
                    <td align="left" width="20%"><input name="txtCommissionChequeNo" id="txtCommissionChequeNo" style="width:130px;" type="text" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Other Details</td>
                </tr>
                <tr>
                     <td class="loginTxt1" width="12%">Investment %</td>
                     <td align="left" width="25%">
                        <input type="text" style="width:25%;" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off"
                        onchange="
document.getElementById('txtFinancePer').value='';
document.getElementById('txtNegotiatorPer').value='';
document.getElementById('txtInvestmentBankPer').value='';
document.getElementById('txtInvestmentCashPer').value='';
                    " required />
                        &nbsp; <input type="text" name="txtInvestmentBankPer" id="txtInvestmentBankPer" autocomplete="off" required placeholder="Bank %" onchange="
document.getElementById('txtInvestmentCashPer').value=Math.round(Math.abs(document.getElementById('txtInvestmentPer').value - this.value) * 100) / 100;
//Math.abs(document.getElementById('txtInvestmentPer').value - this.value);
                    " style="width:25%;"/>
                        &nbsp; <input type="text" name="txtInvestmentCashPer" id="txtInvestmentCashPer" autocomplete="off" readonly="readonly" required placeholder="Cash %" style="width:25%;" /> 
                        
                    </td>
                    <td class="loginTxt1" width="12%">Finance %</td>
                    <td align="left" width="20%"><input type="text" name="txtFinancePer" style="width:25%;" id="txtFinancePer" autocomplete="off" onchange="
var invesPer = document.getElementById('txtInvestmentPer').value; 
document.getElementById('txtNegotiatorPer').value=Math.round(Math.abs(invesPer - this.value) * 100) / 100;
document.getElementById('txtFinanceBankPer').value='';
document.getElementById('txtFinanceCashPer').value='';
                    " required />
                    &nbsp; <input type="text" name="txtFinanceBankPer" id="txtFinanceBankPer" autocomplete="off" required placeholder="Bank %" style="width:25%;" onchange="
document.getElementById('txtFinanceCashPer').value=Math.round(Math.abs(document.getElementById('txtFinancePer').value  - this.value) * 100) / 100;
//Math.abs(document.getElementById('txtFinancePer').value - this.value);
                    "/> 
                    &nbsp; <input type="text" name="txtFinanceCashPer" id="txtFinanceCashPer" autocomplete="off" readonly="readonly" required placeholder="Cash %" style="width:25%;" /> 
                    
                    </td>	
                    <td class="loginTxt1" width="11%">Negotiator %</td>
                    <td align="left" width="20%"><input type="text" style="width:25%;" name="txtNegotiatorPer" id="txtNegotiatorPer" autocomplete="off" readonly="readonly" />
                     &nbsp; <input type="text" name="txtNegotiatorBankPer" id="txtNegotiatorBankPer" autocomplete="off" required placeholder="Bank %" onchange="
var nPer = document.getElementById('txtNegotiatorPer').value;
document.getElementById('txtNegotiatorCashPer').value= Math.round(Math.abs(nPer - this.value) * 100) / 100;
                    " style="width:25%;"/>
                     &nbsp; <input type="text" name="txtNegotiatorCashPer" id="txtNegotiatorCashPer" autocomplete="off" readonly="readonly" required placeholder="Cash %" style="width:25%;" /> 
                    
                    </td>
                </tr>
                <tr>
                     <td class="loginTxt1">Investor TDS %</td>
                     <td align="left">
                        <input type="text" style="width:130px;" name="txtInvestorTDSPer" id="txtInvestorTDSPer" autocomplete="off" />
                        
                    </td>
                    <td class="loginTxt1">Negotiator TDS %</td>
                    <td align="left" colspan="3"><input type="text" style="width:130px;" name="txtNegotiatorTDSPer" id="txtNegotiatorTDSPer" autocomplete="off" />
                    </td>
                </tr>
               <!-- <tr>
                    <td class="loginTxt1" width="35%"><b>Renewal Due Date</b><br />
                    <input type="text" name="txtRenewalDueDate" id="txtRenewalDueDate" style="width:150px;" value="<//?=getDateNormalFormat($lastDueDate)?>" required />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtendTransaction.txtRenewalDueDate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                    <td class="loginTxt1" width="35%"><b>Investment Percent</b><br />
                    <input type="text" name="txtInvestmentPerN" style="width:160px;" id="txtInvestmentPerN" autocomplete="off" required /></td>
                    <td class="loginTxt1" width="30%"><b>Finance Percent</b><br />
                    <input type="text" name="txtFinancePerN" style="width:160px;" id="txtFinancePerN" autocomplete="off" required /></td>
                </tr>-->
                <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="txtTransactionID" id="txtTransactionID" value="<?=$id?>">
                        <input type="hidden" name="txtFromDate" id="txtFromDate" value="<?=$lastDueDate?>">
                        <input type="submit" value="Submit" name="btnExtendTrans" class="button" id="btnExtendTrans">
                        <input type="button" value="Cancel" name="btnCancel" class="button" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" id="btnCancel">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? } } ?>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>