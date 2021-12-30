<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
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
$message=""; $flag1=0; $flag2=0;
if(isset($_POST["btnTransSummary"]))
{
	$frmDateChk =""; $toDateChk ="";
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
	$sql ="select a.* from tblTransactionMaster a where 1 and a.isClosed=0 and a.isDelete=0 and a.isExtended=0 ".$frmDateChk." ".$toDateChk." ";
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if($no1 = mysql_num_rows($result)>0){ $flag1=1; }
	$whereChk = " and a.isExtended=0 and b.isExtended=1 and a.isClosed=0 and a.isDelete=0 and a.TransactionID=b.TransactionID ";
	if(isset($_SESSION['extended_id']) && $admin_usertype==0)
	{
		$whereChk = " and a.RecID='".$_SESSION['extended_id']."' ";
	}
	$sqlExt= "select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where 1 ";
	$sqlExt= $sqlExt." ".$whereChk." ".$frmDateChk." ".$toDateChk." ";
	$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultExt)>0){ $flag2=1; }
	if($flag1==0 && $flag2==0)
	{
		$message= "No Data Available";
	}
}

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Transaction Summary</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Summary &nbsp;&raquo;&nbsp; <b>Transaction Summary</b></td>
                </tr>
                <tr><td class="message" align="center"><?=$message?></td></tr>
                <tr><td height="5px;">&nbsp;</td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                            	<td align="center" valign="top">
                                    <form id="frmTrnsSummary" name="frmTrnsSummary" method="post">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                   	<tr>
                                    	<td align="center">Date&nbsp;&nbsp;From <input type="text" name="Fromdate" id="Fromdate" autocomplete="off" style="width:100px;" />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmTrnsSummary.Fromdate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To <input type="text" autocomplete="off" name="Todate" id="Todate" style="width:100px;" >&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmTrnsSummary.Todate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;
                                         </td>
                                     </tr>
                                      <tr>
                                          <td align="center">
                                            &nbsp;&nbsp;&nbsp;<input type="submit" id="btnTransSummary" name="btnTransSummary" value="Submit" class="button"/>
                                          </td>
                                      </tr>
									</table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td height="5px;">&nbsp;</td></tr>
                 <?  if($flag1==1 || $flag2==1){ ?>
                <tr>
                    <td align="center" valign="top">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                       		<tr bgcolor="#EFEFEF">
                                <td class="tableHead" width="5%" colspan="2"><b>S. No.</b></td>
                                <td class="tableHead" width="20%"><b>Tenure</b></td>
                                <td class="tableHead" width="15%"><b>Negotiator</b></td>
                                <td class="tableHead" width="15%"><b>Investor</b></td>
                                <td class="tableHead" width="15%"><b>Client</b></td>
                                <td class="tableHead" width="15%"><b>Mode</b></td>
                                <td class="tableHead" width="15%"><b>Amount</b></td>
                            </tr>
                            <?
								
							if($flag1==1)
							{
								$count=0;
                                $todaydate = date('Y-m-d');
                                while($rowList = mysql_fetch_array($result))
                                {
                                  
									 	$count++;
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
                            <tr <? if($rowList["TenureTo"]<=$todaydate){ ?>bgcolor="#CFD8E1"<? } ?>>
                                <td class="tbl_row" colspan="2"><?=$count?>.<div id="div_<?=$rowList["TransactionID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                                <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowList["TransactionID"]?>&tt=<?=$rowList["TransactionMode"]?>&st=<?=$rowList["isExtended"]?>')"><b><span style="color:#006600"><?=getDateDBFormat($rowList["TenureFrom"])?> ~ <?=getDateDBFormat($rowList["TenureTo"])?></span></b></a></td>
                                <td class="tbl_row"><?=$negotiatorName?></td>
                                <td class="tbl_row"><?=$investorName?></td>
                                <td class="tbl_row"><?=$clientName?></td>
                                <td class="tbl_row"><?=$rowList["TransactionMode"]?></td>
                                <td class="tbl_row"><?=$rowList["TransactionAmount"]?></td>
                           </tr>
                <?	
                    	}
					}
                   	if($flag2==1)
					{
                ?>
                <tr><td class="form_txt" colspan="11"><b>Extended</b></td></tr>
                <?
                         while($rowExt = mysql_fetch_array($resultExt))
                         {
                            $count++;
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
                    <tr <? if($rowExt["fdt"]<=$todaydate){ ?>bgcolor="#CFD8E1"<? } ?>>
                        <td class="tbl_row" colspan="2"><?=$count?>.<div id="div_<?=$rowExt["RecID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                        <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowExt["TransactionID"]?>&tt=<?=$rowExt["TransactionMode"]?>&st=<?=$rowExt["isExtended"]?>')"><b><span style="color:#006600"><?=getDateDBFormat($rowExt["fdt"])?> ~ <?=getDateDBFormat($rowExt["tdt"])?></span></b></a></td>
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
		  <?
          }
          ?>
         </table>
    </td>
</tr>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>