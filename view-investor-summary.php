<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body { margin:0px; padding:0px; }
.slipHead { background:#333333; font-family:Arial, Helvetica, sans-serif; font-size:20px; text-align:center; color:#fff; font-weight:bold; line-height:40px; text-transform:uppercase; }
.txtRight { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#333333; font-weight:normal; padding-right:10px; line-height:25px; }
.txtRight span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#333333; font-weight:bold; padding-right:10px; line-height:25px; }
.txtLeft { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#333333; font-weight:normal; padding-left:10px; line-height:17px; }
.txtLeft span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#333333; font-weight:bold; line-height:17px; }
.txtCenter { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:center; color:#333333; font-weight:normal; line-height:17px; }
.txtCenter span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:center; color:#333333; font-weight:bold; line-height:17px; }
.myTableR { border-collapse:collapse; }
.myTableR td, table.myTableR tr { border:1px solid #cccccc; padding:5px;}
.myTable td, table.myTable tr { border:0px!important; padding:2px;}
</style>
<script>
<!--
function popitup(url) {
	newwindow=window.open(url,'name','width=920, height=700, scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
}
function goBack() {
    window.history.back();
}
</script>
</head>
<body>

&nbsp;&nbsp;<a href="investor-summary.php">Go Back</a>
<?
$message="";
$flagPost1=0; $flagPost2=0;
if(isset($_POST['txtIsShow']))
{
	$trnsIdArr = array(); $trnsExtendedIdArr = array(); 
	$showResultId = $_POST['txtIsShow'];
	for($i=0;$i<count($showResultId);$i++)
	{
		$trnsArr = explode("-",$showResultId[$i]); 
		if($trnsArr[1]==0)
		{
			$trnsIdArr[] = $trnsArr[0];
		}else{ $trnsExtendedIdArr[] = $trnsArr[0]; }
	}
	$tMode = $_POST["txtTMode"];
	if(count($trnsIdArr))
	{	
		if($tMode=='Bank')
		{
			$tbl="tblBankTransactionDetails b ";
		}else{ $tbl="tblCashTransactionDetails b"; }
		
		$sqldate1="select a.*,b.* from tblTransactionMaster a, ".$tbl." where a.TransactionID=b.TransactionID and a.TransactionID in(".implode(',', $trnsIdArr).") and ";
		$sqldate1= $sqldate1." a.InvestorID ='".$_POST["txtInvestorId"]."' and a.TransactionMode='".$tMode."' and a.isClosed=0 and a.isDelete=0 and a.isExtended=0 ";
		$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
		if(mysql_num_rows($resultdate1)>0){ $flagPost1=1; }
	}
	if(count($trnsExtendedIdArr))
	{
		$sqlExt="select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where a.RecID  ";
		$sqlExt=$sqlExt." in(".implode(',', $trnsExtendedIdArr).") and b.TransactionMode = '".$tMode."' and b.InvestorID ='".$_POST["txtInvestorId"]."' ";
		$sqlExt=$sqlExt." and a.isExtended=0 and b.isExtended=1 and a.isClosed=0 and a.isDelete=0 and a.TransactionID=b.TransactionID order by RecID  ";
		$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
		if (mysql_num_rows($resultExt)>0){ $flagPost2=1; }
	}
	
}
?>
<?  if($flagPost1==1 || $flagPost2==1){ ?>
<table width="980px" cellpadding="5" cellspacing="0" align="center" style="border:2px solid #CCCCCC;">
	<tr><td align="center" style="padding:10px;"><img src="images/logo1.png" alt="" width="100px"></td></tr>
    <tr><td class="slipHead">Investor Summary</td></tr>
    <?
			if($tMode=='Bank')
			{
	?>
    <tr>
    	<td align="center" valign="top">
        	<table width="100%" cellpadding="10" cellspacing="0" align="center" border="1" class="myTableR">
            	<tr bgcolor="#DDEBF9">
                	<td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" width="15%" colspan="10"><? echo $investorName = getInvestorName($_POST["txtInvestorId"]); ?></span></td>
                </tr>
                <tr bgcolor="#e2e2e2">
                	<td class="txtCenter" width="5%" rowspan="2"><span>S.No.</span></td>
                    <td class="txtCenter" width="13%" rowspan="2"><span>Amount</span></td>
                    <td class="txtCenter" width="15%" rowspan="2"><span>Invesotor</span></td>
                    <td class="txtCenter" width="15%" rowspan="2"><span>Client</span></td>
                    <td class="txtCenter" width="13%" colspan="2"><span>Rate(%)</span></td>
                    <td class="txtCenter" width="10%" rowspan="2"><span>Tenure</span></td>
                    <td class="txtCenter" width="10%" colspan="2"><span>Interest</span></td>
                    <td class="txtCenter" width="10%" rowspan="2"><span>Due Date</span></td>
                </tr>
                <tr bgcolor="#e2e2e2">
                	<td class="txtCenter"><span>Bank</span></td>
                    <td class="txtCenter"><span>Cash</span></td>
                    <td class="txtCenter"><span>Bank</span></td>
                    <td class="txtCenter"><span>Cash</span></td>
                </tr>
                <?
				if($flagPost1==1)
				{
					$count =0; $i=0;
					while($rowIn = mysql_fetch_array($resultdate1))
                    {
						$count++;
						$clientId = $rowIn["ClientID"];
						$clientName = getClientName($clientId);
						if($rowIn["SubClientID"]!='0')
						{
							$clientId = $rowIn["SubClientID"];
							$clientName = getSubClientName($clientId);
						}
						$investorID = $rowIn["InvestorID"];
						$investorName = getInvestorName($investorID);
						if($rowIn["SubInvestorID"]!='0')
						{
							$investorID = $rowIn["SubInvestorID"];
							$investorName = getSubInvestorName($investorID);
						}
						$frmDate = getDateNormalFormat($rowIn["TenureFrom"]);
						$toDate = getDateNormalFormat($rowIn["TenureTo"]);
						
						$durationArr = getDurationFromDates($frmDate,$toDate);
						$durationArr[0] = $durationArr[0]*12;
						$durationArr[1] = $durationArr[0]+$durationArr[1];
						
				?>
                <tr>
                	<td class="txtCenter"><?=$count?>.</td>
                	<td class="txtCenter"><? echo $tAmount[$i] = $rowIn["TransactionAmount"]; ?></td>
                    <td class="txtCenter"><?=$investorName?></td>
                    <td class="txtCenter"><?=$clientName?></td>
                	<td class="txtCenter"><?=$rowIn["InvesBankPercent"]?></td>
                    <td class="txtCenter"><?=$rowIn["InvesCashPercent"]?></td>
                    <td class="txtCenter">
						<?=$durationArr[1]?> Months <? if($durationArr[2]>15){ ?><?=$durationArr[2]?> days <? } ?>
                    </td>
                    <td class="txtCenter">
                    	<?
							$interestBankAmt[$i]= ($tAmount[$i]*$rowIn["InvesBankPercent"]) /100;
							if($durationArr[2]>15)
							{
								$interestBankAmtPerDay[$i] = $interestBankAmt[$i] /30;
								echo $interestBankAmt[$i] = round(($interestBankAmt[$i] * $durationArr[1])+($interestBankAmtPerDay[$i]*$durationArr[2]));
							}else{ echo $interestBankAmt[$i] = round(($interestBankAmt[$i] * $durationArr[1])); }
						?>
                    </td>
                    <td class="txtCenter">
						<?
							$interestCashAmt[$i] = ($tAmount[$i]*$rowIn["InvesCashPercent"]) /100;
							if($durationArr[2]>15)
							{
								$interestCashAmtPerDay[$i] = $interestCashAmt[$i] /30;
								echo $interestCashAmt[$i] = round(($interestCashAmt[$i] * $durationArr[1])+($interestCashAmtPerDay[$i]*$durationArr[2]));
							}else{ echo $interestCashAmt[$i] = round(($interestCashAmt[$i] * $durationArr[1])); }
							
						?>
                    </td>
                    <td class="txtCenter"><?=getDateDBFormat($toDate)?></td>
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
						$frmDate = getDateNormalFormat($rowExt["fdt"]);
						$toDate = getDateNormalFormat($rowExt["tdt"]);
						
						$durationArr = getDurationFromDates($frmDate,$toDate);
						$durationArr[0] = $durationArr[0]*12;
						$durationArr[1] = $durationArr[0]+$durationArr[1];
						
				?>
                <tr>
                	<td class="txtCenter"><?=$count?>.</td>
                	<td class="txtCenter"><? echo $tAmount[$i] = $rowExt["TransactionAmount"]; ?></td>
                    <td class="txtCenter"><?=$investorName?></td>
                    <td class="txtCenter"><?=$clientName?></td>
                	<td class="txtCenter"><?=$rowExt["InvesBankPercent"]?></td>
                    <td class="txtCenter"><?=$rowExt["InvesCashPercent"]?></td>
                    <td class="txtCenter">
						<?=$durationArr[1]?> Months <? if($durationArr[2]>15){ ?><?=$durationArr[2]?> days <? } ?>
                    </td>
                    <td class="txtCenter">
                    	<?
							$interestBankAmt[$i]= ($tAmount[$i]*$rowExt["InvesBankPercent"]) /100;
							if($durationArr[2]>15)
							{
								$interestBankAmtPerDay[$i] = $interestBankAmt[$i] /30;
								echo $interestBankAmt[$i] = round(($interestBankAmt[$i] * $durationArr[1])+($interestBankAmtPerDay[$i]*$durationArr[2]));
							}else{ echo $interestBankAmt[$i] = round(($interestBankAmt[$i] * $durationArr[1])); }
						?>
                    </td>
                    <td class="txtCenter">
						<?
							$interestCashAmt[$i] = ($tAmount[$i]*$rowExt["InvesCashPercent"]) /100;
							if($durationArr[2]>15)
							{
								$interestCashAmtPerDay[$i] = $interestCashAmt[$i] /30;
								echo $interestCashAmt[$i] = round(($interestCashAmt[$i] * $durationArr[1])+($interestCashAmtPerDay[$i]*$durationArr[2]));
							}else{ echo $interestCashAmt[$i] = round(($interestCashAmt[$i] * $durationArr[1])); }
							
						?>
                    </td>
                    <td class="txtCenter"><?=getDateDBFormat($toDate)?></td>
                </tr>
                <?
				 $i++;
					}
				}
				?>
                <tr bgcolor="#f2f2f2">
                	<td class="txtCenter"></td>
                	<td class="txtCenter"><span><?=array_sum($tAmount)?></span></td>
                    <td class="txtCenter" colspan="5"></td>
                    <td class="txtCenter"><span><?=array_sum($interestBankAmt)?></span></td>
                    <td class="txtCenter" width="10%"><span><?=array_sum($interestCashAmt)?></span></td>
                    <td class="txtCenter" colspan="2"></td>
                </tr>
            </table>
        </td>
    </tr>
     <?
			}else{
	?>
	<tr>
    	<td align="center" valign="top">
        	<table width="100%" cellpadding="10" cellspacing="0" align="center" border="1" class="myTableR">
            	<tr bgcolor="#DDEBF9">
                	<td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" width="15%" colspan="10"><? echo $investorName = getInvestorName($investorId); ?></span></td>
                </tr>
                <tr bgcolor="#e2e2e2">
                	<td class="txtCenter" width="5%"><span>S.No.</span></td>
                    <td class="txtCenter" width="12%"><span>Amount</span></td>
                    <td class="txtCenter" width="15%"><span>Invesotor</span></td>
                    <td class="txtCenter" width="15%"><span>Client</span></td>
                    <td class="txtCenter" width="13%"><span>Rate(%)</span></td>
                    <td class="txtCenter" width="10%"><span>Tenure</span></td>
                    <td class="txtCenter" width="10%"><span>Interest</span></td>
                    <td class="txtCenter" width="10%"><span>Due Date</span></td>
                </tr>
                <?
				if($flagPost1==1)
				{
					$ccount =0; $i=0;
					while($rowIn = mysql_fetch_array($resultdate1))
                    {
						$ccount++; 
						$clientId = $rowIn["ClientID"];
						$clientName = getClientName($clientId);
						if($rowIn["SubClientID"]!='0')
						{
							$clientId = $rowIn["SubClientID"];
							$clientName = getSubClientName($clientId);
						}
						$investorID = $rowIn["InvestorID"];
						$investorName = getInvestorName($investorID);
						if($rowIn["SubInvestorID"]!='0')
						{
							$investorID = $rowIn["SubInvestorID"];
							$investorName = getSubInvestorName($investorID);
						}
						$frmDate = getDateNormalFormat($rowIn["TenureFrom"]);
						$toDate = getDateNormalFormat($rowIn["TenureTo"]);
						
						$durationArr = getDurationFromDates($frmDate,$toDate);
						$durationArr[0] = $durationArr[0]*12;
						$durationArr[1] = $durationArr[0]+$durationArr[1];
						
				?>
                <tr>
                	<td class="txtCenter"><?=$ccount?>.</td>
                	<td class="txtCenter"><? echo $tAmount[$i] = $rowIn["TransactionAmount"]; ?></td>
                    <td class="txtCenter"><?=$investorName?></td>
                    <td class="txtCenter"><?=$clientName?></td>
                	<td class="txtCenter"><?=$rowIn["InvesPercent"]?></td>
                    <td class="txtCenter"><?=$durationArr[1]?> Months <? if($durationArr[2]>15){ ?> <?=$durationArr[2]?> days <? } ?></td>
                    <td class="txtCenter">
						<?
							$interestAmt[$i]= ($tAmount[$i]*$rowIn["InvesPercent"]) /100;
							if($durationArr[2]>15)
							{
								$interestAmtPerDay[$i] = $interestAmt[$i] /30;
								echo $interestAmt[$i] = round(($interestAmt[$i] * $durationArr[1])+($interestAmtPerDay[$i]*$durationArr[2]));
							}else{ 	echo $interestAmt[$i] = round(($interestAmt[$i] * $durationArr[1])); }
						?></td>
                    <td class="txtCenter"><?=getDateDBFormat($toDate)?></td>
                </tr>
                <?
					$i++;
					}
				}
				if($flagPost2==1)
				{
					while($rowExt = mysql_fetch_array($resultExt))
                    {
						$ccount++; 
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
						$frmDate = getDateNormalFormat($rowExt["fdt"]);
						$toDate = getDateNormalFormat($rowExt["tdt"]);
						
						$durationArr = getDurationFromDates($frmDate,$toDate);
						$durationArr[0] = $durationArr[0]*12;
						$durationArr[1] = $durationArr[0]+$durationArr[1];
						
				?>
                <tr>
                	<td class="txtCenter"><?=$ccount?>.</td>
                	<td class="txtCenter"><? echo $tAmount[$i] = $rowExt["TransactionAmount"]; ?></td>
                    <td class="txtCenter"><?=$investorName?></td>
                    <td class="txtCenter"><?=$clientName?></td>
                	<td class="txtCenter"><?=$rowExt["InvesPercent"]?></td>
                    <td class="txtCenter"><?=$durationArr[1]?> Months <? if($durationArr[2]>15){ ?> <?=$durationArr[2]?> days <? } ?></td>
                    <td class="txtCenter">
						<?
							$interestAmt[$i]= ($tAmount[$i]*$rowExt["InvesPercent"]) /100;
							if($durationArr[2]>15)
							{
								$interestAmtPerDay[$i] = $interestAmt[$i] /30;
								echo $interestAmt[$i] = round(($interestAmt[$i] * $durationArr[1])+($interestAmtPerDay[$i]*$durationArr[2]));
							}else{ 	echo $interestAmt[$i] = round(($interestAmt[$i] * $durationArr[1])); }
						?></td>
                    <td class="txtCenter"><?=getDateDBFormat($toDate)?></td>
                </tr>
                <?
					 $i++;
					}
				}
				?>
               <tr bgcolor="#f2f2f2">
                	<td class="txtCenter"></td>
                	<td class="txtCenter"><span><?=array_sum($tAmount)?></span></td>
                    <td class="txtCenter" colspan="4"></td>
                    <td class="txtCenter"><span><?=array_sum($interestAmt)?></span></td>
                    <td class="txtCenter"></td>
                </tr>
            </table>
        </td>
    </tr>
	<?
			}
	?>
    <tr>
        <td align="center" style="padding-top:15px;">
      	<input type="image" src="images/icon_print.png" onclick="window.print();">
        </td>
    </tr>
    <!--<tr>
        <td align="center" style="padding-top:15px;"><input type="image" src="images/icon_print.png" onClick="return popitup('print-investor-summary.php?rs=<?=implode(",",$showResultId)?>&tt=<?=$tMode?>')"></td>
    </tr>-->
</table>
<?
}
?>
</body>
</html>
