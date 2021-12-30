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
$frmDateChk =""; $toDateChk =""; $rChk="";
if(isset($_POST["btnSubmit"]))
{
	if(isset($_POST["Fromdate"]) && $_POST["Fromdate"]!='')
	{
		$frmDate = getDateDBFormat(addslashes($_POST["Fromdate"]));
		$frmDateChk = " and a.TenureFrom>= '".$frmDate."' ";
	}
	if(isset($_POST["Todate"]) && $_POST["Todate"]!='')
	{
		$toDate = getDateDBFormat(addslashes($_POST["Todate"]));
		$toDateChk = " and a.TenureFrom <='".$toDate."' ";
	}
	$reportOf=$_POST["txtReportOf"];
	$id=$_POST["txtDetails"];
	
	if($reportOf=='Client')
	{
		//$fReport = "Investor";
		$fChk = "ClientID"; $uName = getClientName($id);
	}elseif($reportOf=='Investor'){
	 //$fReport = "Client";
	 $fChk = "InvestorID"; $uName = getInvestorName($id); 
	}elseif($reportOf=='Negotiator'){ 
	 $fChk = "NegotiatorID"; $uName = getNegotiatorName($id);
	}
	if($reportOf!='')
	{
		$rChk = " and ".$fChk."=".$id." ";
	}
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Closed Transaction Report</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Reports &nbsp;&raquo;&nbsp; <b>Closed Transaction Report</b></td>
                </tr>
                <tr><td class="message" align="center"><?=$message?></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                            	<td align="center" valign="top">
                                    <form id="frmClosedTransReport" name="frmClosedTransReport" method="post">
                                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                            <tr>
                                            	<td class="loginTxt" width="10%">Date</td>
                                                <td align="left" width="30%">
                                            	From <input type="text" name="Fromdate" id="Fromdate" autocomplete="off" style="width:100px;" />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmClosedTransReport.Fromdate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To <input type="text" autocomplete="off" name="Todate" id="Todate" style="width:100px;" >&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmClosedTransReport.Todate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;
                                                </td>
                                                <td class="loginTxt" width="10%">Report Of</td>
                                                <td align="left" width="20%">
                                                    <select name="txtReportOf" id="txtReportOf" style="width:150px;" onchange="get_frm('ajxGetReportOf.php',this.value,'rResult');">
                                                    	<option value="">Select</option> 
                                                        <option value="Client">Client</option>
                                                        <option value="Investor">Investor</option>  
                                                        <option value="Negotiator">Negotiator</option>                                            
                                                    </select>
                                                </td>
                                                <td align="left" width="30%" id="rResult"><input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" class="button"/></td>
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
	$sqldate1="select a.* from tblTransactionMaster a where 1 ".$rChk." and a.isClosed=1 and a.isDelete=0 ";
	$sqldate1=$sqldate1." ".$frmDateChk." ".$toDateChk." order by a.TenureFrom ";
	$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
	if($no1 = mysql_num_rows($resultdate1)>0)
	{
?>
<tr>
    <td align="center" valign="top">
        <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            <tr bgcolor="#EFEFEF">
                <td class="heading" height="40px" style="font-size:14px;" width="60%"><? if($reportOf!=''){ ?><?=$reportOf?>  : <?=$uName?><? } ?></td>
                <td class="loginTxt1" style="font-size:16px; text-align:right;"><? if($frmDate!='' || $toDate!=''){ ?>Date  :  From - <?=$frmDate?> To - <?=$toDate?><? } ?></td>
            </tr>
            <tr><td height="20px">&nbsp;</td></tr>
           <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" width="5%"><b>S. No.</b></td>
                            <td class="tableHead" width="20%"><b>Tenure</b></td>
                            <td class="tableHead" width="15%"><b>Negotiator</b></td>
                            <td class="tableHead" width="15%"><b>Investor</b></td>
                            <td class="tableHead" width="15%"><b>Client</b></td>
                            <td class="tableHead" width="15%"><b>Mode</b></td>
                            <td class="tableHead" width="15%"><b>Amount</b></td>
                        </tr>
                  <?
				  	$count=0; $i=0;
					while($rowList = mysql_fetch_array($resultdate1))
                    {
						$count++;
						$rTransaction=str_replace(",","",$rowList["TransactionAmount"]);
				   		$negotiatorName = getNegotiatorName($rowList["NegotiatorID"]);
						$clientId = $rowList["ClientID"];
						$clientName = getClientName($clientId);
						if($rowList["SubClientID"]!='0')
						{
							$clientId = $rowList["SubClientID"];
							$clientName = getSubClientName($clientId);
						}
						$investorID = $rowList["InvestorID"];
						$investorName = getInvestorName($investorID);
						if($rowList["SubInvestorID"]!='0')
						{
							$investorID = $rowList["SubInvestorID"];
							$investorName = getSubInvestorName($investorID);
						}
				 ?>
                <tr>
                    <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowList["TransactionID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                    <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowList["TransactionID"]?>&tt=<?=$rowList["TransactionMode"]?>&st=<?=$rowList["isExtended"]?>')"><b><span style="color:#006600"><?=getDateDBFormat($rowList["TenureFrom"])?> ~ <?=getDateDBFormat($rowList["TenureTo"])?></span></b></a></td>
                    <td class="tbl_row"><?=$negotiatorName?></td>
                    <td class="tbl_row"><?=$investorName?></td>
                    <td class="tbl_row"><?=$clientName?></td>
                    <td class="tbl_row"><?=$rowList["TransactionMode"]?></td>
                    <td class="tbl_row"><? echo $rTAmount[$i] = $rTransaction; ?></td>
               </tr>
   			 <?	
					$i++;        
       			 	}
					$sqlExt= "select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where ";
					$sqlExt= $sqlExt." a.isClosed=1 and a.isDelete=0 and a.TransactionID=b.TransactionID ".$rChk." ".$frmDateChk."  ";
					$sqlExt= $sqlExt." ".$toDateChk." order by a.TenureFrom ";
					$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
					if (mysql_num_rows($resultExt)>0)
					{
						while($rowExt = mysql_fetch_array($resultExt))
                     	{
							$count++;
							$rTransaction=str_replace(",","",$rowExt["TransactionAmount"]);
							$negotiatorName = getNegotiatorName($rowExt["NegotiatorID"]);
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
				?>
                <tr>
                    <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowExt["TransactionID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                    <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowExt["TransactionID"]?>&tt=<?=$rowExt["TransactionMode"]?>&st=<?=$rowExt["isExtended"]?>')"><b><span style="color:#006600"><?=getDateDBFormat($rowExt["fdt"])?> ~ <?=getDateDBFormat($rowExt["tdt"])?></span></b></a></td>
                    <td class="tbl_row"><?=$negotiatorName?></td>
                    <td class="tbl_row"><?=$investorName?></td>
                    <td class="tbl_row"><?=$clientName?></td>
                    <td class="tbl_row"><?=$rowExt["TransactionMode"]?></td>
                    <td class="tbl_row"><? echo $rTAmount[$i] = $rTransaction; ?></td>
               </tr>
               <?
			   				$i++;
						}
					}
			   ?>
                
                 <tr>
                    <td align="right" colspan="6"><b>Total</b></td>
                    <td class="tbl_row"><span style="color:#006600; font-size:18px;"><?=array_sum($rTAmount)?></span></td>
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
<a href="#" onClick="return popitup('print-close-transaction-report.php?fdt=<?=$_POST["Fromdate"]?>&tdt=<?=$_POST["Todate"]?>&ro=<?=$reportOf?>&id=<?=$id?>')"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a>
</td></tr>
<? } ?>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>