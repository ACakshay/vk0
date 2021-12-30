<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<script type="text/javascript" language="javascript">
			Protoplasm.use('timepicker')
	.transform('input.timepicker')
	.transform('input.timepicker2', {use24hrs: true});
 Protoplasm.use('datepicker') .transform('input.datepicker') .transform('input.datepicker_es', { 'locale': 'lt_LT' });

</script>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','width=920, height=700, scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<?
$message="";
$flagPost1=0; $flagPost2=0;	
if(isset($_POST["btnSubmit"]))
{
	$reportOf=$_POST["txtReportOf"];
	$id=$_POST["txtDetails"];
	$tdsPerChk1 =" and b.InvestorTDSPercent<>'' and b.InvestorTDSPercent>0 ";
	$tdsPerChk2 =" and a.InvestorTDSPercent<>'' and a.InvestorTDSPercent>0 ";
	if($reportOf=='Client')
	{
		$fReport = "Investor";
		$fChk = "ClientID"; 
	}elseif($reportOf=='Investor')
	{ $fReport = "Client"; $fChk = "InvestorID"; }elseif($reportOf=='Negotiator'){
	$tdsPerChk1 =" and b.NegotiatorTDSPercent<>'' and b.NegotiatorTDSPercent>0 ";
	$tdsPerChk2 =" and a.NegotiatorTDSPercent<>'' and a.NegotiatorTDSPercent>0 ";
	
	 $fReport = "Client"; $fChk = "NegotiatorID";  }
	
	$sqldate1="select a.*,b.* from tblTransactionMaster a, tblBankTransactionDetails b where a.TransactionID=b.TransactionID and a.".$fChk."";
	$sqldate1= $sqldate1." ='".$id."' and a.isClosed=0 and a.isDelete=0 and a.isExtended=0 ".$tdsPerChk1." order by TenureFrom "	;
	$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
	if($no1 = mysql_num_rows($resultdate1)>0){ $flagPost1=1; }
	
	$sqlExt="select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a, tblTransactionMaster b where ";
	$sqlExt= $sqlExt." a.TransactionID=b.TransactionID and b.".$fChk." ='".$id."' and a.isClosed=0 and a.isDelete=0 and a.isExtended=0 ";
	$sqlExt= $sqlExt." ".$tdsPerChk2." order by a.TenureFrom "	;
	$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
	if(mysql_num_rows($resultExt)>0)
	{
		$flagPost2=1;	
	}
	if($flagPost1==0 && $flagPost2==0)
	{
		$message= "No Data Available";
	}
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">TDS Report</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Reports &nbsp;&raquo;&nbsp; <b>TDS Report</b></td>
                </tr>
                <tr><td class="message" align="center"><?=$message?></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                            	<td align="center" valign="top">
                                    <form id="frmTDSReport" name="frmTDSReport" method="post">
                                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                            <tr>
                                                <td class="loginTxt" width="35%">Report Of</td>
                                                <td align="left" width="15%">
                                                    <select name="txtReportOf" id="txtReportOf" style="width:150px;" required onchange="get_frm('ajxGetReportOf.php',this.value,'rResult');"> 
                                                        <option value="Client" selected="selected">Client</option>
                                                        <option value="Investor">Investor</option>
                                                        <option value="Negotiator">Negotiator</option>                                              
                                                    </select>
                                                </td>
                                                <td align="left" width="50%" id="rResult">
                                                	&nbsp;&nbsp;&nbsp;&nbsp;<b>Client</b>&nbsp;&nbsp;&nbsp;&nbsp;<select name="txtDetails" id="txtDetails" style="width:150px;" required > 
                                                         <option value="">Select</option>
                                                             <?
                                                                $sqlC ="select * from tblClientMaster ";
                                                                $resultC = mysql_query ($sqlC) or die ("Error in  query : ".$sqlC."<br>".mysql_errno()." : ".mysql_error());
                                                                if(mysql_num_rows($resultC)>0)
                                                                {
                                                                    while($rowC = mysql_fetch_array($resultC))
                                                                    {
                                                            ?>
                                                                <option value="<?=$rowC["ClientID"]?>" ><?=$rowC["ClientName"]?></option>
                                                           <? } } ?>
                                                    </select>
                                                    &nbsp;&nbsp;<input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" class="button"/>
												</td>
                                             </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<?  if($flagPost1==1 || $flagPost2==1){ ?>
    <tr>
    <td align="center" valign="top">
        <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            <tr bgcolor="#EFEFEF">
                <td class="heading" height="40px" style="font-size:14px;" width="60%"><?=$reportOf?> :
                	<?
					if($reportOf=='Client'){ echo $fName = getClientName($id); }elseif($reportOf=='Investor'){ echo $fName = getInvestorName($id); }elseif($reportOf=='Negotiator'){ echo $fName = getNegotiatorName($id); }
					?>
                </td>
            </tr>
            <tr><td height="20px">&nbsp;</td></tr>
           <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" width="10%">S.No.</td>
                            <td class="tableHead" width="30%"><?=$fReport?> <? if($reportOf=='Client'){ ?>- Negotiator <? } ?></td>
                            <td class="tableHead" width="30%">TDS Amount</td>
                            <td class="tableHead" width="30%">Date</td>
                        </tr>
                       <?
					   if($flagPost1==1)
					   {
							$count=0;
							$i=0;
							while($rowResult = mysql_fetch_array($resultdate1))
							{
								$count++; $bankper = "InvesBankPercent"; $tdsPer = "InvestorTDSPercent";
								$rTransaction=str_replace(",","",$rowResult["TransactionAmount"]);
								if($reportOf=='Client'){ $name = getInvestorName($rowResult["InvestorID"]); }elseif($reportOf=='Investor' || $reportOf=='Negotiator'){ $name = getClientName($rowResult["ClientID"]); }
								if($reportOf=='Negotiator') { $bankper = "NegotiatorBankPercent"; $tdsPer = "NegotiatorTDSPercent"; }
								$durationArr = getDurationFromDates($rowResult["TenureFrom"],$rowResult["TenureTo"]);
								$durationArr[0] = $durationArr[0]*12;
								$durationArr[1] = $durationArr[0]+$durationArr[1];
								
								$bankInt = ($rTransaction*$rowResult[$bankper]) /100;
								$bankIntPerDay = $bankInt /30;
								$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
								$tdsAmount = ($bankInt*$rowResult[$tdsPer]) /100;
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><?=$name?></td>
                            <td class="tbl_row"><? echo $rTds[$i] = round($tdsAmount); ?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowResult["TenureFrom"])?></td>
                        </tr>
                        <?
								$i++;
								if($reportOf=='Client'){
								$sqlN="select a.TransactionID,a.NegotiatorID,b.TransactionID,b.NegotiatorBankPercent,b.NegotiatorTDSPercent ";
								$sqlN=$sqlN." from tblTransactionMaster a ,tblBankTransactionDetails b where a.isClosed=0 and a.isDelete=0 ";
								$sqlN=$sqlN." and a.isExtended=0 and a.TransactionID=b.TransactionID ";
								$sqlN=$sqlN." and a.TransactionID='".$rowResult["TransactionID"]."' and b.NegotiatorTDSPercent<>'' ";
								$resultN=mysql_query($sqlN) or die ("Query Failed ".mysql_error());
								if($no = mysql_num_rows($resultN)>0)
								{
									$count++;
									$rowN = mysql_fetch_array($resultN);
									$bankInt = ($rTransaction*$rowN["NegotiatorBankPercent"]) /100;
									$bankIntPerDay = $bankInt /30;
									$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
									$tdsAmount = ($bankInt*$rowN["NegotiatorTDSPercent"]) /100;
						?>
                        <tr>
                            <td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><?=getNegotiatorName($rowN["NegotiatorID"])?></td>
                            <td class="tbl_row"><? echo $rTds[$i] = round($tdsAmount); ?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowResult["TenureFrom"])?></td>
                        </tr>
                        <?
								$i++;
								}
							}		
						}
					}
					if($flagPost2==1)
					{
					  while($rowExt = mysql_fetch_array($resultExt))
							{
								$count++;
								$bankper = "InvesBankPercent"; $tdsPer = "InvestorTDSPercent";
								
								$rTransaction=str_replace(",","",$rowExt["TransactionAmount"]);
								if($reportOf=='Client'){ $name = getInvestorName($rowExt["InvestorID"]); }elseif($reportOf=='Investor' || $reportOf=='Negotiator'){ $name = getClientName($rowExt["ClientID"]); }
								if($reportOf=='Negotiator') { $bankper = "NegotiatorBankPercent"; $tdsPer = "NegotiatorTDSPercent"; }
								$durationArr = getDurationFromDates($rowExt["fdt"],$rowExt["tdt"]);
								$durationArr[0] = $durationArr[0]*12;
								$durationArr[1] = $durationArr[0]+$durationArr[1];
								
								$bankInt = ($rTransaction*$rowExt[$bankper]) /100;
								$bankIntPerDay = $bankInt /30;
								$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
								$tdsAmount = ($bankInt*$rowExt[$tdsPer]) /100;
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><?=$name?></td>
                            <td class="tbl_row"><? echo $rTds[$i] = round($tdsAmount); ?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowExt["fdt"])?></td>
                        </tr>
                        <?
								$i++;
								if($reportOf=='Client'){
								$sqlN="select a.TransactionID,a.NegotiatorID,b.TransactionID,b.NegotiatorBankPercent,b.NegotiatorTDSPercent ";
								$sqlN=$sqlN." from tblTransactionMaster a ,tblExtendedTransaction b where b.isClosed=0 and b.isDelete=0 and ";
								$sqlN=$sqlN." b.isExtended=0 and a.TransactionID=b.TransactionID ";
								$sqlN=$sqlN." and a.TransactionID='".$rowExt["TransactionID"]."' and b.NegotiatorTDSPercent<>'' ";
								$resultN=mysql_query($sqlN) or die ("Query Failed ".mysql_error());
								if($no = mysql_num_rows($resultN)>0)
								{
									$count++;
									$rowN = mysql_fetch_array($resultN);
									$bankInt = ($rTransaction*$rowN["NegotiatorBankPercent"]) /100;
									$bankIntPerDay = $bankInt /30;
									$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
									$tdsAmount = ($bankInt*$rowN["NegotiatorTDSPercent"]) /100;
						?>
                        <tr>
                            <td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><?=getNegotiatorName($rowN["NegotiatorID"])?></td>
                            <td class="tbl_row"><? echo $rTds[$i] = round($tdsAmount); ?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowExt["fdt"])?></td>
                        </tr>
                        <?
								$i++;
								}
							}		
						}
					}
						?>
                         <tr>
                        	<td align="right" colspan="2"><b>Total</b></td>
                          	<td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($rTds)?></span></td>
                            <td class="tbl_row"><span style="color:#006600; font-size:18px;"></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr><td height="10px">&nbsp;</td></tr>
<tr><td valign="top" height="5px">&nbsp;</td></tr>
<tr><td height="7px">&nbsp;</td></tr>
<tr><td align="center">
<a href="#" onClick="return popitup('print-tds-report.php?ro=<?=$reportOf?>&id=<?=$id?>')"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a>
</td></tr>
<? } ?>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>