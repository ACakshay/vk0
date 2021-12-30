<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="inc/style.css">
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style> 
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
<?
$message="";
$flagPost1=0; $flagPost2=0;	
if(isset($_GET["ro"]))
{
	$reportOf=$_GET["ro"];
	$id=$_GET["id"];
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
<?  if($flagPost1==1 || $flagPost2==1){ ?>
<table width="980px" cellpadding="5" cellspacing="0" align="center" style="border:2px solid #CCCCCC;">
	<tr><td align="center" style="padding:10px;"><img src="images/logo1.png" alt="" width="100px"></td></tr>
    <tr><td class="slipHead">TDS Report</td></tr>
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
								//$bankIntPerDay = $bankInt /30;
								//$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
								$bankInt = round(($bankInt * $durationArr[1]));
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
									//$bankIntPerDay = $bankInt /30;
									//$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
									$bankInt = round(($bankInt * $durationArr[1]));
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
								//$bankIntPerDay = $bankInt /30;
								//$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
								$bankInt = round(($bankInt * $durationArr[1]));
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
									//$bankIntPerDay = $bankInt /30;
									//$bankInt = round(($bankInt * $durationArr[1])+($bankIntPerDay*$durationArr[2]));
									$bankInt = round(($bankInt * $durationArr[1]));
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
    <tr>
        <td align="center" style="padding-top:15px;">
             <input type="image" src="images/icon_print.png" value="" onClick="window.print();">
        </td>
    </tr>
</table>
<?	
}
?>
