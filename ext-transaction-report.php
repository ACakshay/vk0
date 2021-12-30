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
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Extended(Old) Transaction Report</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Reports &nbsp;&raquo;&nbsp; <b>Extended(Old) Transaction</b></td>
                </tr>
                <tr><td class="message" align="center"><?=$message?></td></tr>
                <tr><td height="5px;">&nbsp;</td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                            	<td align="center" valign="top">
                                    <form id="frmExtTransaction" name="frmExtTransaction" method="post">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                   	<tr>
                                    	 <td class="loginTxt" width="15%">Date</td>
                                         <td align="left" width="35%" class="txt12">From <input type="text" name="Fromdate" id="Fromdate" autocomplete="off" style="width:100px;" />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtTransaction.Fromdate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To <input type="text" autocomplete="off" name="Todate" id="Todate" style="width:100px;" >&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmExtTransaction.Todate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>
                                         </td>
                                         <td class="loginTxt" width="15%">Mode</td>
                                         <td align="left" width="35%" class="txt12">
                                         <input type="radio" name="txtTransactionMode" id="txtTransactionMode" value="Bank" checked="checked"  />&nbsp; Bank
                                         <input type="radio" name="txtTransactionMode" id="txtTransactionMode" value="Cash"  />&nbsp; Cash
                                          </td>
                                          </tr>
                                          <tr>
                                          <td colspan="4" align="center">
                                          	&nbsp;&nbsp;&nbsp;<input type="submit" id="btnGetReport" name="btnGetReport" value="Submit" class="button"/>
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
    <tr><td height="5px;">&nbsp;</td></tr>
	<? 
		$frmDateChk =""; $toDateChk =""; $tModeChk="";
		if(isset($_POST["btnGetReport"]))
		{
			
			$tModeChk = " and TransactionMode ='".$_POST["txtTransactionMode"]."' ";
			if(isset($_POST["Fromdate"]) && $_POST["Fromdate"]!='')
			{
				$frmDate=getDateDBFormat($_POST['Fromdate']); 
				$frmDateChk =" and a.TenureFrom >='".$frmDate."' ";
			}
			if(isset($_POST["Todate"]) && $_POST["Todate"]!='')
			{
				$toDate=getDateDBFormat($_POST['Todate']);
				$toDateChk =" and a.TenureFrom <='".$toDate."' ";
			}
		} 
        $sql="select a.* from tblTransactionMaster a where a.isClosed=0 and a.isDelete=0 and a.isExtended=1 ".$tModeChk." ".$frmDateChk." ".$toDateChk." ";
        $result=mysql_query($sql) or die ("Query Failed ".mysql_error());
        if (mysql_num_rows($result)>0)
        {
        
    ?>
  <tr>
    <td align="center" valign="top">
        <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
           <tr>
            	<td>
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" width="5%"><b>S. No.</b></td>
                            <td class="tableHead" width="21%"><b>Tenure</b></td>
                            <td class="tableHead" width="15%"><b>Negotiator</b></td>
                            <td class="tableHead" width="18%"><b>Investor</b></td>
                            <td class="tableHead" width="18%"><b>Client</b></td>
                            <td class="tableHead" width="8%"><b>Mode</b></td>
                            <td class="tableHead" width="15%"><b>Amount</b></td>
                        </tr>
                       <?
					  
							$count=0;
							$i=0;
							 while($row = mysql_fetch_array($result))
                        	 {
						 	$negotiatorName = getNegotiatorName($row["NegotiatorID"]);
							$clientId = $row["ClientID"];
							$clientName = getClientName($clientId);
							if($row["SubClientID"]!='0')
							{
								$clientId = $row["SubClientID"];
								$clientName = getSubClientName($clientId);
							}
							$investorID = $row["InvestorID"];
							$investorName = getInvestorName($investorID);
							if($row["SubInvestorID"]!='0')
							{
								$investorID = $row["SubInvestorID"];
								$investorName = getSubInvestorName($investorID);
							}
                            $count++;
						?>
                        <tr>
                            <td class="tbl_row"><?=$count?>.<div id="div_<?=$row["RecID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                            <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$row["TransactionID"]?>&tt=<?=$row["TransactionMode"]?>&st=0')"><b><span style="color:#006600"><?=getDateDBFormat($row["TenureFrom"])?> ~ <?=getDateDBFormat($row["TenureTo"])?></span></b></a></td>
                            <td class="tbl_row"><?=$negotiatorName?></td>
                            <td class="tbl_row"><?=$investorName?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=$row["TransactionMode"]?></td>
                            <td class="tbl_row"><?=$row["TransactionAmount"]?></td>
                        </tr>
                        <?
						}
					$sqlExt="select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where ";
					$sqlExt=$sqlExt." 1 and a.isClosed=0 and a.isDelete=0 and a.isExtended=1 and b.isClosed=0 and b.isDelete=0 ";
					$sqlExt=$sqlExt." and a.TransactionID=b.TransactionID ".$tModeChk." ".$frmDateChk." ".$toDateChk." ";
					$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
					if (mysql_num_rows($resultExt)>0)
					{
						 while($rowExt = mysql_fetch_array($resultExt))
						 {
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
						$count++;
					?>
                    <tr>
                        <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowExt["RecID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                        <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowExt["TransactionID"]?>&tt=<?=$rowExt["TransactionMode"]?>&st=1')"><b><span style="color:#006600"><?=getDateDBFormat($rowExt["fdt"])?> ~ <?=getDateDBFormat($rowExt["tdt"])?></span></b></a></td>
                        <td class="tbl_row"><?=$negotiatorName?></td>
                        <td class="tbl_row"><?=$investorName?></td>
                        <td class="tbl_row"><?=$clientName?></td>
                        <td class="tbl_row"><?=$rowExt["TransactionMode"]?></td>
                        <td class="tbl_row"><?=$rowExt["TransactionAmount"]?></td>
                    </tr>	
                    <?
						}
					}
					?>    
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>

<? }
 ?>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>