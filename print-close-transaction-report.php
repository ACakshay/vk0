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
$frmDateChk =""; $toDateChk =""; $rChk="";
if(isset($_GET["fdt"]) && $_POST["fdt"]!='')
{
	$frmDate = getDateDBFormat(addslashes($_GET["fdt"]));
	$frmDateChk = " and a.TenureFrom>= '".$frmDate."' ";
}
if(isset($_GET["tdt"]) && $_GET["tdt"]!='')
{
	$toDate = getDateDBFormat(addslashes($_GET["tdt"]));
	$toDateChk = " and a.TenureFrom <='".$toDate."' ";
}
$reportOf=$_GET["ro"];
$id=$_GET["id"];

if($reportOf=='Client')
{
	$fReport = "Investor";
	$fChk = "ClientID"; 
	$uName = getClientName($id);
	
}elseif($reportOf=='Investor'){ $fReport = "Client"; $fChk = "InvestorID"; $uName = getInvestorName($id); }elseif($reportOf=='Negotiator'){ 
	 $fChk = "NegotiatorID"; $uName = getNegotiatorName($id);
	}
if($reportOf!='')
{
	$rChk = " and ".$fChk."=".$id." ";
}
$sqldate1="select a.* from tblTransactionMaster a where 1 ".$rChk." and a.isClosed=1 and a.isDelete=0 ";
$sqldate1=$sqldate1." ".$frmDateChk." ".$toDateChk." order by a.TenureFrom ";
$resultdate1=mysql_query($sqldate1) or die ("Query Failed ".mysql_error());
if($no1 = mysql_num_rows($resultdate1)>0)
{
	$flagPost1=1;
}

$sqlExt= "select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where ";
$sqlExt= $sqlExt." a.isClosed=1 and a.isDelete=0 and a.TransactionID=b.TransactionID ".$rChk." ".$frmDateChk."  ";
$sqlExt= $sqlExt." ".$toDateChk." order by a.TenureFrom ";
$resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
if (mysql_num_rows($resultExt)>0){ $flagPost2=1; }

if($flagPost1==0 && $flagPost2==0)
{
	$message= "No Data Available";
}
?>
<?  if($flagPost1==1 || $flagPost2==1){ ?>
<table width="980px" cellpadding="5" cellspacing="0" align="center" style="border:2px solid #CCCCCC;">
	<tr><td align="center" style="padding:10px;"><img src="images/logo1.png" alt="" width="100px"></td></tr>
    <tr><td class="slipHead">Closed Transaction Report</td></tr>
    <tr>
        <td align="center" valign="top">
            <table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            <tr bgcolor="#EFEFEF">
                <td class="heading" height="40px" style="font-size:14px;" width="60%"><? if($reportOf!=''){ ?><?=$reportOf?>  : <?=$uName?><? } ?></td>
                <td class="loginTxt1" style="font-size:16px; text-align:right;"><? if($_GET["fdt"]!='' || $_GET["tdt"]!=''){ ?>Date :  From - <?=$_GET["fdt"]?> To - <?=$_GET["tdt"]?><? } ?></td>
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
				  if($flagPost1==1)
				  {
                    $count=0;
					$i=0;
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
                    <td class="tbl_row"><span style="color:#006600"><?=getDateDBFormat($rowList["TenureFrom"])?> ~ <?=getDateDBFormat($rowList["TenureTo"])?></span></td>
                    <td class="tbl_row"><?=$negotiatorName?></td>
                    <td class="tbl_row"><?=$investorName?></td>
                    <td class="tbl_row"><?=$clientName?></td>
                    <td class="tbl_row"><?=$rowList["TransactionMode"]?></td>
                    <td class="tbl_row"><? echo $rTAmount[$i] = $rTransaction; ?></td>
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
                    <td class="tbl_row"><span style="color:#006600"><?=getDateDBFormat($rowExt["fdt"])?> ~ <?=getDateDBFormat($rowExt["tdt"])?></span></td>
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
<tr>
                    <td align="center" colspan="2" style="padding-top:15px;">
                         <input type="image" src="images/icon_print.png" value="" onClick="window.print();">
                    </td>
                </tr>
</table>
<?
}
?>
 