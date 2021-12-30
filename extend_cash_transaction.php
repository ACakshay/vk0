<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<style type="text/css">
.plainmodal-overlay {
	background-color: #333;
    display:block;
	height: 100%;
    left: 0;
    opacity: 0.5;
    position: fixed;
    top:0;
    width: 100%;
    z-index:99;
}
.parentPopup {
	display: block;
    left: 10%;
    position: fixed;
    top: 6%;
	width:80%;
    z-index: 99;
}
.childPopup {
	display: block;
    left: 10%;
    /*margin-left: -232px;
    margin-top: -202.5px;*/
    position: fixed;
    top: 15%;
	width:100%;
    z-index: 1999;
}
.popupDiv {
	background:#FFFFFF;
	border-radius:10px;
	border:5px solid #333;
	z-index:9999;
}
.popupHeading {
	background:#333;
	font-family:Trebuchet MS, Arial;
	font-size:20px;
	font-weight:normal;
	line-height:40px;
	padding-left:15px;
	color:#FFFFFF;
	text-transform:uppercase;
	border-bottom:1px solid #e1e1e1 !important;
}
</style>
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
		
	}else{ $where =" and TransactionID='".$transactionID."' "; $divId = $transactionID;  $tbl = "tblCashTransactionDetails"; }
	
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
<form id="frmExtendCTransaction" name="frmExtendCTransaction" method="post" onsubmit="return validateFormValue(this.name);">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top">
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
                    <input type="text" name="txtRenewalTenureFrm" id="txtRenewalTenureFrm" style="width:150px;" readonly="readonly" value="<?=getDateDBFormat($toDate)?>" required />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtendCTransaction.txtRenewalTenureFrm); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                     <td class="loginTxt1" width="35%" colspan="2"><b>Renewal Tenure To</b><br />
                    <input type="text" name="txtRenewalTenureTo" id="txtRenewalTenureTo" style="width:150px;" value="<?//=getDateDBFormat($toDate)?>" required />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtendCTransaction.txtRenewalTenureTo); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                </tr>
                <tr>
                    <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="3">Client</td>
                </tr>
                <tr>
                    <td class="loginTxt1" width="35%">Re-payment Bank<br />
                        <select name="txtClientReBank" id="txtClientReBank" style="width:70%;">
                                    <?
										$sqlBank ="select * from tblClientBankMaster where ClientID= '".$clientId."' and ClientType like '".$clientType."' ";
										$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
										if(mysql_num_rows($resultBank)>0)
										{
											while($rowBank = mysql_fetch_array($resultBank))
											{
									?>
											<option value="<?=$rowBank["RecID"]?>" <? if($rowTransD["RepaymentBankID"]==$rowBank["RecID"]) { ?> selected="selected" <? } ?>><?=getBankName($rowBank["BankID"])?></option>
									<?
											}
										}
									?>
                            </select>
                        
                    </td>	
                	<td class="loginTxt1" width="35%" colspan="2">Cheque No.<br />
                    	<input name="txtRepaymentChequeNoE" id="txtRepaymentChequeNoE" style="width:70%;" value="<?=$rowTransD["RepaymentChequeNo"]?>" type="text" autocomplete="off" required />
                    </td>
                 </tr>
                <tr>
                    <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="3">Other Details</td>
                </tr>
                <tr>
                     <td class="loginTxt1">Investment %<br />
                        <input type="text" style="width:70%;" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off" value="<?=$rowTransD["InvesPercent"]?>" onchange="
            var diff = parseFloat(document.forms['frmExtendCTransaction']['txtNegotiatorPer'].value) + parseFloat(this.value);
            document.forms['frmExtendCTransaction']['txtFinancePer'].value= parseFloat(diff).toFixed(2);
           "  required />
                    </td>
                    <td class="loginTxt1">Negotiator %<br />
                    	<input type="text" style="width:70%;" name="txtNegotiatorPer" id="txtNegotiatorPer" value="<?=$rowTransD["NegotiatorPercent"]?>" onchange="
            		var nSum = parseFloat(document.forms['frmExtendCTransaction']['txtInvestmentPer'].value) + parseFloat(this.value);
                    document.forms['frmExtendCTransaction']['txtFinancePer'].value= parseFloat(nSum).toFixed(2);
                             " autocomplete="off" />
                   </td>
                   <td class="loginTxt1">Finance %<br />
                    	<input type="text" name="txtFinancePer" style="width:70%;" id="txtFinancePer" value="<?=$rowTransD["FinancePercent"]?>" readonly="readonly" autocomplete="off" required />
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
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:99999; position:relative; left:-500px; top:0px;">
</iframe>
<? } } } ?>