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
if(isset($_GET['iid']))
{
	$transactionMode =$_GET["tt"];
	if($transactionMode=='Bank')
	{
		$tbl="tblBankTransactionDetails b ";
	}else{ $tbl="tblCashTransactionDetails b"; }
	$sqldate1="select a.*,b.* from tblTransactionMaster a, ".$tbl." where a.TransactionMode = '".$transactionMode."' and  a.TransactionID=b.TransactionID ";
	$sqldate1=$sqldate1." and a.InvestorID ='".$_GET['iid']."' and a.isClosed=0 and a.isDelete=0 and a.isExtended=0 order by a.TenureTo ";
	$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
	if($no1 = mysql_num_rows($resultdate1)>0){ $flagPost1=1; }
	
	$sqlExt= "select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where b.InvestorID ='".$_GET['iid']."' and ";
	$sqlExt= $sqlExt." b.TransactionMode = '".$transactionMode."' and a.isExtended=0 and b.isExtended=1 and a.isClosed=0 and a.isDelete=0 and a.TransactionID=b.TransactionID ";
	$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultExt)>0){ $flagPost2=1; }
	
	if($flagPost1==0 && $flagPost2==0)
	{
		$message= "No Data Available";
	}
}
?>
<?  if($flagPost1==1 || $flagPost2==1){ ?>
<table width="980px" cellpadding="5" cellspacing="0" align="center" style="border:2px solid #CCCCCC;">
	<tr><td align="center" style="padding:10px;"><img src="images/logo1.png" alt="" width="100px"></td></tr>
    <tr><td class="slipHead">Investor Report</td></tr>
    <tr>
        <td align="center" valign="top">
            <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
                <tr bgcolor="#EFEFEF">
                    <td class="heading" height="40px" style="font-size:14px;" width="70%">Investor  : <?=getInvestorName($_GET['iid'])?></td>
                    <td class="loginTxt1" style="font-size:16px; text-align:right;">Mode  : <?=$transactionMode?></td>
                </tr>
                <!--<tr><td height="20px">&nbsp;</td></tr>-->
                <?
                    if($transactionMode=='Bank')
                    {
                ?>
                <tr>
            	<td colspan="2">
                	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                    	<tr>
                        	<td class="tableHead" rowspan="2" width="5%">S.No.</td>
                            <td class="tableHead" rowspan="2" width="15%">Amount</td>
                            <td class="tableHead" rowspan="2" width="20%">Client</td>
                            <td class="tableHead" colspan="2" width="20%">Rate(%)</td>
                            <td class="tableHead" rowspan="2" width="20%">Investor</td>
                            <td class="tableHead" rowspan="2" width="20%">Due Date</td>
                        </tr>
                        <tr>
                        	<td class="tableHead" width="10%">Bank</td>
                            <td class="tableHead" width="10%">Cash</td>
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
                        	<td class="tbl_row"><?=$count?>.<div id="div_1" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:50px; left:225px; z-index:1000; padding: 0px;"></div></td>
                            <td class="tbl_row"><? echo $rowResult["TransactionAmount"]; $rTAmount[$i] = $rTransaction; ?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=$rowResult["InvesBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowResult["InvesCashPercent"]?></td>
                            <td class="tbl_row"><?=$investorName?></td>
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
                        	<td class="tbl_row"><?=$count?>.<div id="div_1" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:50px; left:225px; z-index:1000; padding: 0px;"></div></td>
                            <td class="tbl_row"><? echo $rowExt["TransactionAmount"]; $rTAmount[$i] = $rTransaction; ?></td>
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=$rowExt["InvesBankPercent"]?></td>
                            <td class="tbl_row"><?=$rowExt["InvesCashPercent"]?></td>
                            <td class="tbl_row"><?=$investorName?></td>
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
                            <td class="tbl_row" colspan="5"></td>
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
                            <td class="tableHead" width="20%">Client</td>
                            <td class="tableHead" width="20%">Rate(%)</td>
                            <td class="tableHead" width="20%">Investor</td>
                            <td class="tableHead" width="20%">Due Date</td>
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
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=$rowResult["InvesPercent"]?></td>
                            <td class="tbl_row"><?=$investorName?></td>
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
                            <td class="tbl_row"><?=$clientName?></td>
                            <td class="tbl_row"><?=$rowExt["InvesPercent"]?></td>
                            <td class="tbl_row"><?=$investorName?></td>
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
                           	<td class="tbl_row" colspan="4"></td>
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
    <tr>
        <td align="center" style="padding-top:15px;">
             <input type="image" src="images/icon_print.png" value="" onClick="window.print();">
        </td>
    </tr>
</table>
<?
}
?>
