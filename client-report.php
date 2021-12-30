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
if(isset($_POST["btnClientReport"]))
{
	$transactionMode=$_POST["txtMode"];
	if($transactionMode=='Bank')
	{
		$tbl="tblBankTransactionDetails b ";
	}else{ $tbl="tblCashTransactionDetails b"; }
	
	$sqldate1="select a.*,b.* from tblTransactionMaster a, ".$tbl." where a.TransactionMode = '".$transactionMode."' and a.TransactionID=b.TransactionID and ";
	$sqldate1=$sqldate1." a.ClientID ='".$_POST["txtClient"]."' and a.isClosed=0 and a.isDelete=0 and a.isExtended=0 order by a.TenureTo "	;
	$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
	if($no1 = mysql_num_rows($resultdate1)>0){ $flagPost1=1; }
	
	$sqlExt= "select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where b.ClientID ='".$_POST["txtClient"]."' and ";
	$sqlExt= $sqlExt." b.TransactionMode = '".$transactionMode."' and a.isExtended=0 and b.isExtended=1 and a.isClosed=0 and a.isDelete=0 and a.TransactionID=b.TransactionID ";
	$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultExt)>0){ $flagPost2=1; }
	
	if($flagPost1==0 && $flagPost2==0)
	{
		$message= "No Data Available";
	}
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Client Report</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Reports &nbsp;&raquo;&nbsp; <b>Client Report</b></td>
                </tr>
                <tr><td class="message" align="center"><?=$message?></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                            	<td align="center" valign="top">
                                    <form id="frmClientReport" name="frmClientReport" method="post">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                   		<tr>
                                        	<td class="loginTxt" width="30%">Client</td>
                                        	<td align="left" width="15%">
											<select name="txtClient" id="txtClient" style="width:150px;" required > 
                                            	 <option value="">Select Client</option>
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
                                         	</td>
                                          	<td class="loginTxt" width="10%">Mode</td>
                                          	<td align="left" width="45%">
                                         		<input type="radio" name="txtMode" id="txtMode" value="Bank" checked="checked"  />Bank &nbsp;&nbsp;
                                          		<input type="radio" name="txtMode" id="txtMode" value="Cash"   />Cash
                                         		&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="submit" id="btnClientReport" name="btnClientReport" value="Submit" class="button"/>
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
                <td class="heading" height="40px" style="font-size:14px;" width="60%">Client  : <?=getClientName($_POST["txtClient"])?></td>
                <td class="loginTxt1" style="font-size:16px; text-align:right;"> Mode  : <?=$transactionMode?></td>
            </tr>
            <?
				if($transactionMode=='Bank')
				{
			?>
            <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" rowspan="2" width="5%">S.No.</td>
                            <td class="tableHead" rowspan="2" width="10%">Amount</td>
                            <td class="tableHead" rowspan="2" width="15%">Investor</td>
                            <td class="tableHead" colspan="2" width="15%">Investment(%)</td>
                            <td class="tableHead" colspan="2" width="15%">Negotiator(%)</td>
                            <td class="tableHead" colspan="2" width="15%">Finance(%)</td>
                            <td class="tableHead" rowspan="2" width="15%">Client</td>
                            <td class="tableHead" rowspan="2" width="10%">Due Date</td>
                        </tr>
                        <tr>
                        	<td class="tableHead" width="7.5%">Bank</td>
                            <td class="tableHead" width="7.5%">Cash</td>
                            <td class="tableHead" width="7.5%">Bank</td>
                            <td class="tableHead" width="7.5%">Cash</td>
                            <td class="tableHead" width="7.5%">Bank</td>
                            <td class="tableHead" width="7.5%">Cash</td>
                        </tr>
                        <?
						if($flagPost1==1)
						{
							$count=0;
							$i=0;
							while($rowResult = mysql_fetch_array($resultdate1))
							{
								$count++;
								$clientId = $rowResult["ClientID"];
								$clientName = getClientName($clientId);
								if($rowResult["SubClientID"]!='0')
								{
									$clientId = $rowResult["SubClientID"];
									$clientName = getSubClientName($clientId);
								}
								$investorID = $rowResult["InvestorID"];
								$investorName = getInvestorName($investorID);
								if($rowResult["SubInvestorID"]!='0')
								{
									$investorID = $rowResult["SubInvestorID"];
									$investorName = getSubInvestorName($investorID);
								}
								$rTransaction=str_replace(",","",$rowResult["TransactionAmount"]);
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><? echo $rowResult["TransactionAmount"]; $rTAmount[$i] = $rTransaction; ?></td>
                            <td class="tbl_row"><?=$investorName?></td>
                            <td class="tbl_row"><?=$rowResult["InvesBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["InvesCashPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["NegotiatorBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["NegotiatorCashPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["FinanceBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["FinanceCashPercent"]?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowResult["TenureTo"])?></td>
                        </tr>
                        <?
							$i++; 
							}
						}
						if($flagPost2==1)
						{
							while($rowExt = mysql_fetch_array($resultExt))
							{
								$count++;
								$clientId = $rowExt["ClientID"];
								$clientName = getClientName($clientId);
								if($rowExt["SubClientID"]!='0')
								{
									$clientId = $rowExt["SubClientID"];
									$clientName = getSubClientName($clientId);
								}
								$investorID = $rowExt["InvestorID"];
								$investorName = getInvestorName($investorID);
								if($rowExt["SubInvestorID"]!='0')
								{
									$investorID = $rowExt["SubInvestorID"];
									$investorName = getSubInvestorName($investorID);
								}
								$rTransaction=str_replace(",","",$rowExt["TransactionAmount"]);
						?>
                         <tr>
                        	<td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><? echo $rowExt["TransactionAmount"]; $rTAmount[$i] = $rTransaction; ?></td>
                            <td class="tbl_row"><?=$investorName?></td>
                            <td class="tbl_row"><?=$rowExt["InvesBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["InvesCashPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["NegotiatorBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["NegotiatorCashPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["FinanceBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["FinanceCashPercent"]?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowExt["tdt"])?></td>
                        </tr>
                        <?
							$i++; 
							}
						}
						?>
                        <tr>
                        	<td align="right"><b>Total</b></td>
                          	<td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($rTAmount)?></span></td>
                            <td class="tbl_row" colspan="9"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?
				 }else{
			?>
            <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" width="5%">S.No.</td>
                            <td class="tableHead" width="15%">Amount</td>
                            <td class="tableHead" width="15%">Investor</td>
                            <td class="tableHead" width="10%">Investment(%)</td>
                            <td class="tableHead" width="10%">Negotiator(%)</td>
                            <td class="tableHead" width="10%">Finance(%)</td>
                            <td class="tableHead" width="15%">Client</td>
                            <td class="tableHead" width="10%">Due Date</td>
                        </tr>
                      <?
					  	if($flagPost1==1)
						{
							$count=0; $i=0;
							while($rowResult = mysql_fetch_array($resultdate1))
							{
								$count++;
								$clientId = $rowResult["ClientID"];
								$clientName = getClientName($clientId);
								if($rowResult["SubClientID"]!='0')
								{
									$clientId = $rowResult["SubClientID"];
									$clientName = getSubClientName($clientId);
								}
								$investorID = $rowResult["InvestorID"];
								$investorName = getInvestorName($investorID);
								if($rowResult["SubInvestorID"]!='0')
								{
									$investorID = $rowResult["SubInvestorID"];
									$investorName = getSubInvestorName($investorID);
								}
								$rTransaction=str_replace(",","",$rowResult["TransactionAmount"]);
						?>
                       <tr>
                        	<td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><? echo $rowResult["TransactionAmount"]; $rTAmount[$i] = $rTransaction; ?></td>
                            <td class="tbl_row"><?=$investorName?></td>
                            <td class="tbl_row"><?=$rowResult["InvesPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["NegotiatorPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["FinancePercent"]?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowResult["TenureTo"])?></td>
                        </tr>
                        <?
							$i++; 
							}
						}
						if($flagPost2==1)
						{
							while($rowExt = mysql_fetch_array($resultExt))
							{
								$count++;
								$clientId = $rowExt["ClientID"];
								$clientName = getClientName($clientId);
								if($rowExt["SubClientID"]!='0')
								{
									$clientId = $rowExt["SubClientID"];
									$clientName = getSubClientName($clientId);
								}
								$investorID = $rowExt["InvestorID"];
								$investorName = getInvestorName($investorID);
								if($rowExt["SubInvestorID"]!='0')
								{
									$investorID = $rowExt["SubInvestorID"];
									$investorName = getSubInvestorName($investorID);
								}
								$rTransaction=str_replace(",","",$rowExt["TransactionAmount"]);
						?>
                          <tr>
                        	<td class="tbl_row"><?=$count?>.</td>
                            <td class="tbl_row"><? echo $rowExt["TransactionAmount"]; $rTAmount[$i] = $rTransaction; ?></td>
                            <td class="tbl_row"><?=$investorName?></td>
                            <td class="tbl_row"><?=$rowExt["InvesPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["NegotiatorPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["FinancePercent"]?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=getDateDBFormat($rowExt["tdt"])?></td>
                        </tr>
                        <?
							$i++; 
							}
						}
						?>
                         <tr>
                        	<td align="right"><b>Total</b></td>
                          	<td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($rTAmount)?></span></td>
                           	<td class="tbl_row" colspan="6"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?
				}
			?>
        </table>
    </td>
</tr>
<tr><td height="10px">&nbsp;</td></tr>
<tr><td valign="top" height="5px">&nbsp;</td></tr>
<tr><td height="7px">&nbsp;</td></tr>
<tr><td align="center"><a href="#" onClick="return popitup('print-client-report.php?cid=<?=$_POST["txtClient"]?>&tt=<?=$transactionMode?>')"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a></td></tr>
<? } ?>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>