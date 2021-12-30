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
$flagPost=0;
	
if(isset($_POST["btnClientReport"]))
{
	$clientId=$_POST["txtClient"];
	$tType=$_POST["txtMode"];
	
	$sqldate1="select a.*,b.* from tblTransactionMaster a, tblTransactionDetails b where a.TransactionID=b.TransactionID";
	$sqldate1= $sqldate1." and b.TransactionMode = '".$tType."' and  a.ClientID ='".$clientId."' "	;
		 
	$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
	if($no1 = mysql_num_rows($resultdate1)>0)
	{
		$flagPost=1;
	}
	else
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
                                             <option value="">-- Select Client --</option>
                                             <?
											$sqlInves ="select * from tblClientMaster where isActive='0'";
											$resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
											if(mysql_num_rows($resultInves)>0)
											{
                                                while($rowInves = mysql_fetch_array($resultInves))
                                                {
                                                ?>
                                                    <? if($rowInves["ClientHead"]=='0'){ $inves_id = $rowInves["ClientID"] ;?>
                                                    <option value="<?=$rowInves["ClientID"]?>" ><?=$rowInves["ClientName"]?></option>
                                                     <? }if($rowInves["ClientHead"]!='0' && $rowInves["ClientHead"]==$inves_id){?>
                                                    <option value="<?=$rowInves["ClientID"]?>" style="padding-left:15px;">&nbsp;<?=$rowInves["ClientName"]?></option>
											<? } } } ?>
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
<?
if($flagPost==1)
{
	$clientTrans = getTransactionDetails($clientId,'Client');
?>
    <tr>
    <td align="center" valign="top">
        <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            <tr bgcolor="#EFEFEF">
                <td class="heading" height="40px" style="font-size:14px;" width="60%">Client  : <?=getClientName($clientId)?></td>
                <td class="loginTxt1" style="font-size:16px;">Total Amount  : <?=$clientTrans["tSum"]?> &nbsp; &nbsp; &nbsp; Mode  : <?=$tType?></td>
            </tr>
            <tr><td height="20px">&nbsp;</td></tr>
            <?
				if($tType=='Bank')
				{
			?>
            <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" rowspan="2" width="1%">S.No.</td>
                            <td class="tableHead" rowspan="2" width="15%">Tenure <span style="color:#006600">(Due Date)</span></td>
                            <td class="tableHead" rowspan="2" width="15%">Investor</td>
                            <td class="tableHead" rowspan="2" width="10%">At Rate(%)</td>
                            <td class="tableHead" rowspan="2" width="15%">Amount</td>
                            <td class="tableHead" colspan="2" width="20%">Earn Commission(%)</td>
                            <td class="tableHead" colspan="2" width="20%">Commission Amount</td>
                        </tr>
                        <tr>
                        	<td class="tableHead" width="10%">Bank</td>
                            <td class="tableHead" width="10%">Cash</td>
                        	<td class="tableHead" width="10%">Bank</td>
                            <td class="tableHead" width="10%">Cash</td>
                        </tr>
                        <?
							$count=1;
							$i=0;
							while($rowResult = mysql_fetch_array($resultdate1))
							{
								$frmDate = getDateNormalFormat($rowResult["TenureFrom"]);
								$toDate = getDateNormalFormat($rowResult["TenureTo"]);
								$durationArr = getDurationFromDates($frmDate,$toDate);
								$durationArr[0] = $durationArr[0]*12;
								$durationArr[1] = $durationArr[0]+$durationArr[1];
								$interestBankAmt = ($rowResult["TransactionAmount"]*$rowResult["FinanceBankPercent"]) /100;
								$interestBankAmtPerDay = $interestBankAmt /30;
								$interestBankAmt = round(($interestBankAmt * $durationArr[1])+($interestBankAmtPerDay*$durationArr[2]));
								
								$interestCashAmt = ($rowResult["TransactionAmount"]*$rowResult["FinanceCashPercent"]) /100;
								$interestCashAmtPerDay = $interestCashAmt /30;
								$interestCashAmt = round(($interestCashAmt * $durationArr[1])+($interestCashAmtPerDay*$durationArr[2]));
								
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.<div id="div_1" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:50px; left:225px; z-index:1000; padding: 0px;"></div></td>
                            <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowResult["TransactionID"]?>&tt=<?=$rowResult["TransactionMode"]?>')"><?=$frmDate?> ~ <span style="color:#006600"><b><?=$toDate?></b></span></a></td>
                            <td class="tbl_row"><?=getInvestorName($rowResult["InvestorID"])?></td>
                            <td class="tbl_row"><?=$rowResult["FinancePercent"]?></td>
                            <td class="tbl_row"><? echo $trnsAmtRow[$i] = $rowResult["TransactionAmount"]; ?></td>
                            <td class="tbl_row"><?=$rowResult["FinanceBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["FinanceCashPercent"]?></td>
                            <td class="tbl_row"><? echo $bankInsAmtRow[$i] = $interestBankAmt; ?></td>
                            <td class="tbl_row"><? echo $cashIntAmtRow[$i] = $interestCashAmt; ?></td>
                        </tr>
                        <?
							$i++; $count++;
							}
						?>
                         <tr>
                        	<td align="right" colspan="3"><b>Total</b></td>
                          	<td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($trnsAmtRow)?></span></td>
                            <td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($bankInsAmtRow)?></span></td>
                            <td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($cashIntAmtRow)?></span></td>
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
                            <td class="tableHead" width="20%">Tenure <span style="color:#006600">(Due Date)</span></td>
                            <td class="tableHead" width="15%">Investor</td>
                            <td class="tableHead" width="10%">At Rate(%)</td>
                            <td class="tableHead" width="15%">Amount</td>
                            <td class="tableHead" width="15%">Earn Commission(%)</td>
                            <td class="tableHead" width="20%">Commission Amount</td>
                        </tr>
                       <?
							$count=1;
							$i=0;
							while($rowResult = mysql_fetch_array($resultdate1))
							{
								$frmDate = getDateNormalFormat($rowResult["TenureFrom"]);
								$toDate = getDateNormalFormat($rowResult["TenureTo"]);
								$durationArr = getDurationFromDates($frmDate,$toDate);
								$durationArr[0] = $durationArr[0]*12;
								$durationArr[1] = $durationArr[0]+$durationArr[1];
								$interestAmt = ($rowResult["TransactionAmount"]*$rowResult["NegotiatorPercent"]) /100;
								$interestAmtPerDay = $interestAmt /30;
								$interestAmt = round(($interestAmt * $durationArr[1])+($interestAmtPerDay*$durationArr[2]));
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.<div id="div_1" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:50px; left:225px; z-index:1000; padding: 0px;"></div></td>
                            <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowResult["TransactionID"]?>&tt=<?=$rowResult["TransactionMode"]?>')"><?=$frmDate?> ~ <span style="color:#006600"><b><?=$toDate?></b></span></a></td>
                            <td class="tbl_row"><?=getInvestorName($rowResult["InvestorID"])?></td>
                            <td class="tbl_row"><?=$rowResult["FinancePercent"]?></td>
                            <td class="tbl_row"><? echo $trnsAmtRow[$i] = $rowResult["TransactionAmount"]; ?></td>
                            <td class="tbl_row"><?=$rowResult["NegotiatorPercent"]?></td>
                            <td class="tbl_row"><? echo $commissionEarn[$i] = $interestAmt; ?></td>
                        </tr>
                        <?
							$i++; $count++;
							}
						?>
                         <tr>
                        	<td align="right" colspan="4"><b>Total</b></td>
                          	<td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($trnsAmtRow)?></span></td>
                            <td class="tbl_row"><span style="color:#006600; font-size:18px;"></span></td>
                            <td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($commissionEarn)?></span></td>
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
<tr><td align="center"><a href="#" onclick="window.print();"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a></td></tr>
<? } ?>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>