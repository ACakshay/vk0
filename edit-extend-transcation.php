<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$tDetails = getExtendedTransRecID($id);
	$sqlTrans ="select * from tblTransactionMaster where TransactionID=".$tDetails["TransactionID"];
	$resultTrans = mysql_query ($sqlTrans) or die ("Error in  query : ".$sqlTrans."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultTrans)>0)
	{
		$rowTrans= mysql_fetch_array($resultTrans);
		
		$investorId = $rowTrans["InvestorID"];
		$investorType = 'Head';
		if($rowTrans["SubInvestorID"]!=0)
		{
			$investorId = $rowTrans["SubInvestorID"];
			$investorType = 'SubInvestor';
		}
		$clientId = $rowTrans["ClientID"];
		$clientType = 'Head';
		if($rowTrans["SubClientID"]!=0)
		{
			$clientId = $rowTrans["SubClientID"];
			$clientType = 'SubClient';
		}
		$sql="select * from tblExtendedTransaction where RecID='".$id."' ";
		$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
		if(mysql_num_rows($result)>0)
		{
			$row = mysql_fetch_array($result);
?>
<form id="frmEEditTranscation" name="frmEEditTranscation" method="post" onsubmit="return validateFormValue(this.name);">
	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
        <tr>
            <td valign="top" class="heading"> 
                <div style="float:left;">Edit Extended Transcation</div>
                <div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
            </td>
        </tr>
         <tr><td class="message" align="center"><div id="alertMsgP"></div></td></tr>
        <tr>
    		<td align="center" style="padding:7px;">
            	<div style="overflow-y:scroll; height:350px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                        <tr>
                            <td class="Txt11" width="35%">Tenure <input type="text" name="txtTenureFromE" id="txtTenureFromE" autocomplete="off" style="width:100px;" required value="<?=getDateDBFormat($row["TenureFrom"])?>" />
                        &nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmEEditTranscation.txtTenureFromE); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To &nbsp;&nbsp;
                        <input type="text" autocomplete="off" name="txtTenureToE" id="txtTenureToE" style="width:100px;" required value="<?=getDateDBFormat($row["TenureTo"])?>"/>
                        &nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmEEditTranscation.txtTenureToE); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp; </td>
                        </tr>
                  </table>
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR" id="TransMode">
                    <?
                    if($rowTrans["TransactionMode"]=='Bank')
                    {
                    ?>
                    <tr>
                        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Client</td>
                   </tr>
                       <tr id="ClientBank">
                            <td class="loginTxt1" width="100%" colspan="6">
                                <div id="EditClientBank">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr id="EditClientBankDetails">
                                            <td class="loginTxt1" width="12%">Re-payment Bank</td>
                                            <td align="left" width="25%">
                                                <div id="divClientBank">
                                                    <select name="txtRepaymentBankE" id="txtRepaymentBankE" style="width:170px;">
                                                           <?
                                                                $sqlBank ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
                                                                $resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
                                                                if(mysql_num_rows($resultBank)>0)
                                                                {
                                                                    while($rowBank = mysql_fetch_array($resultBank))
                                                                    {
                                                            ?>
                                                            <option value="<?=$rowBank["RecID"]?>" <? if($row["RepaymentBankID"]==$rowBank["RecID"]){ ?> selected="selected" <? } ?>><?=getBankName($rowBank["BankID"])?></option>
                                                            <?
                                                                    }
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </td>	
                                            <td class="loginTxt1" width="12%">Interest Bank</td>
                                            <td align="left" width="20%">
                                              <div id="divClientBank1">
                                                 <select name="txtInterestBankE" id="txtInterestBankE" style="width:170px;">
                                                       <?
                                                            $sqlBank1 ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
                                                            $resultBank1 = mysql_query ($sqlBank1) or die ("Error in  query : ".$sqlBank1."<br>".mysql_errno()." : ".mysql_error());
                                                            if(mysql_num_rows($resultBank1)>0)
                                                            {
                                                                while($rowBank1 = mysql_fetch_array($resultBank1))
                                                                {
                                                        ?>
                                                                <option value="<?=$rowBank1["RecID"]?>" <? if($row["InterestBankID"]==$rowBank1["RecID"]){ ?> selected="selected" <? } ?>><?=getBankName($rowBank1["BankID"])?></option>
                                                        <?
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="loginTxt1" width="11%">Commission Bank</td>
                                            <td align="left" width="20%">
                                                <div id="divClientBank2">
                                                    <select name="txtCommissionBankE" id="txtCommissionBankE" style="width:170px;">
                                                       <?
                                                            $sqlBank2 ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
                                                            $resultBank2 = mysql_query ($sqlBank2) or die ("Error in  query : ".$sqlBank2."<br>".mysql_errno()." : ".mysql_error());
                                                            if(mysql_num_rows($resultBank2)>0)
                                                            {
                                                                while($rowBank2 = mysql_fetch_array($resultBank2))
                                                                {
                                                        ?>
                                                                <option value="<?=$rowBank2["RecID"]?>" <? if($row["CommissionBankID"]==$rowBank2["RecID"]){ ?> selected="selected" <? } ?>><?=getBankName($rowBank2["BankID"])?></option>
                                                        <?
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>	
                                        </tr>
                                         </table>
                                   </div>
                             </td>
                        </tr>
                        <tr>
                            <td class="loginTxt1" width="12%">Cheque No.</td>
                            <td align="left" width="25%"><input name="txtRepaymentChequeNoE" id="txtRepaymentChequeNoE" style="width:170px;" value="<?=$row["RepaymentChequeNo"]?>" type="text" autocomplete="off" required /></td>
                            <td class="loginTxt1" width="12%">Cheque No.</td>
                            <td align="left" width="20%">
                                <input name="txtInterestChequeNoE" id="txtInterestChequeNoE" style="width:170px;" type="text" value="<?=$row["InterestChequeNo"]?>" autocomplete="off" />
                            </td>
                                  
                            <td class="loginTxt1" width="11%">Cheque No.</td>
                            <td align="left" width="20%"><input name="txtCommissionChequeNoE" id="txtCommissionChequeNoE" style="width:170px;" value="<?=$row["CommissionChequeNo"]?>" type="text" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Other Details</td>
                        </tr>
                        <tr>
                             <td class="loginTxt1" width="12%">Investment %</td>
                             <td align="left" width="25%">
                                <input type="text" style="width:25%;" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off" required value="<?=$row["InvesPercent"]?>" onchange="			
                              	var diff = parseFloat(document.forms['frmEEditTranscation']['txtNegotiatorPer'].value) + parseFloat(this.value);
                                document.forms['frmEEditTranscation']['txtFinancePer'].value= parseFloat(diff).toFixed(2); " />
                                &nbsp; <input type="text" name="txtInvestmentBankPer" id="txtInvestmentBankPer" autocomplete="off" required value="<?=$row["InvesBankPercent"]?>" placeholder="Bank %" style="width:25%;" onchange="
                              
                                var iSum = parseFloat(document.forms['frmEEditTranscation']['txtNegotiatorBankPer'].value) +  parseFloat(this.value);
                                document.forms['frmEEditTranscation']['txtFinanceBankPer'].value=parseFloat(iSum).toFixed(2);" />
                                &nbsp;<input type="text" name="txtInvestmentCashPer" id="txtInvestmentCashPer" autocomplete="off"  required value="<?=$row["InvesCashPercent"]?>" placeholder="Cash %" style="width:25%;" onchange="
                                var cSum = parseFloat(document.forms['frmEEditTranscation']['txtNegotiatorCashPer'].value) + parseFloat(this.value);
                                document.forms['frmEEditTranscation']['txtFinanceCashPer'].value=parseFloat(cSum).toFixed(2);" /> 
                                
                            </td>
                            <td class="loginTxt1" width="12%">Negotiator %</td>
                            <td align="left" width="20%"><input type="text" style="width:25%;" name="txtNegotiatorPer" id="txtNegotiatorPer" required value="<?=$row["NegotiatorPercent"]?>" autocomplete="off"  onchange="
                            var nSum = parseFloat(document.forms['frmEEditTranscation']['txtInvestmentPer'].value) + parseFloat(this.value);
                             document.forms['frmEEditTranscation']['txtFinancePer'].value= parseFloat(nSum).toFixed(2);" />
                             &nbsp; <input type="text" name="txtNegotiatorBankPer" id="txtNegotiatorBankPer" autocomplete="off" required value="<?=$row["NegotiatorBankPercent"]?>" placeholder="Bank %" style="width:25%;" onchange="
                             var nbSum = parseFloat(document.forms['frmEEditTranscation']['txtInvestmentBankPer'].value) + parseFloat(this.value);
                             document.forms['frmEEditTranscation']['txtFinanceBankPer'].value= parseFloat(nbSum).toFixed(2);" />
                             &nbsp; <input type="text" name="txtNegotiatorCashPer" id="txtNegotiatorCashPer" autocomplete="off"  required value="<?=$row["NegotiatorCashPercent"]?>" placeholder="Cash %" style="width:25%;" onchange="
                            var ncSum = parseFloat(document.forms['frmEEditTranscation']['txtInvestmentCashPer'].value) + parseFloat(this.value);
                            document.forms['frmEEditTranscation']['txtFinanceCashPer'].value=parseFloat(ncSum).toFixed(2); " /> 
                            
                            </td>
                            <td class="loginTxt1" width="11%">Finance %</td>
                            <td align="left" width="20%"><input type="text" name="txtFinancePer" style="width:25%;" id="txtFinancePer" value="<?=$row["FinancePercent"]?>" autocomplete="off" readonly="readonly" required />
                            &nbsp; <input type="text" name="txtFinanceBankPer" id="txtFinanceBankPer" autocomplete="off" readonly="readonly" required value="<?=$row["FinanceBankPercent"]?>" placeholder="Bank %" style="width:25%" /> 
                            &nbsp; <input type="text" name="txtFinanceCashPer" id="txtFinanceCashPer" autocomplete="off" readonly="readonly" required value="<?=$row["FinanceCashPercent"]?>" placeholder="Cash %" style="width:25%;" /> 
                           </td>	
                        </tr>
                        <tr>
                         <td class="loginTxt1">Investor TDS %</td>
                         <td align="left"> 
                            <input type="text" style="width:170px;" name="txtInvestorTDSPer" id="txtInvestorTDSPer" value="<?=$row["InvestorTDSPercent"]?>" autocomplete="off" />
                            
                        </td>
                        <td class="loginTxt1">Negotiator TDS %</td>
                        <td align="left" colspan="3"><input type="text" style="width:170px;" name="txtNegotiatorTDSPer" id="txtNegotiatorTDSPer" value="<?=$row["NegotiatorTDSPercent"]?>" autocomplete="off" />
                        </td>
                    </tr>
                    <?
						}else{
					?>
                   <tr>
                        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Client</td>
                    </tr>
                     <tr>
                        <td class="loginTxt1" width="100%" colspan="6">
                            <div id="EditClient">
                                <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                    <tr>
                                     <td class="loginTxt1" width="15%">Re-payment Bank</td>
                                     <td align="left" width="35%">
                                         <div id="EditClientBank">
                                                <select name="txtRepaymentBankE" id="txtRepaymentBankE" style="width:170px;">
                                                    <?
                                                        $sqlBank ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
                                                        $resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
                                                        if(mysql_num_rows($resultBank)>0)
                                                        {
                                                            while($rowBank = mysql_fetch_array($resultBank))
                                                            {
                                                    ?>
                                                            <option value="<?=$rowBank["RecID"]?>" <? if($row["RepaymentBankID"]==$rowBank["RecID"]){ ?> selected="selected" <? } ?>><?=getBankName($rowBank["BankID"])?></option>
                                                    <?
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                         </div>
                                    </td>
                                   <td class="loginTxt1" width="15%">Re-payment Cheque No.</td>
                                     <td align="left" width="35%">
                                       <input name="txtRepaymentChequeNoE" id="txtRepaymentChequeNoE" value="<?=$row["RepaymentChequeNo"]?>" style="width:170px;" type="text" autocomplete="off" required />
                                     </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    </tr>
                    <tr>
                        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Other Details</td>
                    </tr>
                    <tr>
                        <td class="loginTxt1" width="15%">Investment %</td>
                        <td align="left" width="35%">
                            <input type="text" style="width:170px;" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off"
                           onchange="
            var diff = parseFloat(document.forms['frmEEditTranscation']['txtNegotiatorPer'].value) + parseFloat(this.value);
            document.forms['frmEEditTranscation']['txtFinancePer'].value= parseFloat(diff).toFixed(2);
           " value="<?=$row["InvesPercent"]?>" required />
                        </td>	
                        <td class="loginTxt1" width="15%">Negotiator %</td>
                        <td align="left" width="35%">
                            <input type="text" style="width:170px;" value="<?=$row["NegotiatorPercent"]?>" readonly="readonly" name="txtNegotiatorPer" id="txtNegotiatorPer" autocomplete="off" onchange="
            		var nSum = parseFloat(document.forms['frmEEditTranscation']['txtInvestmentPer'].value) + parseFloat(this.value);
                    document.forms['frmEEditTranscation']['txtFinancePer'].value= parseFloat(nSum).toFixed(2);
                             " required />
                        </td>
                    </tr>
                    <tr>
                    	<td class="loginTxt1">Finance %</td>
                         <td align="left" colspan="3"><input type="text" name="txtFinancePer" style="width:170px;" readonly="readonly" id="txtFinancePer" value="<?=$row["FinancePercent"]?>" autocomplete="off" required /></td>
                    </tr>
                <?
					}
				?>
               <tr bgcolor="#f2f2f2">
                <td align="center" colspan="6" height="40px">
                    <input type="hidden" name="txtRecID" id="txtRecID" value="<?=$id?>" >
                    <input type="hidden" name="txtTransactionMode" id="txtTransactionMode" value="<?=$rowTrans["TransactionMode"]?>" />
                    <input name="btnEditExtendTranscation" type="submit" class="button" id="btnEditExtendTranscation" value="Submit"/> &nbsp;&nbsp;&nbsp;
                    <input name="btnCancel" type="button" class="button" id="btnCancel" onClick="document.getElementById('div_<?=$id?>').style.visibility = 'hidden'" value="Cancel" />
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
