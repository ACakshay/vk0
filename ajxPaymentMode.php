<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$chq_chk = $_GET["id"];
	if($chq_chk=='Cash'){
?>
	<tr>
        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Negotiator</td>
    </tr>
    <tr>
        <td width="10%" class="loginTxt1">Name</td>
        <td width="90%"colspan="5">
        <select name="txtNegotiator" id="txtNegotiator" required style="width:130px;"> 
                 <option value="">Select</option>
                 <?
                   $sqlN="select * from tblNegotiatorMaster order by NegotiatorName";
                   $resultN = mysql_query ($sqlN) or die ("Error in  query : ".$sqlN."<br>".mysql_errno()." : ".mysql_error());
                    if(mysql_num_rows($resultN)>0)
                    {
                        while($rowN = mysql_fetch_array($resultN))
                        {
            ?>
                        <option value="<?=$rowN["NegotiatorID"]?>" ><?=$rowN["NegotiatorName"]?></option>
                 <? } } ?>
              </select>
        </td>
    </tr>
	<tr>
        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Investor</td>
    </tr>
    <tr>
        <td width="15%" class="loginTxt1">Name</td>
        <td width="35%">
        <select name="txtInvestor" id="txtInvestor" required style="width:130px;" onchange="get_frm('ajxGetSubInvestorCash.php',this.value,'getSubInvestor');"> 
                 <option value="">Select</option>
                 <?
                    $sqlInves ="select * from tblInvestorMaster order by InvestorName";
                    $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                    if(mysql_num_rows($resultInves)>0)
                    {
                        while($rowInves = mysql_fetch_array($resultInves))
                        {
            ?>
                        <option value="<?=$rowInves["InvestorID"]?>" ><?=$rowInves["InvestorName"]?></option>
                 <? } } ?>
          </select>
        </td>
        <td width="15%" class="loginTxt1">Sub Investor</td>
        <td width="35%" id="getSubInvestor">
        <select name="txtSubInvestor" id="txtSubInvestor" style="width:130px;" disabled="disabled"> 
                 <option value="">Select</option>
                 </select>
        </td>
    </tr>
   <tr>
        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Client</td>
    </tr>
     <tr>
        <td width="15%" class="loginTxt1">Name</td>
        <td width="35%" colspan="3">
        <select name="txtClient" id="txtClient" style="width:130px;" required  onchange="get_frm('ajxGetClientDetailsCash.php',this.value,'clientDetails');"> 									
        	<option value="">Select</option>
                <?
                 $sqlInves ="select * from tblClientMaster order by ClientName";
                $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                if(mysql_num_rows($resultInves)>0)
                {
                    while($rowInves = mysql_fetch_array($resultInves))
                    {
                ?>
                    <option value="<?=$rowInves["ClientID"]?>" ><?=$rowInves["ClientName"]?></option>
                <? 
                    }
                }
                ?>
        </select>
        </td>
    </tr>
    <tr>
        <td class="loginTxt1" width="100%" colspan="6">
            <div id="clientDetails">
                <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
    				<tr>
    	 <td width="15%" class="loginTxt1">Sub Client</td>
        <td width="35%" colspan="3">
        <select name="txtSubClient" id="txtSubClient" style="width:130px;" disabled="disabled">
                <option value="">Select</option>
        </select>
        </td>
    </tr>
    				<tr>
                     <td class="loginTxt1" width="15%">Re-payment Bank</td>
                     <td align="left" width="35%">
                         <div id="divClientBank">
                                <select name="txtClientBank" id="txtClientBank" style="width:130px;" disabled="disabled">
                                        <option value="">Select Bank</option>
                                </select>
                         </div>
                    </td>
                   <td class="loginTxt1" width="15%">Re-payment Cheque No.</td>
                     <td align="left" width="35%">
                       <input name="txtRepaymentChequeNo" id="txtRepaymentChequeNo" style="width:130px;" type="text" autocomplete="off" required />
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
        <td class="loginTxt1">Investment %</td>
        <td align="left">
            <input type="text" style="width:130px;" value="0" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off"
           onchange="
            var diff = parseFloat(document.getElementById('txtNegotiatorPer').value) + parseFloat(this.value);
            document.getElementById('txtFinancePer').value= parseFloat(diff).toFixed(2);
           " required />
        </td>	
        <td class="loginTxt1">Negotiator %</td>
        <td align="left">
        	<input type="text" style="width:130px;" value="0"
            onchange="
            		var nSum = parseFloat(document.getElementById('txtInvestmentPer').value) + parseFloat(this.value);
                    document.getElementById('txtFinancePer').value= parseFloat(nSum).toFixed(2);
                             "
             name="txtNegotiatorPer" id="txtNegotiatorPer" autocomplete="off" required />
        </td>
    </tr>
    <tr>
         <td class="loginTxt1" width="15%">Finance %</td>
         <td align="left" width="85%" colspan="3">
         <input type="text" name="txtFinancePer" style="width:130px;" id="txtFinancePer" value="0" autocomplete="off" readonly="readonly" required />
         </td>
    </tr>
<?
	}else {
?>
	<tr>
        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Negotiator</td>
    </tr>
    <tr>
        <td width="10%" class="loginTxt1">Name</td>
        <td width="90%"colspan="5">
        <select name="txtNegotiator" id="txtNegotiator" required style="width:130px;"> 
                 <option value="">Select</option>
                 <?
                   $sqlN="select * from tblNegotiatorMaster order by NegotiatorName";
                   $resultN = mysql_query ($sqlN) or die ("Error in  query : ".$sqlN."<br>".mysql_errno()." : ".mysql_error());
                    if(mysql_num_rows($resultN)>0)
                    {
                        while($rowN = mysql_fetch_array($resultN))
                        {
            ?>
                        <option value="<?=$rowN["NegotiatorID"]?>" ><?=$rowN["NegotiatorName"]?></option>
                 <? } } ?>
              </select>
        </td>
    </tr>
	<tr>
        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Investor</td>
    </tr>
    <tr>
        <td width="10%" class="loginTxt1">Name</td>
        <td width="90%"colspan="5">
        <select name="txtInvestor" id="txtInvestor" required style="width:130px;" onchange="get_frm('ajxGetSubInvestor.php',this.value,'investorInfo');"> 
                 <option value="">Select</option>
                 <?
                    $sqlInves ="select * from tblInvestorMaster order by InvestorName";
                    $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                    if(mysql_num_rows($resultInves)>0)
                    {
                        while($rowInves = mysql_fetch_array($resultInves))
                        {
            ?>
                        <option value="<?=$rowInves["InvestorID"]?>" ><?=$rowInves["InvestorName"]?></option>
                 <? } } ?>
              </select>
        </td>
    </tr>
    <tr id="investorInfo">
       <td class="loginTxt1" width="12%">Sub Investor</td>
        <td align="left" width="25%">
            <select name="txtSubInvestor" id="txtSubInvestor" style="width:130px;" disabled="disabled"> 
                 <option value="">Select</option>
                 </select>
        </td>	
        <td class="loginTxt1" width="12%">Bank</td>
        <td align="left" width="20%">
             <select name="txtInvestorBank" id="txtInvestorBank" style="width:130px;" disabled="disabled">
                <option value="">Select</option>
             </select>
        </td>
        <td class="loginTxt1" width="11%">Cheque/UTR No.</td>
        <td align="left" width="20%">
            <input type="text" style="width:130px;" name="txtInvestorChequeUTR" id="txtInvestorChequeUTR" disabled="disabled" />
        </td>	
   </tr>
    <tr>
        <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Client</td>
    </tr>
     <tr>
        <td width="10%" class="loginTxt1">Name</td>
        <td colspan="5" width="90%">
        <select name="txtClient" id="txtClient" style="width:130px;" onchange="get_frm('ajxGetClientDetails.php',this.value,'clientDetails');" required > 															<option value="">Select</option>
                <?
                 $sqlInves ="select * from tblClientMaster order by ClientName";
                $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                if(mysql_num_rows($resultInves)>0)
                {
                    while($rowInves = mysql_fetch_array($resultInves))
                    {
                ?>
                    <option value="<?=$rowInves["ClientID"]?>" ><?=$rowInves["ClientName"]?></option>
                <? 
                    }
                }
                ?>
        </select>
        </td>
    </tr>
     <tr id="clientBank">
        <td class="loginTxt1" width="100%" colspan="6">
            <div id="clientDetails">
                <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    <tr>
                        <td class="loginTxt1" width="12%">Sub Client</td>
                        <td align="left" width="88%" colspan="5">
                            <select name="txtSubClient" id="txtSubClient" style="width:130px;" disabled="disabled">
                                <option value="">Select Sub Clients</option>
                        </select>
                        </td>
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
               </table>
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
            <input type="text" style="width:25%;" value="0" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off" required  onchange="			
            var diff = parseFloat(document.getElementById('txtNegotiatorPer').value) + parseFloat(this.value);
            document.getElementById('txtFinancePer').value= parseFloat(diff).toFixed(2); " />
            &nbsp; <input type="text" value="0" name="txtInvestmentBankPer" id="txtInvestmentBankPer" autocomplete="off" required placeholder="Bank %" style="width:25%;" onchange="
            var iSum = parseFloat(document.getElementById('txtNegotiatorBankPer').value) +  parseFloat(this.value);
            document.getElementById('txtFinanceBankPer').value=parseFloat(iSum).toFixed(2);"/>
            &nbsp;<input type="text" value="0" name="txtInvestmentCashPer" id="txtInvestmentCashPer" autocomplete="off"  required placeholder="Cash %" style="width:25%;" onchange="
            var cSum = parseFloat(document.getElementById('txtNegotiatorCashPer').value) + parseFloat(this.value);
            document.getElementById('txtFinanceCashPer').value=parseFloat(cSum).toFixed(2);" /> 
            
        </td>
        <td class="loginTxt1" width="12%">Negotiator %</td>
        <td align="left" width="20%"><input type="text" value="0" style="width:25%;" name="txtNegotiatorPer" id="txtNegotiatorPer" autocomplete="off"  onchange="
        var nSum = parseFloat(document.getElementById('txtInvestmentPer').value) + parseFloat(this.value);
         document.getElementById('txtFinancePer').value= parseFloat(nSum).toFixed(2);" />
         &nbsp; <input type="text" name="txtNegotiatorBankPer" value="0" id="txtNegotiatorBankPer" autocomplete="off" required placeholder="Bank %" style="width:25%;" onchange="
         var nbSum = parseFloat(document.getElementById('txtInvestmentBankPer').value) + parseFloat(this.value);
         document.getElementById('txtFinanceBankPer').value= parseFloat(nbSum).toFixed(2);"/>
         &nbsp; <input type="text" value="0" name="txtNegotiatorCashPer" id="txtNegotiatorCashPer" autocomplete="off"  required placeholder="Cash %" style="width:25%;" onchange="
        var ncSum = parseFloat(document.getElementById('txtInvestmentCashPer').value) + parseFloat(this.value);
        document.getElementById('txtFinanceCashPer').value=parseFloat(ncSum).toFixed(2); " /> 
        
        </td>
        <td class="loginTxt1" width="11%">Finance %</td>
        <td align="left" width="20%"><input type="text" name="txtFinancePer" value="0" style="width:25%;" id="txtFinancePer" readonly="readonly" autocomplete="off" required />
        &nbsp; <input type="text" value="0" name="txtFinanceBankPer" id="txtFinanceBankPer" autocomplete="off" readonly="readonly" required placeholder="Bank %" style="width:25%" /> 
        &nbsp; <input type="text" value="0" name="txtFinanceCashPer" id="txtFinanceCashPer" autocomplete="off" readonly="readonly" required placeholder="Cash %" style="width:25%;" /> 
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
<?
	}
}
?>
