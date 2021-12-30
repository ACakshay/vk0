<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<? 
if(isset($_POST['btnEditDocument']))
{
	$DocId = $_POST['doc_id'];
	if($_FILES["txtDocsImg1"]["name"] <> "")
	{	
		$sqlFile="select * from tblTransactionDocument where RecID=".$DocId;
		$resultFile = mysql_query ($sqlFile) or die ("Error in  query : ".$sqlFile."<br>".mysql_errno()." : ".mysql_error());
 		if(mysql_num_rows($resultFile)>0)
		{
			$rowFile = mysql_fetch_array($resultFile);
			$file1 = $transactionDocs.$rowFile["DocImage"];
		
			unlink($file1);
	
		}
		$filename = $_FILES["txtDocsImg1"]["name"];
		$file_arr = explode(".", $filename);
		$file_ext = strtolower($file_arr[sizeof($file_arr)-1]);
	
		if($file_ext=='jpg' || $file_ext=='gif' || $file_ext=='bmp' || $file_ext=='jpeg' || $file_ext=='png' )  
		{
			$filename=str_replace(" ","_",$filename);// Add _ inplace of blank space in file name, you can remove this line
			$file=$DocId."_1.".$file_ext;
			$up_file = $transactionDocs.$file;   // upload directory path is set
			if(move_uploaded_file($_FILES['txtDocsImg1']['tmp_name'], $up_file))     //  upload the file to the server
			{
				smart_resize_image($up_file,'700','500','false',$transactionDocs.$file,'false','false');
				//smart_resize_image($up_file,'100','120','false',$FoodImageThumbUploadPath.$file,'false','false');
				$message ='Image Uploaded';
				$sql_insert = "update tblTransactionDocument set DocImage = '".$file."' where RecID= ".$DocId;
				$result_insert = mysql_query($sql_insert) or die("Error in query:".$sql_insert."<br>".mysql_error()."<br>".mysql_errno());
			}
			else
			{
				$message ='error in upload image file';
			}
		}
		else
		{
			$message ='Please upload image file not '.$file_ext;
		}	
	}
	$message="Document Successfully Updated!!";
}
if(isset($_POST["btnDeleteYes"]))
{
	$DocId = $_POST["doc_id"];
	$sqlFile="select * from tblTransactionDocument where RecID=".$DocId;
	$result = mysql_query($sqlFile) or die("Error in query:".$sqlFile."<br>".mysql_error()."<br>".mysql_errno());
	if (mysql_num_rows($result)>0)
		{
			$rowFile = mysql_fetch_array($result);
			if($rowFile["DocImage"]!="")
			{
				$delFile1=$transactionDocs.$rowFile["DocImage"];
				unlink($delFile1);
			}
		}
	$sqlDel = "delete from tblTransactionDocument where RecID =".$DocId;
	$resultDel = mysql_query ($sqlDel) or die ("Error in  query : ".$sqlDel."<br>".mysql_errno()." : ".mysql_error());
	$message="Document Successfully Deleted!!";
}
	$flag=0;
	$message = "";
	$transid=$_GET["tid"];
	$tType=$_GET["tt"];
	$tStatus=$_GET["st"];
	if($tStatus==0)
	{
		if($tType=='Bank'){ $tbl = 'tblBankTransactionDetails'; }else{  $tbl = 'tblCashTransactionDetails'; }
	}elseif($tStatus==1){
		 $tbl = 'tblExtendedTransaction';
	}
	
	$sqlDetails = "select a.*,b.* from tblTransactionMaster a ,".$tbl." b where a.TransactionID=b.TransactionID ";
	$sqlDetails = $sqlDetails." and a.TransactionMode = '".$tType."' and a.TransactionID='".$transid."' ";
    $resultDetails = mysql_query ($sqlDetails) or die ("Error in  query : ".$sqlDetails."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultDetails)>0)
	{
		$flag = 1;
	}
	else{
		$message = "No Record Found";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print | Transaction Detail</title>
<link href="inc/style.css" type="text/css" rel="stylesheet" />
<style type="text/css">
body { margin:0px; padding:0px; }
.slipHead { background:#333333; font-family:Arial, Helvetica, sans-serif; font-size:20px; text-align:center; color:#fff; font-weight:bold; line-height:25px; text-transform:uppercase; }
.txtRight { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#333333; font-weight:normal; padding-right:10px; line-height:25px; }
.txtRight span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#333333; font-weight:bold; padding-right:10px; line-height:25px; }
.txtLeft { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#333333; font-weight:normal; padding-left:10px; line-height:25px; }
.txtLeft span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#333333; font-weight:bold; padding-left:10px; line-height:25px; }
.myTableR { border-collapse:collapse; }
.myTableR td, table.myTableR tr { border:1px solid #cccccc; padding:2px;}
.myTable td, table.myTable tr { border:0px!important; padding:2px;}
</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" bgcolor="#FFFFFF" style="border:1px solid #CCCCCC;">
    <tr>
    	<td align="center" valign="top">
            <div style="padding:5px;"><img src="images/logo1.png" alt="VK" title="VK" width="100" /></div>
            <div class="comp_name">Transaction Details</div>
        </td>
    </tr>
    <tr>
        <td class="message"><?=$message?></td>
    </tr>
	<?
    if($flag==1)
    {
        $rowResult = mysql_fetch_array($resultDetails);
    ?>
    <tr>
    	<td align="center" valign="top">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                <tr>
                    <td width="50%" valign="top" class="txtLeft">Tenure : <span><?=getDateDBFormat($rowResult["TenureFrom"])?> - To - <?=getDateDBFormat($rowResult["TenureTo"])?></span></td>
                    <td width="50%" valign="top" class="txtLeft" style="text-align:right;">Transaction Mode : <span><?=$rowResult["TransactionMode"]?></span></td>
                </tr>
                 <tr>
                    <td class="txtLeft" style="text-align:left;">Transaction Amount : <span><?=$rowResult["TransactionAmount"]?></span></td>
                </tr>
            </table>
        </td>
    </tr>
    <?
		if($tType=='Bank')
		{
	?>
   <tr>
        <td align="center" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                <tr bgcolor="#EFEFEF">
                	<td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" colspan="4"><?=getInvestorName($rowResult["InvestorID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubInvestorID"]!='0'){  ?> ~~ &nbsp;&nbsp;&nbsp;<?=getSubInvestorName($rowResult["SubInvestorID"])?> <? } ?></td>
                </tr>
                <?
					$trsnBankDetails = getBankTransactionMaster($rowResult["TransactionID"]);
				?>
                <tr>
                  	<td class="txtLeft" width="20%">Bank</td>
                    <td class="txtLeft" width="30%"><?=getBankName($trsnBankDetails["InvestorBankID"])?></td>
                  	<td class="txtLeft" width="20%">Cheque/UTR No.</td>
                    <td class="txtLeft" width="30%"><?=$trsnBankDetails["InvestorChequeUTRNo"]?></td>
                </tr>
               	<tr bgcolor="#EFEFEF">
                    <td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" colspan="4"><?=getClientName($rowResult["ClientID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubClientID"]!='0'){  ?> ~~ &nbsp;&nbsp;&nbsp;<?=getSubClientName($rowResult["SubClientID"])?> <? } ?></td>
                </tr>
                <tr>
                	<td colspan="4">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                        <tr>
                             <td class="txtLeft" width="60%" colspan="2">Bank</td>
                             <td class="txtLeft" width="40%">Cheque No.</td>
                        </tr>
                         <tr>
                            <td class="txtLeft" width="20%">Repayment</td>
                            <td class="txtLeft" width="40%"><? $clientBankDetails = getClientBankDetails($rowResult["RepaymentBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                           <td class="txtLeft" width="40%"><?=$rowResult["RepaymentChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="txtLeft">Interest</td>
                            <td class="txtLeft"><? $clientBankDetails = getClientBankDetails($rowResult["InterestBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txtLeft"><?=$rowResult["InterestChequeNo"]?></td>
                        </tr>
                        <tr>
                            <td class="txtLeft">Commission</td>
                            <td class="txtLeft"><? $clientBankDetails = getClientBankDetails($rowResult["CommissionBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                            <td class="txtLeft"><?=$rowResult["CommissionChequeNo"]?></td>
                        </tr>
                      </table>
                    </td>
                </tr>
                <tr bgcolor="#EFEFEF">
                    <td class="txtLeft" colspan="4">Other Details</td>
                </tr>
                <tr>
                	<td colspan="4">
                    	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                            <tr>
                                <td class="txtLeft">Investment %</td>
                                <td class="txtLeft">Finance %</td>
                                <td class="txtLeft">Negotiator %</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">&nbsp;</td>
                                            <td class="txtLeft">Bank %</td>
                                            <td class="txtLeft">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft"><?=$rowResult["InvesPercent"]?></td>
                                            <td class="txtLeft"><?=$rowResult["InvesBankPercent"]?></td>
                                            <td class="txtLeft"><?=$rowResult["InvesCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">&nbsp;</td>
                                            <td class="txtLeft">Bank %</td>
                                            <td class="txtLeft">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft"><?=round($rowResult["FinancePercent"],2)?></td>
                                            <td class="txtLeft"><?=$rowResult["FinanceBankPercent"]?></td>
                                            <td class="txtLeft"><?=$rowResult["FinanceCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="txtLeft">&nbsp;</td>
                                            <td class="txtLeft">Bank %</td>
                                            <td class="txtLeft">Cash %</td>
                                        </tr>
                                        <tr>
                                            <td class="txtLeft"><?=$rowResult["NegotiatorPercent"]?></td>
                                            <td class="txtLeft"><?=$rowResult["NegotiatorBankPercent"]?></td>
                                            <td class="txtLeft"><?=$rowResult["NegotiatorCashPercent"]?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="txtLeft">Investor TDS %</td>
                    <td class="txtLeft"><?=$rowResult["InvestorTDSPercent"]?></td>
                    <td class="txtLeft">Negotiator TDS %</td>
                    <td class="txtLeft"><?=$rowResult["NegotiatorTDSPercent"]?></td>
                </tr>
                 <tr>
                    <td class="txtLeft">Remark</td>
                    <td class="txtLeft" colspan="4"><?=$rowResult["Remark"]?></td>
                </tr>
            </table>
        </td>
    </tr>
    <?
    }else{
	?>
    	<tr>
        <td align="center" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                <tr bgcolor="#EFEFEF">
                    <td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" colspan="4"><?=getInvestorName($rowResult["InvestorID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubInvestorID"]!='0'){  ?> ~~ &nbsp;&nbsp;&nbsp;<?=getSubInvestorName($rowResult["SubInvestorID"])?> <? } ?></td>
                </tr>
                <tr><td height="5px;" colspan="4">&nbsp;</td></tr>
                <tr bgcolor="#EFEFEF">
                    <td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" colspan="4"><?=getClientName($rowResult["ClientID"])?>&nbsp;&nbsp;&nbsp;<? if($rowResult["SubClientID"]!='0'){  ?> ~~ &nbsp;&nbsp;&nbsp;<?=getSubClientName($rowResult["SubClientID"])?> <? } ?></td>
                </tr>
                <tr>
                	<td colspan="4">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                        <tr>
                             <td class="txtLeft" width="60%" colspan="2">Bank</td>
                             <td class="txtLeft" width="40%">Cheque No.</td>
                        </tr>
                         <tr>
                            <td class="txtLeft" width="20%">Repayment</td>
                            <td class="txtLeft" width="40%"><? $clientBankDetails = getClientBankDetails($rowResult["RepaymentBankID"]); echo getBankName($clientBankDetails["BankID"]); ?></td>
                           <td class="txtLeft" width="40%"><?=$rowResult["RepaymentChequeNo"]?></td>
                        </tr>
                      </table>
                    </td>
                </tr>
                <tr bgcolor="#EFEFEF">
                    <td class="txtLeft" colspan="4">Other Details</td>
                </tr>
                <tr>
                	<td colspan="4">
                    	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                            <tr>
                                <td class="txtLeft">Investment %</td>
                                <td class="txtLeft">Finance %</td>
                                <td class="txtLeft">Negotiator %</td>
                            </tr>
                            <tr>
                                <td align="left"><?=$rowResult["InvesPercent"]?></td>
                                <td align="left"><?=$rowResult["FinancePercent"]?></td>
                                <td align="left"><?=$rowResult["NegotiatorPercent"]?></td>
                            </tr>
                            <tr>
                                <td class="txtLeft">Remark</td>
                                <td class="txtLeft" colspan="2"><?=$rowResult["Remark"]?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
             </table>
        </td>
    </tr>
    <?
		}
	?>
    <tr><td height="10px">&nbsp;</td></tr>
    <?
		 $sqlDoc="select * from tblTransactionDocument where TransactionID=".$transid." ";
		 $resultDoc=mysql_query($sqlDoc) or die ("Query Failed ".mysql_error());
		 if (mysql_num_rows($resultDoc)>0)
		 {
	?>
    <tr>
    	<td>
            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
            	<tr><td colspan="4" class="txtLeft"><span>Documents</span></td></tr>
                <tr>
                	<? $count =1; while($rowDoc = mysql_fetch_array($resultDoc)){ ?>
                    <td>
                    	<div id="divTransDocument" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:100%; height:680x; position: fixed; top:0; left:0%; z-index:1000; padding: 0px;"></div>
            			<div id="div_<?=$rowDoc["RecID"]?>">
                        <a href="javascript:;" onClick="document.getElementById('divTransDocument').style.visibility = 'visible'; get_frm('ajxTransDocument.php','<?=$rowDoc["RecID"]?>','divTransDocument')"><img src="<?=$transactionDocsUploadURL?><?=$rowDoc["DocImage"]?>" width="100px" height="100px" border="0" alt="Not Available" title="Doc Image" /></a>
                    	<div>
                        <a href="javascript:;" onClick="document.getElementById('div_<?=$rowDoc["RecID"]?>').style.visibility = 'visible'; get_frm('ajxEditTransDoc.php','<?=$rowDoc["RecID"]?>','div_<?=$rowDoc["RecID"]?>')"><img src="images/iconEdit.gif"/></a> &nbsp; 
                        <a href="javascript:;" onClick="document.getElementById('div_<?=$rowDoc["RecID"]?>').style.visibility = 'visible'; get_frm('ajxDeleteTransDoc.php','<?=$rowDoc["RecID"]?>','div_<?=$rowDoc["RecID"]?>')"><img src="images/iconDelete.gif"/></a>
                        </div>
                    </td>
                    </div>
       				<? $count++;  if($count>4) { echo "<tr bgcolor='#EFEFEF'></tr>"; $count=1;} }?>
                </tr>
            </table>
        </td>
   </tr>
   <?
		}
   ?>
    <tr><td height="7px">&nbsp;</td></tr>
    <tr><td align="center"><a href="#" onClick="window.print();"><img src="images/icon_print.png" border="0" alt="Print" title="Print" /></a></td></tr>
</table>
<?
}
?>
</body>
</html>
