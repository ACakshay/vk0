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
	$sqldate1="select a.*,b.* from tblTransactionMaster a, tblTransactionDetails b where a.TransactionID=b.TransactionID";
	$sqldate1= $sqldate1." and a.ClientID ='".$clientId."' "	;
		 
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
	<tr><td class="pgHead">Client Summary</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Summary &nbsp;&raquo;&nbsp; <b>Client Summary</b></td>
                </tr>
                <tr><td class="message" align="center"><?=$message?></td></tr>
                <tr><td height="5px;">&nbsp;</td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                            	<td align="center" valign="top">
                                    <form id="frmClientSummary" name="frmClientSummary" method="post">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                   
                                        <tr>
                                        <td class="loginTxt" width="40%">Client</td>
                                        <td align="left" width="60%" class="txt12">
										
                                        <select name="txtClient" id="txtClient" style="width:160px;" required > 
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
                                                    <option value="<?=$rowInves["ClientID"]?>" style="padding-left:15px;">&nbsp;<?=$rowInves["ClientName"]?></option><? } } } ?>
                                         </select>
                                         
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
                <td class="heading" height="40px" style="font-size:14px;" width="70%">Client  : <?=getClientName($clientId)?></td>
                <td class="loginTxt1" style="font-size:16px;">Total Amount  : <?=$clientTrans["tSum"]?></td>
            </tr>
            <tr><td height="20px">&nbsp;</td></tr>
            <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" width="15%">S.No.</td>
                            <td class="tableHead" width="25%">Due Date</td>
                            <td class="tableHead" width="25%">Investor</td>
                            <td class="tableHead" width="20%">Amount</td>
                            <td class="tableHead" width="15%">Interest(%)</td>
                        </tr>
                       <?
							$count=1;
							$i=0;
							while($rowResult = mysql_fetch_array($resultdate1))
							{
								$frmDate = getDateNormalFormat($rowResult["TenureFrom"]);
								$toDate = getDateNormalFormat($rowResult["TenureTo"]);
						?>
                        <tr>
                        	<td class="tbl_row"><?=$count?>.<div id="div_1" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:50px; left:225px; z-index:1000; padding: 0px;"></div></td>
                            <td class="tbl_row"><span style="color:#006600"><b><?=$toDate?></b></span></td>
                            <td class="tbl_row"><?=getInvestorName($rowResult["InvestorID"])?></td>
                            <td class="tbl_row"><? echo $trnsAmtRow[$i] = $rowResult["TransactionAmount"]; ?></td>
                            <td class="tbl_row"><?=$rowResult["FinancePercent"]?></td>
                        </tr>
                       <?		
							$i++; $count++;
							}
						?>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr><td height="10px">&nbsp;</td></tr>
<tr><td valign="top" height="5px">&nbsp;</td></tr>
<tr><td height="7px">&nbsp;</td></tr>
<tr><td align="center"><a href="javascript(void);" onClick="return popitup('print-client-summary.php?cid=<?=$clientId?>')"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a></td></tr>
<? } ?>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>