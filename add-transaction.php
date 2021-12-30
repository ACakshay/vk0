<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<link href="auto_sugges/content/styles.css" rel="stylesheet" />
<!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
<!--<script src="js/bootstrap.min.js"></script>
<script src="inc/jquery.js" type="text/javascript"></script>
<script src="inc/img_preview.js" type="text/javascript"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>-->


<!--<script type="text/javascript" src="inc/scripts/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="inc/scripts/jquery.mockjax.js"></script>
<script type="text/javascript" src="inc/scripts/jquery.autocomplete.js"></script>
<script type="text/javascript" src="inc/scripts/countries.js"></script>
<script type="text/javascript" src="inc/scripts/demo.js"></script>-->
<script language="javascript" type="text/javascript">
function popitup(url) {
	newwindow=window.open(url,'name','width=920, height=700, scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>
<style>
.scrollup{
    width:40px;
    height:40px;
    opacity:0.3;
    position:fixed;
    bottom:50px;
    right:50px;
    display:none;
    text-indent:-9999px;
    background: url('images/icon_top.png') no-repeat;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
 
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
</script>
<script src="inc/jquery.js" type="text/javascript"></script>
<script type="text/javascript"> 
$(document).ready(function(){
 
        $(".productDescription").hide();
        $(".show_hide").show();
 
    $('.show_hide').click(function(){
    $(".productDescription").slideToggle();
    return false;
    });
 
});
function validateFormValue(frm) {
   var tmode = document.forms[frm]["txtTransactionMode"].value;
   var bcolor = '#FF0000 groove thin';
   var msg ='alertMsg';
   if((frm =='frmExtendBTransaction') || (frm =='frmExtendCTransaction') || (frm =='frmEditTranscation') || (frm =='frmEEditTranscation')){
   		msg ='alertMsgP';
   }
   if ((tmode == "Bank") || (tmode == "Cash")) {
		if(frm =='frmAddTransaction')
		{
			var tamt = document.forms[frm]["txtTransactionAmount"].value;
			if(isNaN(tamt) || (tamt<=0))
			{
				//document.forms[frm]["txtTransactionAmount"].style.border = bcolor;
				document.getElementById("msgAlert").innerHTML ='<b>Transaction amount should be positive number only!!</b>';
				return false;
		
			}
		}
		 if (tmode == "Bank") {
			var iper = parseFloat(document.forms[frm]["txtInvestmentPer"].value);
			var ibank = parseFloat(document.forms[frm]["txtInvestmentBankPer"].value);
			var icash = parseFloat(document.forms[frm]["txtInvestmentCashPer"].value);
			var itotal = ibank + icash;
			
			var nper = parseFloat(document.forms[frm]["txtNegotiatorPer"].value);
			var nbank = parseFloat(document.forms[frm]["txtNegotiatorBankPer"].value);
			var ncash = parseFloat(document.forms[frm]["txtNegotiatorCashPer"].value);
			var ntotal =  nbank + ncash;
			
			
			var fper =parseFloat(document.forms[frm]["txtFinancePer"].value);
			var fbank = parseFloat(document.forms[frm]["txtFinanceBankPer"].value);
			var fcash = parseFloat(document.forms[frm]["txtFinanceCashPer"].value);
			var ftotal = fbank + fcash;
			
			var itdsper = parseFloat(document.forms[frm]["txtInvestorTDSPer"].value);
			var ntdsper = parseFloat(document.forms[frm]["txtNegotiatorTDSPer"].value);
			
			if(isNaN(iper) || isNaN(ibank) || isNaN(icash) || isNaN(nper) || isNaN(nbank) || isNaN(ncash) || isNaN(fper) || isNaN(fbank) || isNaN(fcash) || isNaN(itdsper) || isNaN(ntdsper)){
				document.getElementById(msg).innerHTML ='<b>All the % value should be positive number only!!</b>';
				return false;	
			}else{
				if(iper <0 || ibank <0 || icash <0 || nper <0 || nbank <0 || ncash <0 || fper <0 || fbank <0 || fcash <0 || itdsper <0 || ntdsper <0){
					document.getElementById(msg).innerHTML ='<b>All the % value should not be negative!!</b>';
					return false;
				}else{
					if(iper != itotal || nper != ntotal || fper != ftotal)
					{
						if(iper != itotal){
							
							document.forms[frm]["txtInvestmentPer"].style.border = bcolor;
							document.forms[frm]["txtInvestmentBankPer"].style.border = bcolor;
							document.forms[frm]["txtInvestmentCashPer"].style.border = bcolor;
						}else if(nper != ntotal){
						
							document.forms[frm]["txtNegotiatorPer"].style.border = bcolor;
							document.forms[frm]["txtNegotiatorBankPer"].style.border = bcolor;
							document.forms[frm]["txtNegotiatorCashPer"].style.border = bcolor;
						}else if(fper != ftotal){
							document.forms[frm]["txtFinancePer"].style.border = bcolor;
							document.forms[frm]["txtFinanceBankPer"].style.border = bcolor;
							document.forms[frm]["txtFinanceCashPer"].style.border = bcolor;
						}
						document.getElementById(msg).innerHTML ='<b>Check the bank and cash %, it should be equal to total %!!</b>';
						return false;
					}
				}
			}
			
		 }else if (tmode == "Cash"){
			var iper = parseFloat(document.forms[frm]["txtInvestmentPer"].value);
			var nper = parseFloat(document.forms[frm]["txtNegotiatorPer"].value);
			var fper = parseFloat(document.forms[frm]["txtFinancePer"].value);
			var pTotal = iper + nper;
			if(isNaN(iper) || isNaN(nper) || isNaN(fper)){
				document.getElementById(msg).innerHTML ='<b>All the % value should be positive number only!!</b>';
				return false;
			}else{
				if(iper <0 || nper <0 || fper <0){
					document.getElementById(msg).innerHTML ='<b>All the % value should not be negative!!</b>';
					return false;
				}else{
					if(pTotal!=fper)
					{
						document.getElementById(msg).innerHTML ='<b>Finanace % should be sum of investment and negotiator % !!</b>';
						return false;
					}
				}
			}
		}
	}
}
</script>
<?
$message="";
$flagChk = 0;
$chq_no ="";
$bank_name="";
function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
   
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}
if(!isset($_SESSION['no_refresh']))
{
	$_SESSION['no_refresh']="";
	$_SESSION['trnas_id']="";
}		
if(isset($_POST["btnAddTransaction"]))
{
	if($_POST['no_refresh']==$_SESSION['no_refresh'])
	{
		$message="<b>WARNNING :</b>Do not refresh the page";
	}else{
	
		$_SESSION['no_refresh'] = $_POST['no_refresh'];
		$fromDate = addslashes($_POST["Fromdate"]);
		$fromDate = getDateDBFormat($fromDate);
		$toDate = addslashes($_POST["Todate"]);
		$toDate = getDateDBFormat($toDate);
		
			
		$transMode = addslashes($_POST["txtTransactionMode"]);
		$sqlAdd="insert into tblTransactionMaster (TransactionMode, TenureFrom, TenureTo,NegotiatorID,InvestorID,SubInvestorID, ClientID, SubClientID, TransactionAmount, Remark) ";
		$sqlAdd= $sqlAdd." values ('".addslashes($_POST["txtTransactionMode"])."', '".$fromDate."', '".$toDate."','".$_POST["txtNegotiator"]."','".$_POST["txtInvestor"]."' ";
		$sqlAdd= $sqlAdd." ,'".$_POST["txtSubInvestor"]."','".$_POST["txtClient"]."', '".$_POST["txtSubClient"]."', '".addslashes($_POST["txtTransactionAmount"])."', ";
		$sqlAdd= $sqlAdd." '".addslashes($_POST["txtRemark"])."') ";
		//$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
		$transID = mysql_insert_id();
		if($admin_usertype==0){ $_SESSION['trnas_id']=$transID; }
		if($transMode=='Bank')
		{
			$clientBankArr = $_POST["txtClientBank"];
			$sqlTrans="insert into tblBankTransactionDetails (TransactionID, InvestorBankID, InvestorChequeUTRNo,RepaymentBankID, ";
			$sqlTrans =$sqlTrans." RepaymentChequeNo, InterestBankID, InterestChequeNo, CommissionBankID, CommissionChequeNo, InvesPercent, ";
			$sqlTrans =$sqlTrans." InvesBankPercent,InvesCashPercent, FinancePercent, FinanceBankPercent, FinanceCashPercent, NegotiatorPercent, ";
			$sqlTrans =$sqlTrans." NegotiatorBankPercent, NegotiatorCashPercent,InvestorTDSPercent, NegotiatorTDSPercent) values ('".$transID."' ";
			$sqlTrans =$sqlTrans." ,'".addslashes($_POST["txtInvestorBank"])."','".addslashes($_POST["txtInvestorChequeUTR"])."', ";
			$sqlTrans =$sqlTrans." '".addslashes($clientBankArr[0])."', '".addslashes($_POST["txtRepaymentChequeNo"])."', ";
			$sqlTrans =$sqlTrans." '".addslashes($clientBankArr[1])."','".addslashes($_POST["txtInterestChequeNo"])."',";
			$sqlTrans =$sqlTrans." '".addslashes($clientBankArr[2])."','".addslashes($_POST["txtCommissionChequeNo"])."' ";
			$sqlTrans =$sqlTrans." ,'".addslashes($_POST["txtInvestmentPer"])."','".addslashes($_POST["txtInvestmentBankPer"])."' ";
			$sqlTrans =$sqlTrans." ,'".addslashes($_POST["txtInvestmentCashPer"])."', '".addslashes($_POST["txtFinancePer"])."', ";
			$sqlTrans =$sqlTrans." '".addslashes($_POST["txtFinanceBankPer"])."' , '".addslashes($_POST["txtFinanceCashPer"])."', ";
			$sqlTrans =$sqlTrans." '".addslashes($_POST["txtNegotiatorPer"])."','".addslashes($_POST["txtNegotiatorBankPer"])."', ";
			$sqlTrans =$sqlTrans." '".addslashes($_POST["txtNegotiatorCashPer"])."' , '".addslashes($_POST["txtInvestorTDSPer"])."', ";
			$sqlTrans =$sqlTrans." '".addslashes($_POST["txtNegotiatorTDSPer"])."') ";
			//$resultTrans = mysql_query ($sqlTrans) or die ("Error in  query : ".$sqlTrans."<br>".mysql_errno()." : ".mysql_error());
		}else{
			$sqlTransC="insert into tblCashTransactionDetails (TransactionID, RepaymentBankID, RepaymentChequeNo,InvesPercent, ";
			$sqlTransC =$sqlTransC." FinancePercent, NegotiatorPercent) values ('".$transID."', '".$_POST["txtClientBank"]."', ";
			$sqlTransC =$sqlTransC." '".addslashes($_POST["txtRepaymentChequeNo"])."', '".addslashes($_POST["txtInvestmentPer"])."' ";
			$sqlTransC =$sqlTransC." , '".addslashes($_POST["txtFinancePer"])."','".addslashes($_POST["txtNegotiatorPer"])."') ";
			//$resultTransC = mysql_query ($sqlTransC) or die ("Error in  query : ".$sqlTransC."<br>".mysql_errno()." : ".mysql_error());
		}
		$message="Transaction Added Successfully!!";
	}
}
if(isset($_POST["btnEditTranscation"]))
{
	$transId = $_POST["TransactionID"];
	$transMode = $_POST["txtTransactionMode"];
	$sqlEdit="update tblTransactionMaster set TenureFrom='".getDateDBFormat($_POST["txtTenureFromE"])."', TenureTo='".getDateDBFormat($_POST["txtTenureToE"])."', ";
	$sqlEdit=$sqlEdit." NegotiatorID='".$_POST["txtNegotiatorE"]."', InvestorID='".$_POST["txtInvestorE"]."', SubInvestorID='".$_POST["txtSubInvestorE"]."',";
	$sqlEdit=$sqlEdit." ClientID='".$_POST["txtClientE"]."', SubClientID='".$_POST["txtSubClientE"]."', TransactionAmount='".addslashes($_POST["txtTransactionAmount"])."',";
	$sqlEdit=$sqlEdit." Remark='".addslashes($_POST["txtRemarkE"])."'  where TransactionID  = ".$transId;
	//$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
	if($transMode=='Bank')
	{
		$sqlDetails=" update tblBankTransactionDetails set InvestorBankID='".$_POST["txtInvestorBankE"]."',InvestorChequeUTRNo =";
		$sqlDetails=$sqlDetails." '".addslashes($_POST["txtInvesChequeNoE"])."' , RepaymentBankID ='".$_POST["txtRepaymentBankE"]."', ";
		$sqlDetails=$sqlDetails." RepaymentChequeNo='".addslashes($_POST["txtRepaymentChequeNoE"])."', InterestBankID='".$_POST["txtInterestBankE"]."', ";
		$sqlDetails=$sqlDetails." InterestChequeNo='".addslashes($_POST["txtInterestChequeNoE"])."', CommissionBankID='".$_POST["txtCommissionBankE"]."', ";
		$sqlDetails=$sqlDetails." CommissionChequeNo='".addslashes($_POST["txtCommissionChequeNoE"])."', InvesPercent= ";
		$sqlDetails=$sqlDetails." '".addslashes($_POST["txtInvestmentPer"])."', InvesBankPercent='".addslashes($_POST["txtInvestmentBankPer"])."', ";
		$sqlDetails=$sqlDetails." InvesCashPercent='".addslashes($_POST["txtInvestmentCashPer"])."', FinancePercent='".addslashes($_POST["txtFinancePer"])."' ";
		$sqlDetails=$sqlDetails." , FinanceBankPercent='".addslashes($_POST["txtFinanceBankPer"])."', FinanceCashPercent='".addslashes($_POST["txtFinanceCashPer"])."' ";
		$sqlDetails=$sqlDetails." , NegotiatorPercent='".addslashes($_POST["txtNegotiatorPer"])."', NegotiatorBankPercent='".addslashes($_POST["txtNegotiatorBankPer"])."' ";
		$sqlDetails=$sqlDetails." , NegotiatorCashPercent='".addslashes($_POST["txtNegotiatorCashPer"])."', InvestorTDSPercent= ";
		$sqlDetails=$sqlDetails." '".addslashes($_POST["txtInvestorTDSPer"])."', NegotiatorTDSPercent='".addslashes($_POST["txtNegotiatorTDSPer"])."' ";
		$sqlDetails=$sqlDetails." where TransactionID= ".$transId;
		//$resultDetails = mysql_query ($sqlDetails) or die ("Error in  query : ".$sqlDetails."<br>".mysql_errno()." : ".mysql_error());
			
	}else{ 
		$sqlDetails=" update tblCashTransactionDetails set RepaymentBankID='".$_POST["txtRepaymentBankE"]."',RepaymentChequeNo =";
		$sqlDetails=$sqlDetails." '".addslashes($_POST["txtRepaymentChequeNoE"])."', InvesPercent ='".addslashes($_POST["txtInvestmentPer"])."',";
		$sqlDetails=$sqlDetails." FinancePercent ='".addslashes($_POST["txtFinancePer"])."', NegotiatorPercent='".addslashes($_POST["txtNegotiatorPer"])."' ";
		$sqlDetails=$sqlDetails." where TransactionID= ".$transId;;
		//$resultDetails = mysql_query ($sqlDetails) or die ("Error in  query : ".$sqlDetails."<br>".mysql_errno()." : ".mysql_error());
	}
 	$message="Transaction Successfully Edited!!";
}
if(isset($_POST["btnEditExtendTranscation"]))
{
	$recid = $_POST["txtRecID"];
	$transMode = $_POST["txtTransactionMode"];
	if($transMode=='Bank')
	{
		$sqlDetails=" update tblExtendedTransaction set TenureFrom='".getDateDBFormat($_POST["txtTenureFromE"])."',TenureTo= ";
		$sqlDetails=$sqlDetails." '".getDateDBFormat($_POST["txtTenureToE"])."' , RepaymentBankID ='".$_POST["txtRepaymentBankE"]."', ";
		$sqlDetails=$sqlDetails." RepaymentChequeNo='".addslashes($_POST["txtRepaymentChequeNoE"])."', InterestBankID='".$_POST["txtInterestBankE"]."', ";
		$sqlDetails=$sqlDetails." InterestChequeNo='".addslashes($_POST["txtInterestChequeNoE"])."', CommissionBankID='".$_POST["txtCommissionBankE"]."', ";
		$sqlDetails=$sqlDetails." CommissionChequeNo='".addslashes($_POST["txtCommissionChequeNoE"])."', InvesPercent= ";
		$sqlDetails=$sqlDetails." '".addslashes($_POST["txtInvestmentPer"])."', InvesBankPercent='".addslashes($_POST["txtInvestmentBankPer"])."', ";
		$sqlDetails=$sqlDetails." InvesCashPercent='".addslashes($_POST["txtInvestmentCashPer"])."', FinancePercent='".addslashes($_POST["txtFinancePer"])."' ";
		$sqlDetails=$sqlDetails." , FinanceBankPercent='".addslashes($_POST["txtFinanceBankPer"])."', FinanceCashPercent='".addslashes($_POST["txtFinanceCashPer"])."' ";
		$sqlDetails=$sqlDetails." , NegotiatorPercent='".addslashes($_POST["txtNegotiatorPer"])."', NegotiatorBankPercent='".addslashes($_POST["txtNegotiatorBankPer"])."' ";
		$sqlDetails=$sqlDetails." , NegotiatorCashPercent='".addslashes($_POST["txtNegotiatorCashPer"])."', InvestorTDSPercent= ";
		$sqlDetails=$sqlDetails." '".addslashes($_POST["txtInvestorTDSPer"])."', NegotiatorTDSPercent='".addslashes($_POST["txtNegotiatorTDSPer"])."' ";
		$sqlDetails=$sqlDetails." where RecID= ".$recid;
			
	}else{ 
	
		$sqlDetails=" update tblExtendedTransaction set TenureFrom='".getDateDBFormat($_POST["txtTenureFromE"])."',TenureTo ='".getDateDBFormat($_POST["txtTenureToE"])."', ";
		$sqlDetails=$sqlDetails." RepaymentBankID ='".addslashes($_POST["txtRepaymentBankE"])."', RepaymentChequeNo='".addslashes($_POST["txtRepaymentChequeNoE"])."',  ";
		$sqlDetails=$sqlDetails." InvesPercent='".addslashes($_POST["txtInvestmentPer"])."', FinancePercent='".addslashes($_POST["txtFinancePer"])."', ";
		$sqlDetails=$sqlDetails." NegotiatorPercent='".addslashes($_POST["txtNegotiatorPer"])."' where RecID= ".$recid;;
	}
	//$resultDetails = mysql_query ($sqlDetails) or die ("Error in  query : ".$sqlDetails."<br>".mysql_errno()." : ".mysql_error());
 	$message="Transaction Successfully Edited!!";
}
if(isset($_POST["btnDeleteYes"]))
{
	$rec_id = $_POST["InvestmentId"];
	$sqlDel = "delete from tblInvestmentMaster where InvestmentID = ".$rec_id;
	$resultDel = mysql_query ($sqlDel) or die ("Error in  query : ".$sqlDel."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["InvestmentName"]."</b> successfully Deleted!!";
}
if(isset($_POST["btnAddDocs"]))
{
	$trnsId = $_POST["txtTransId"];
	$docArr = $_FILES["txtDocsImg"];
	$trnsType = $_POST["txtTransType"];
	if(!empty($docArr))
 	{
		$img_desc = reArrayFiles($docArr);
		$i=0;
		foreach($img_desc as $val)
		{
			if($val["size"]>0)
			{
					$file_arr = explode(".", $val["name"]);
					$file_ext = strtolower($file_arr[sizeof($file_arr)-1]);
					if($file_ext=='jpg' || $file_ext=='gif' || $file_ext=='bmp' || $file_ext=='jpeg' || $file_ext=='png')  
					{
						$sqlC="select COUNT(RecID) as lID from tblTransactionDocument where TransactionID=".$trnsId;
						$resultC = mysql_query($sqlC) or die("Error in query:".$sqlC."<br>".mysql_error()."<br>".mysql_errno());
						if (mysql_num_rows($resultC)>0)
						{
							$rowC = mysql_fetch_array($resultC);
							$lastRec = $rowC["lID"];
							if($lastRec == 0){ $lastRec = 1; }
						}
						$file=$lastRec."_".$trnsId.".".$file_ext;
						$up_file = $transactionDocs.$file;   // upload directory path is set
						if (move_uploaded_file($val['tmp_name'],$up_file))//  upload the file to the server
						{
							smart_resize_image($up_file,'700','550','false',$transactionDocs.$file,'false','false');
							//smart_resize_image($up_file,'200','100','false',$EventThumbImageUploadPath.$file,'false','false');
							$Msg ='Image Uploaded';
							$sql_insert = "insert into tblTransactionDocument(TransactionID,DocImage) values('".$trnsId."','".$file."') ";
							$result_insert = mysql_query($sql_insert) or die("Error in query:".$sql_insert."<br>".mysql_error()."<br>".mysql_errno());
						}else{ $message ='error in upload image file'; }
					
					}
					else
					{
						$message ='Please upload image file not '.$file_ext;
					}
			  }
			
		}
		$message ='Document uploaded successfully!!';
	}
}
if(isset($_POST["btnReturnOnDate"]))
{
	$rec_id = $_POST["InvestmentId"];
	$return_on_date = $_POST["txtReturnOnDate"];
	$sqlUpdate = "update tblInvestmentMaster set ReturnOnDate = '".$return_on_date."', isReturned = '1' where InvestmentID='".$rec_id."' ";
	$resultUpdate = mysql_query ($sqlUpdate) or die ("Error in  query : ".$sqlUpdate."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["InvestorName"]."</b> successfully updated!!";
}
if(isset($_POST['btnCloseTrans']))
{
	$transStatus = $_POST["txtTransactionStatus"];
	if(isset($_POST['txtIsClose']))
	{
		$whereChk = "";
		if($transStatus=='0'){
			$tbl = "tblTransactionMaster";
		}else{ 
			$tbl = "tblExtendedTransaction";
			$whereChk = " and RecID='".$transStatus."' "; 	
		}
		
		$sqlUp=" update ".$tbl." set isClosed='".$_POST['txtIsClose']."' where TransactionID  = ".$_POST['txtTransactionID']." ".$whereChk." ";
		$resultUp = mysql_query ($sqlUp) or die ("Error in  query : ".$sqlUp."<br>".mysql_errno()." : ".mysql_error());
		$message="Transaction closed successfully!!";
	}
	
}
if(isset($_POST['btnAddRemark']))
{
	$trnsStatus = $_POST["txtTransactionStatus"];
	$where="";
	if($trnsStatus==0){ $tbl ="tblTransactionMaster"; }else{ $tbl ="tblExtendedTransaction";  $where = "and RecID='".$trnsStatus."' "; }
	$sqlRe=" update ".$tbl." set Remark='".$_POST["txtRemark"]."' where TransactionID  = ".$_POST['txtTransactionID']." ".$where." ";
	$resultRe = mysql_query ($sqlRe) or die ("Error in  query : ".$sqlRe."<br>".mysql_errno()." : ".mysql_error());
	$message="Remark added successfully!!";
}
if(isset($_POST["btnExtendTrans"]))
{
	$transID = $_POST["txtTransactionID"];
	$transMode = $_POST["txtTransactionMode"];
	$transStatus = $_POST["txtTransStatus"];
	
	$whereChk = "";
	if($transStatus=='0'){
		$tbl = "tblTransactionMaster";
	}else{ 
		$tbl = "tblExtendedTransaction";
		$whereChk = " and RecID='".$transStatus."' "; 	
	}
	$rTFrom = addslashes($_POST["txtRenewalTenureFrm"]);
	$rTFrom = getDateDBFormat($rTFrom);
	$rTTo = addslashes($_POST["txtRenewalTenureTo"]);
	$rTTo = getDateDBFormat($rTTo);
	if($transMode=='Bank')
	{
		$sqlET= "insert into tblExtendedTransaction (TransactionID, TenureFrom, TenureTo, RepaymentBankID, RepaymentChequeNo, InterestBankID, InterestChequeNo,CommissionBankID, CommissionChequeNo, InvesPercent, InvesBankPercent, InvesCashPercent, FinancePercent, FinanceBankPercent, FinanceCashPercent, NegotiatorPercent, NegotiatorBankPercent, NegotiatorCashPercent, InvestorTDSPercent, NegotiatorTDSPercent) values('".$transID."', '".$rTFrom."', '".$rTTo."', '".$_POST['txtClientReBank']."', '".addslashes($_POST["txtRepaymentChequeNoE"])."', '".addslashes($_POST["txtClientInBank"])."', '".addslashes($_POST["txtInterestChequeNoE"])."', '".addslashes($_POST["txtClientComBank"])."', '".addslashes($_POST["txtCommissionChequeNoE"])."', '".addslashes($_POST["txtInvestmentPer"])."', '".addslashes($_POST["txtInvestmentBankPer"])."', '".addslashes($_POST["txtInvestmentCashPer"])."', '".addslashes($_POST["txtFinancePer"])."', '".addslashes($_POST["txtFinanceBankPer"])."', '".addslashes($_POST["txtFinanceCashPer"])."', '".addslashes($_POST["txtNegotiatorPer"])."', '".addslashes($_POST["txtNegotiatorBankPer"])."', '".addslashes($_POST["txtNegotiatorCashPer"])."', '".addslashes($_POST["txtInvestorTDSPer"])."', '".addslashes($_POST["txtNegotiatorTDSPer"])."')";
		//$resultET = mysql_query ($sqlET) or die ("Error in query : ".$sqlET."<br>".mysql_errno()." : ".mysql_error());
		$recid = mysql_insert_id();
		if($admin_usertype==0){ $_SESSION['extended_id']=$recid; }
	}else{
		$sqlECT= "insert into tblExtendedTransaction (TransactionID, TenureFrom, TenureTo, RepaymentBankID, RepaymentChequeNo, InvesPercent ,FinancePercent , NegotiatorPercent) values ('".$transID."', '".$rTFrom."', '".$rTTo."' ,'".$_POST['txtClientReBank']."', '".addslashes($_POST["txtRepaymentChequeNoE"])."', '".addslashes($_POST["txtInvestmentPer"])."','".addslashes($_POST["txtFinancePer"])."', '".addslashes($_POST["txtNegotiatorPer"])."') ";
		//$resultECT = mysql_query ($sqlECT) or die ("Error in query : ".$sqlECT."<br>".mysql_errno()." : ".mysql_error());
	}
	$sqlUpdate = "update ".$tbl." set isExtended = '1' where TransactionID='".$transID."' ".$whereChk." ";
	//$resultUpdate = mysql_query ($sqlUpdate) or die ("Error in  query : ".$sqlUpdate."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>Transaction</b> successfully Extended!!";
}
if(isset($_POST["btnDeleteTranscation"]))
{
	$trans_id = $_POST["TransactionID"];
	$transStatus = $_POST["txtTransStatus"];
	if($transStatus==0)
	{
		$tbl ="tblTransactionMaster";
		$where = " and TransactionID ='".$trans_id."' ";
		
	}else{ $tbl="tblExtendedTransaction"; $where = " and RecID ='".$transStatus."' "; }
	
	$sqlDel="update ".$tbl." set isDelete='1' where 1 ".$where." ";
	$resultDel = mysql_query ($sqlDel) or die ("Error in  query : ".$sqlDel."<br>".mysql_errno()." : ".mysql_error());
 	$message="Record Successfully Deleted!!";
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Add Transaction</td></tr>
	<tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Add Transaction</td>
                </tr>
                <tr><td class="message" align="center"><div id="alertMsg"><?=$message?></div></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <form id="frmAddTransaction" name="frmAddTransaction" method="post" onsubmit="return validateFormValue(this.name);" enctype="multipart/form-data">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                           <tr>
                                <td valign="top" class="login_head_bg"><div class="blue_bg" style="float:left;">Add Transaction</div>
                                <div style="text-align:right;"><input type="submit" name="addNewQue" id="addNewQue" value="Add Transaction" class="show_hide button_big" /></div>
                                </td>
                            </tr>
                           <tr>
                                <td align="center" valign="top">
                                <div class="productDescription">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                 <tr>
                                <td class="Txt11" width="40%"><b>Tenure&nbsp;:</b>&nbsp;From <input type="text" name="Fromdate" id="Fromdate" autocomplete="off" style="width:100px;" required />&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmAddTransaction.Fromdate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To <input type="text" autocomplete="off" name="Todate" id="Todate" style="width:100px;" required/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmAddTransaction.Todate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                <td class="Txt11" width="32%"><b>Transaction Mode&nbsp;:</b>&nbsp;<input type="radio" name="txtTransactionMode" id="txtTransactionMode" value="Bank" onchange="get_frm('ajxPaymentMode.php',this.value,'TransMode');" checked="checked" />Bank
                                <input type="radio" name="txtTransactionMode" id="txtTransactionMode" onchange="get_frm('ajxPaymentMode.php',this.value,'TransMode');" value="Cash" />Cash
                                </td>
                                <td class="Txt11" width="28%"><b>Transaction Amount &nbsp;:</b>&nbsp;<input type="text" name="txtTransactionAmount" style="width:130px;" id="txtTransactionAmount" autocomplete="off" required /><br/><span id="msgAlert" class="message"></span></td>
                            </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR" id="TransMode">
                        <tr>
                            <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Negotiator</td>
                        </tr>
                        <tr>
                            <td width="10%" class="loginTxt1">Name</td>
                            <td width="90%" colspan="5">
                            <select name="txtNegotiator" id="txtNegotiator" required style="width:130px;"> 
                                     <option value="">Select</option>
                                     <?
                                       $sqlN="select * from tblNegotiatorMaster $where order by NegotiatorName";
                                       $resultN = mysql_query ($sqlN) or die ("Error in  query : ".$sqlN."<br>".mysql_errno()." : ".mysql_error());
                                        if(mysql_num_rows($resultN)>0)
                                        {
                                            while($rowN = mysql_fetch_array($resultN))
                                            {
                                ?>
                                            <option value="<?=$rowN["NegotiatorID"]?>" ><?=$rowN["NegotiatorName"]?></option>
                                     <? } } ?>
                                  </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Investor</td>
                        </tr>
                        <tr>
                            <td width="10%" class="loginTxt1">Name</td>
                            <td width="90%" colspan="5">
                            <select name="txtInvestor" id="txtInvestor" required style="width:130px;" onchange="get_frm('ajxGetSubInvestor.php',this.value,'investorInfo');"> 
                                     <option value="">Select</option>
                                     <?
                                        $sqlInves ="select * from tblInvestorMaster order by InvestorName";
                                        $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                                        if(mysql_num_rows($resultInves)>0)
                                        {
                                            while($rowInves = mysql_fetch_array($resultInves))
                                            {
                                ?>
                                            <option value="<?=$rowInves["InvestorID"]?>" ><?=$rowInves["InvestorName"]?></option>
                                     <? } } ?>
                                  </select>
                            </td>
                        </tr>
                        <tr id="investorInfo">
                           <td class="loginTxt1" width="12%">Sub Investor</td>
                            <td align="left" width="25%">
                                <select name="txtSubInvestor" id="txtSubInvestor" style="width:130px;" disabled="disabled"> 
                                     <option value="">Select</option>
                                     </select>
                            </td>	
                            <td class="loginTxt1" width="12%">Bank</td>
                            <td align="left" width="20%">
                                 <select name="txtInvestorBank" id="txtInvestorBank" style="width:130px;" >
                                    <option value="">Select</option>
                                 </select>
                            </td>
                            <td class="loginTxt1" width="11%">Cheque/UTR No.</td>
                            <td align="left" width="20%">
                                <input type="text" style="width:130px;" name="txtInvestorChequeUTR" id="txtInvestorChequeUTR" disabled="disabled" />
                            </td>	
                       </tr>
                        <tr>
                            <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Client</td>
                        </tr>
                         <tr>
                            <td width="10%" class="loginTxt1">Name</td>
                            <td colspan="5" width="90%">
                            <select name="txtClient" id="txtClient" style="width:130px;" onchange="get_frm('ajxGetClientDetails.php',this.value,'clientDetails');" required > 										<option value="">Select</option>
                                    <?
                                     $sqlInves ="select * from tblClientMaster order by ClientName";
                                    $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                                    if(mysql_num_rows($resultInves)>0)
                                    {
                                        while($rowInves = mysql_fetch_array($resultInves))
                                        {
                                    ?>
                                        <option value="<?=$rowInves["ClientID"]?>" ><?=$rowInves["ClientName"]?></option>
                                    <? 
                                        }
                                    }
                                    ?>
                            </select>
                            </td>
                        </tr>
                         <tr id="clientBank">
                            <td class="loginTxt1" width="100%" colspan="6">
                                <div id="clientDetails">
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                        <tr>
                                            <td class="loginTxt1" width="12%">Sub Client</td>
                                            <td align="left" width="88%" colspan="5">
                                                <select name="txtSubClient" id="txtSubClient" style="width:130px;" disabled="disabled">
                                                    <option value="">Select Sub Clients</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="loginTxt1" width="12%">Re-payment Bank</td>
                                            <td align="left" width="25%">
                                                <div id="divClientBank">
                                                    <select name="txtClientBank[]" id="txtClientBank" style="width:130px;" disabled="disabled">
                                                            <option value="">--Select Bank--</option>
                                                    </select>
                                                </div>
                                            </td>	
                                            <td class="loginTxt1" width="12%">Interest Bank</td>
                                            <td align="left" width="20%">
                                              <div id="divClientBank1">
                                              
                                                    <select name="txtClientBank[]" id="txtClientBank1" style="width:130px;" disabled="disabled" required>
                                                            <option value="">--Select Bank--</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="loginTxt1" width="11%">Commission Bank</td>
                                            <td align="left" width="20%">
                                                <div id="divClientBank2">
                                                    <select name="txtClientBank[]" id="txtClientBank2" style="width:130px;" disabled="disabled" required>
                                                            <option value="">--Select Bank--</option>
                                                    </select>
                                                </div>
                                            </td>	
                                        </tr>
                                   </table>
                               </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="loginTxt1" width="12%">Cheque No./UTR No.</td>
                            <td align="left" width="25%"><input name="txtRepaymentChequeNo" id="txtRepaymentChequeNo" style="width:130px;" type="text" autocomplete="off" required /></td>
                            <td class="loginTxt1" width="12%">Cheque No./UTR No.</td>
                            <td align="left" width="20%">
                                <input name="txtInterestChequeNo" id="txtInterestChequeNo" style="width:130px;" type="text" autocomplete="off" />
                            </td>
                                  
                            <td class="loginTxt1" width="11%">Cheque No./UTR No.</td>
                            <td align="left" width="20%"><input name="txtCommissionChequeNo" id="txtCommissionChequeNo" style="width:130px;" type="text" autocomplete="off" /></td>
                        </tr>
                       <tr>
                            <td style="line-height:15px; background:#F1F1F1; font-weight:500; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="6">Other Details</td>
                        </tr>
                        <tr>
                             <td class="loginTxt1" width="12%">Investment %</td>
                             <td align="left" width="25%">
                                <input type="text" style="width:25%;" value="0" name="txtInvestmentPer" id="txtInvestmentPer" autocomplete="off" required  onchange="			
                                var diff = parseFloat(document.getElementById('txtNegotiatorPer').value) + parseFloat(this.value);
                                document.getElementById('txtFinancePer').value= parseFloat(diff).toFixed(2); " />
                                &nbsp; <input type="text" value="0" name="txtInvestmentBankPer" id="txtInvestmentBankPer" autocomplete="off" required placeholder="Bank %" style="width:25%;" onchange="
                                var iSum = parseFloat(document.getElementById('txtNegotiatorBankPer').value) +  parseFloat(this.value);
                                document.getElementById('txtFinanceBankPer').value=parseFloat(iSum).toFixed(2);"/>
                                &nbsp;<input type="text" value="0" name="txtInvestmentCashPer" id="txtInvestmentCashPer" autocomplete="off"  required placeholder="Cash %" style="width:25%;" onchange="
                                var cSum = parseFloat(document.getElementById('txtNegotiatorCashPer').value) + parseFloat(this.value);
                                document.getElementById('txtFinanceCashPer').value=parseFloat(cSum).toFixed(2);" /> 
                                
                            </td>
                            <td class="loginTxt1" width="12%">Negotiator %</td>
                            <td align="left" width="20%"><input type="text" value="0" style="width:25%;" name="txtNegotiatorPer" id="txtNegotiatorPer" autocomplete="off"  onchange="
                            var nSum = parseFloat(document.getElementById('txtInvestmentPer').value) + parseFloat(this.value);
                             document.getElementById('txtFinancePer').value= parseFloat(nSum).toFixed(2);" />
                             &nbsp; <input type="text" name="txtNegotiatorBankPer" value="0" id="txtNegotiatorBankPer" autocomplete="off" required placeholder="Bank %" style="width:25%;" onchange="
                             var nbSum = parseFloat(document.getElementById('txtInvestmentBankPer').value) + parseFloat(this.value);
                             document.getElementById('txtFinanceBankPer').value= parseFloat(nbSum).toFixed(2);"/>
                             &nbsp; <input type="text" value="0" name="txtNegotiatorCashPer" id="txtNegotiatorCashPer" autocomplete="off"  required placeholder="Cash %" style="width:25%;" onchange="
                            var ncSum = parseFloat(document.getElementById('txtInvestmentCashPer').value) + parseFloat(this.value);
                            document.getElementById('txtFinanceCashPer').value=parseFloat(ncSum).toFixed(2); " /> 
                            
                            </td>
                            <td class="loginTxt1" width="11%">Finance %</td>
                            <td align="left" width="20%"><input type="text" name="txtFinancePer" readonly="readonly" value="0" style="width:25%;" id="txtFinancePer" autocomplete="off" required />
                            &nbsp; <input type="text" value="0" name="txtFinanceBankPer" id="txtFinanceBankPer" readonly="readonly" autocomplete="off" required placeholder="Bank %" style="width:25%" /> 
                            &nbsp; <input type="text" value="0" name="txtFinanceCashPer" id="txtFinanceCashPer" readonly="readonly" autocomplete="off"  required placeholder="Cash %" style="width:25%;" /> 
                           </td>	
                        </tr>
                        <tr>
                             <td class="loginTxt1">Investor TDS %</td>
                             <td align="left">
                                <input type="text" style="width:130px;" value="0" name="txtInvestorTDSPer" id="txtInvestorTDSPer" autocomplete="off" />
                                
                            </td>
                            <td class="loginTxt1">Negotiator TDS %</td>
                            <td align="left" colspan="3"><input type="text" value="0" style="width:130px;" name="txtNegotiatorTDSPer" id="txtNegotiatorTDSPer" autocomplete="off" />
                            </td>
                        </tr>
                </table>
                            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                <tr>
                                    <td align="center" colspan="10">
                                        <input type="hidden" name="no_refresh" id="no_refresh" value="<? echo uniqid(rand()); ?>" />
                                        <input type="submit" id="btnAddTransaction" name="btnAddTransaction" value="Submit" class="button" />
                                        <input type="submit" name="btnCanel" id="btnCanel" value="Cancel" onclick="form.reset()" class="show_hide button" />
                                    </td>
                                </tr>
                            </table>
                            </div>
                                </td>
                            </tr>
                        </table>
                        </form>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <?
				$chk =" order by TransactionID DESC ";
				if(isset($_SESSION['no_refresh']) && $admin_usertype==0)
				{
					$chk=" and TransactionID ='".$_SESSION['trnas_id']."' ";
				}
				$sqlList="select * from tblTransactionMaster where isClosed=0 and isExtended=0 and isDelete=0 ".$chk." ";
				$resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
				if (mysql_num_rows($resultList)>0)
				{
				?>
                 <tr>
                    <td align="center" valign="top">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                            <tr bgcolor="#EFEFEF">
                                <td class="tableHead" width="5%" colspan="2"><b>S. No.</b></td>
                                <td class="tableHead" width="13%"><b>Tenure</b></td>
                                <td class="tableHead" width="10%"><b>Negotiator</b></td>
                                <td class="tableHead" width="13%"><b>Investor</b></td>
                                <td class="tableHead" width="13%"><b>Client</b></td>
                                <td class="tableHead" width="8%"><b>Mode</b></td>
                                <td class="tableHead" width="10%"><b>Amount</b></td>
                                <td class="tableHead" width="8%"><b>Extend/Close</b></td>
                                <td class="tableHead" width="12%"><b>Document/Remark</b></td>
                                <td class="tableHead" width="8%"><b>Edit/Delete</b></td>
                            </tr>
                            <?
                                $count=0;
                                $todaydate = date('Y-m-d');
                                //$tdate = date('Y-m-d', strtotime($todaydate . ' - 7 day'));
                                while($rowList = mysql_fetch_array($resultList))
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
                                <td class="tbl_row"><a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TransactionID"]?>').style.visibility = 'visible'; get_frm4(<? if($rowList["TransactionMode"]=='Bank'){ ?>'extend_bank_transaction.php'<? }else{  ?>'extend_cash_transaction.php'<? } ?>,'<?=$rowList["TransactionID"]?>','div_<?=$rowList["TransactionID"]?>','0')">Ext</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TransactionID"]?>').style.visibility = 'visible'; get_frm4('close_transaction.php','<?=$rowList["TransactionID"]?>','div_<?=$rowList["TransactionID"]?>','0')">Close</a></td>
                                <td class="tbl_row"><a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TransactionID"]?>').style.visibility = 'visible'; get_frm('add-doc-images.php','<?=$rowList["TransactionID"]?>','div_<?=$rowList["TransactionID"]?>')"><!--<img src="images/icoPlus.png" border="0" alt="Add Documents Images" title="Add Documents Images"/>-->Attach</a>&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;<a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TransactionID"]?>').style.visibility = 'visible'; get_frm4('add_transaction_remark.php','<?=$rowList["TransactionID"]?>','div_<?=$rowList["TransactionID"]?>','0')">Remark</a></td>
                                <td class="tbl_row" bgcolor="#EFEFEF"><a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TransactionID"]?>').style.visibility = 'visible'; get_frm('edit-transcation.php','<?=$rowList["TransactionID"]?>','div_<?=$rowList["TransactionID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Transaction Details" title="Edit Transaction Details"/></a>&nbsp;&nbsp;<a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TransactionID"]?>').style.visibility = 'visible'; get_frm4('delete-transcation.php','<?=$rowList["TransactionID"]?>','div_<?=$rowList["TransactionID"]?>','0')"><img src="images/iconDelete.gif" border="0" alt="Delete Transaction Details" title="Delete Transaction Details"/></a></td>
                           </tr>
                <?	
                    
                    }
                    $whereChk = " and a.isClosed=0 and a.isExtended=0 and b.isExtended=1 and a.isDelete=0 and a.TransactionID=b.TransactionID ";
                    if(isset($_SESSION['extended_id']) && $admin_usertype==0)
                    {
                        $whereChk = " and a.RecID='".$_SESSION['extended_id']."' ";
                    }
                    $sqlExt="select a.*,b.*,a.TenureFrom as fdt,a.TenureTo as tdt from tblExtendedTransaction a , tblTransactionMaster b where 1 ".$whereChk." ";
                    $resultExt=mysql_query($sqlExt) or die ("Query Failed ".mysql_error());
                    if (mysql_num_rows($resultExt)>0)
                    {
                ?>
                <tr><td class="form_txt" colspan="11"><b>Extended</b></td></tr>
                <?
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
                    <tr <? if($rowExt["TenureTo"]<=$todaydate){ ?>bgcolor="#CFD8E1"<? } ?>>
                        <td class="tbl_row" colspan="2"><?=$count?>.<div id="div_<?=$rowExt["RecID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:80%; height:65%; position:fixed; top:10%; left:10%; margin-left:auto; margin-right:auto; z-index:1000; padding: 0px;"></div></td>											
                        <td class="tbl_row"><a href="#" onClick="return popitup('transaction_details.php?tid=<?=$rowExt["TransactionID"]?>&tt=<?=$rowExt["TransactionMode"]?>&st=<?=$rowExt["isExtended"]?>')"><b><span style="color:#006600"><?=getDateDBFormat($rowExt["fdt"])?> ~ <?=getDateDBFormat($rowExt["tdt"])?></span></b></a></td>
                        <td class="tbl_row"><?=$negotiatorName?></td>
                        <td class="tbl_row"><?=$investorName?></td>
                        <td class="tbl_row"><?=$clientName?></td>
                        <td class="tbl_row"><?=$rowExt["TransactionMode"]?></td>
                        <td class="tbl_row"><?=$rowExt["TransactionAmount"]?></td>
                        <td class="tbl_row"><a href="javascript:;" onClick="document.getElementById('div_<?=$rowExt["RecID"]?>').style.visibility = 'visible'; get_frm4(<? if($rowExt["TransactionMode"]=='Bank'){ ?>'extend_bank_transaction.php'<? }else{  ?>'extend_cash_transaction.php'<? } ?>,'<?=$rowExt["TransactionID"]?>','div_<?=$rowExt["RecID"]?>','<?=$rowExt["RecID"]?>')">Ext</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="javascript:;" onClick="document.getElementById('div_<?=$rowExt["RecID"]?>').style.visibility = 'visible'; get_frm4('close_transaction.php','<?=$rowExt["TransactionID"]?>','div_<?=$rowExt["RecID"]?>','<?=$rowExt["RecID"]?>')">Close</a></td>
                        <td class="tbl_row"><a href="javascript:;" onClick="document.getElementById('div_<?=$rowExt["RecID"]?>').style.visibility = 'visible'; get_frm('add-doc-images.php','<?=$rowExt["TransactionID"]?>','div_<?=$rowExt["RecID"]?>')"><!--<img src="images/icoPlus.png" border="0" alt="Add Documents Images" title="Add Documents Images"/>-->Attach</a>&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;<a href="javascript:;" onClick="document.getElementById('div_<?=$rowExt["RecID"]?>').style.visibility = 'visible'; get_frm4('add_transaction_remark.php','<?=$rowExt["TransactionID"]?>','div_<?=$rowExt["RecID"]?>','<?=$rowExt["RecID"]?>')">Remark</a></td>
                        <td class="tbl_row" bgcolor="#EFEFEF"><a href="javascript:;" onClick="document.getElementById('div_<?=$rowExt["RecID"]?>').style.visibility = 'visible'; get_frm('edit-extend-transcation.php','<?=$rowExt["RecID"]?>','div_<?=$rowExt["RecID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Transaction Details" title="Edit Transaction Details"/></a>&nbsp;&nbsp;<a href="javascript:;" onClick="document.getElementById('div_<?=$rowExt["RecID"]?>').style.visibility = 'visible'; get_frm4('delete-transcation.php','<?=$rowExt["TransactionID"]?>','div_<?=$rowExt["RecID"]?>','<?=$rowExt["RecID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Transaction Details" title="Delete Transaction Details"/></a></td>
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