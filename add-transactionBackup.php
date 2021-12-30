<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<script src="inc/jquery.js" type="text/javascript"></script>
<script src="inc/img_preview.js" type="text/javascript"></script>
<script src="inc/jquery.min.js" type="text/javascript"></script>
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
function validateTakeInvestmentForm() {
   
	var p = document.forms["frmtakeInvestment"]["txtInvestorName"].value;
	var q = document.forms["frmtakeInvestment"]["txtIsCheque"].value;
	var r = document.forms["frmtakeInvestment"]["txtChequeNo"].value;
	var s = document.forms["frmtakeInvestment"]["txtBankName"].value;
	var t = document.forms["frmtakeInvestment"]["investmentdate"].value;
	var u = document.forms["frmtakeInvestment"]["txtPercent"].value; 
	var v = document.forms["frmtakeInvestment"]["txtInvestmentAmount"].value;
	var w = document.forms["frmtakeInvestment"]["returndate"].value; 
	var objErrSpan = document.getElementById('alertMsg');
	if (p == null || p == "" || t == null || t == "" || u == null || u == "" || v == null || v == "" || w == null || w == "" )
	{
		var objErrSpan = document.getElementById('alertMsg');
        objErrSpan.innerHTML= 'Please fill out all the fields';
        objErrSpan.style.color='red';
        objErrSpan.style.visibility='visible';
        return false;
	}
	if(q == null || q == "")
	{
		if(r == null || r == "" || s == null || s == "")
		{
			var objErrSpan = document.getElementById('alertMsg');
        	objErrSpan.innerHTML= 'Please fill out all the fields';
        	objErrSpan.style.color='red';
        	objErrSpan.style.visibility='visible';
        	return false;
		}
	}
}
</script>
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
</script>
<?
$message="";
$flagChk = 0;
$chq_no ="";
$bank_name="";

if(isset($_POST["btnReturnOnDate"]))
{
	$rec_id = $_POST["InvestmentId"];
	$return_on_date = $_POST["txtReturnOnDate"];
	
	$sqlUpdate = "update tblInvestmentMaster set ReturnOnDate = '".$return_on_date."', isReturned = '1' where InvestmentID='".$rec_id."' ";
	$resultUpdate = mysql_query ($sqlUpdate) or die ("Error in  query : ".$sqlUpdate."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["InvestorName"]."</b> successfully updated!!";
}

if(isset($_POST["btnTakeInvestment"]))
{
	if(isset($_POST["txtChequeNo"])){$chq_no = addslashes($_POST["txtChequeNo"]);}
	if(isset($_POST["txtBankName"])){$bank_name = addslashes($_POST["txtBankName"]); }
	$sqlAdd="insert into tblInvestmentMaster (InvestorID, Amount, InvestmentDate, Percent, ChequeNo, BankID, ReturnDate) values ('".addslashes($_POST["txtInvestorName"])."', '".addslashes($_POST["txtInvestmentAmount"])."', ";
	$sqlAdd=$sqlAdd . " '".addslashes($_POST["investmentdate"])."', '".addslashes($_POST["txtPercent"])."', '".$chq_no."', '".$bank_name."', '".addslashes($_POST["returndate"])."') ";
	$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
	$rec_id = mysql_insert_id();
	$message="Investment added Successfully!!";
}
if(isset($_POST["btnEditInvestment"]))
{
	$rec_id = $_POST["investmentId"];
	$sqlEdit="update tblInvestmentMaster set InvestorID='".addslashes($_POST["txtInvestorName1"])."', Amount='".addslashes($_POST["txtAmount1"])."', InvestmentDate='".addslashes($_POST["InvestmentDate1"])."', ";
	$sqlEdit= $sqlEdit . " Percent='".addslashes($_POST["txtPercent1"])."', ChequeNo='".addslashes($_POST["txtChequeNo1"])."', BankID='".addslashes($_POST["txtBankName1"])."',  ReturnDate='".addslashes($_POST["ReturnDate1"])."' where InvestmentID = ".$rec_id;
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="Record Successfully Edited!!";
}
if(isset($_POST["btnDeleteYes"]))
{
	$rec_id = $_POST["InvestmentId"];
	$sqlDel = "delete from tblInvestmentMaster where InvestmentID = ".$rec_id;
	$resultDel = mysql_query ($sqlDel) or die ("Error in  query : ".$sqlDel."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["InvestmentName"]."</b> successfully Deleted!!";
}
?>
<form id="frmtakeInvestment" name="frmtakeInvestment" method="post" enctype="multipart/form-data">
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
                                        	<tr><td class="header_shadow" colspan="8" style="font-weight:600">Investment Info</td></tr>
                                            <tr>
                                                <td class="loginTxt">Duration</td>
                                                <td align="left" valign="top" colspan="7">From : &nbsp; &nbsp;<input type="text" name="Fromdate" id="Fromdate" style="width:150px;"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmtakeInvestment.Fromdate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To : &nbsp;<input type="text" name="Todate" id="Todate" style="width:150px;"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmtakeInvestment.Todate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="loginTxt">Investor</td>
                                                <td align="left">
                                                <?
													$sqlInves ="select * from tblInvestorMaster where isActive='0'";
													$resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
													if(mysql_num_rows($resultInves)>0)
													{
												?>
                                                	<select name="txtInvestorName" id="txtInvestorName" style="width:150px;" > 
                                    					 <option value="">-- Select Investor --</option>
                                                         	<?
                                                            while($rowInves = mysql_fetch_array($resultInves))
                                                            {
															?>
                                                            	<? if($rowInves["InvestorHead"]=='0'){ $inves_id = $rowInves["InvestorID"] ;?>
                                                        		<option value="<?=$rowInves["InvestorID"]?>" ><?=$rowInves["InvestorName"]?></option>
                                                                 <? }if($rowInves["InvestorHead"]!='0' && $rowInves["InvestorHead"]==$inves_id){?>
                                                                <option value="<?=$rowInves["InvestorID"]?>" style="padding-left:15px;">&nbsp;<?=$rowInves["InvestorName"]?></option><? } } ?>
                                                      </select>
												  <?
                                                    }
                                                  ?>
                                               </td>
                                             	<td class="loginTxt">Payment Mode</td>
                                                <td align="left" valign="top">
                                                <input type="radio" name="txtIsCheque" id="txtIsCheque" value="1" onchange="get_frm('ajxBank.php',this.value,'BankDiv');" />Cheque 
                                                <input type="radio" name="txtIsCheque" id="txtIsCheque" value="0" onchange="get_frm('ajxBank.php',this.value,'BankDiv');"  />Cash
                                                <input type="radio" name="txtIsCheque" id="txtIsCheque" value="0" onchange="get_frm('ajxBank.php',this.value,'BankDiv');"  />RTGS/NEFT
                                                </td>
                                               <td class="loginTxt">Bank</td>
                                               <td align="left" valign="top"><div id="BankDiv"><input name="txtBankName" id="txtBankName" type="text" disabled="disabled" /></div></td>
                                               <td class="loginTxt">Cheque No.</td>
                                               <td align="left" valign="top"><div id="chqDiv"><input name="txtChequeNo" id="txtChequeNo" type="text" disabled="disabled" /></div></td>
                                            </tr>
                                             <tr>
                                             	<td class="loginTxt">Percentage Of Investment</td>
                                                <td align="left" valign="top"><input type="text" name="txtPercent" id="txtPercent" /></td>
                                                <td class="loginTxt">Investment Amount</td>
                                                <td align="left" valign="top"><input name="txtInvestmentAmount" id="txtInvestmentAmount" type="text" value="" />
                                          </tr>
                                            <tr><td class="header_shadow" colspan="8"><b>Finance Info</b></td></tr>
                                            <tr>
                                              <td class="loginTxt">Investor</td>
                                              <td align="left" valign="top">
                                              <?
                                                $invesId= getInvestorFromInvestment();
                                                $sqlInves ="select investor.*,investment.* from  tblInvestmentMaster as investment INNER JOIN tblInvestorMaster as investor  ";
                                                $sqlInves = $sqlInves."ON investment.InvestorID=investor.InvestorID where investor.InvestorHead='0' ";
                                                $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                                                if(mysql_num_rows($resultInves)>0)
                                                {
                                                
                                              ?>
                                                <select name="txtInvestment" id="txtInvestment" style="width:150px;" onchange="get_frm('ajxInvestorInvestedAmount.php',this.value,'invDiv');">
                                                  <option value="">Select</option>
                                                  <? 
                                                    while($rowInves = mysql_fetch_array($resultInves)){
                                                  ?>
                                                  <option value="<?=$rowInves["InvestmentID"]?>"><?=getInvestorName($rowInves["InvestorID"])?></option>
                                                  <?
                                                    }
                                                  ?>
                                                </select>
                                                <?
                                                }
                                                ?>
                                              </td>
                                          <td class="loginTxt">Investor Amount</td>
                                          <td align="left" valign="top"><div id="invDiv">
                                              <input name="txtInvestorAmount" id="txtInvestorAmount" type="text" disabled="disabled" />
                                            </div></td>
                                          <td class="loginTxt">Client Name</td>
                                          <td align="left" valign="top">
                                            <?
                                                $sqlCl ="select * from tblClientMaster where isActive='0' order by ClientName ";
                                                $resultCl = mysql_query ($sqlCl) or die ("Error in  query : ".$sqlCl."<br>".mysql_errno()." : ".mysql_error());
                                                if(mysql_num_rows($resultCl)>0){
                                            ?>
                                            <select name="txtClientName" id="txtClientName" style="width:150px;" >
                                              <option value="">Select</option>
                                              <?
                                                    while($rowCl = mysql_fetch_array($resultCl))
                                                    {
                                              ?>
                                              <option value="<?=$rowCl["ClientID"]?>"><?=$rowCl["ClientName"]?></option>
                                              <?
                                                    }
                                              ?>
                                            </select>
                                            <? } ?>
                                          </td>
                        		</tr>
                                <tr>
                                  <td class="loginTxt">Finance Amount</td>
                                  <td align="left" valign="top"><input name="txtFAmoount" id="txtFAmoount" type="text" autocomplete="off" /></td>
                                  <td class="loginTxt">Finance Date</td>
                                  <td align="left" valign="top"><input type="text" name="Financedate" id="Financedate" style="width:150px;" autocomplete="off" />
                                    &nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.Financedate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                  <td class="loginTxt">Finance Percentage</td>
                                  <td align="left" valign="top"><input type="text" name="txtFPercent" id="txtFPercent" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                  <td class="loginTxt">Due Date</td>
                                  <td align="left" valign="top"><input type="text" name="FReturndate" id="FReturndate" style="width:150px;"/>
                                    &nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.FReturndate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="8">
                                        <input type="submit" id="btnTakeInvestment" name="btnTakeInvestment" value="Submit" class="button" onClick="return validateTakeInvestmentForm()"/>
                                        <input type="submit" name="btnCanel" id="btnCanel" value="Cancel" class="show_hide button" />
                                    </td>
                                </tr>
                            </table>
                           </div>
                        </td>
                    </tr>
                </table>
             </td>
         </tr>
        <tr><td height="10px">&nbsp;</td></tr>
         <?
            $sqlList="select inmt.*,inv.* from tblInvestmentMaster ";
            $sqlList= $sqlList." as inmt INNER JOIN tblInvestorMaster as inv ON inmt.InvestorID=inv.InvestorID";
            $sqlList= $sqlList." where inv.InvestorHead='0' group by inmt.InvestorID,inmt.InvestmentDate ";
            $resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
            if (mysql_num_rows($resultList)>0)
            {
        ?>
      <tr>
            <td align="center" valign="top" style="border:1px solid #CCCCCC;">
                <table width="100%" cellpadding="1" cellspacing="1" align="center" border="0" class="myTable">
                    <tr bgcolor="#404040">
                        <td class="tbl_head" width="6%" colspan="2"><b>S. No.</b></td>
                        <td class="tbl_head" width="15%"><b>Investor Name</b></td>
                        <td class="tbl_head" width="10%"><b>Bank Name</b></td>
                        <td class="tbl_head" width="10%"><b>ChequeNo</b></td>
                        <td class="tbl_head" width="10%"><b>Percent</b></td>
                        <td class="tbl_head" width="10%"><b>Investment Date</b></td>
                        <td class="tbl_head" width="10%"><b>Return Date</b></td>
                        <td class="tbl_head" width="10%"><b>Amount</b></td>
                         <td class="tbl_head" width="10%"><b>Return On Date</b></td>
                        <td class="tbl_head" width="5%"><b>Is Return</b></td>
                        <td class="tbl_head" width="5%"><b>Edit/Delete</b></td>
                        
                   </tr>
                    <?
                        
                            $count=1;
                            while($rowList = mysql_fetch_array($resultList))
                            {
                                $investor_head = $rowList["InvestorID"];
                                $sub_investor = getSubInvestor($investor_head);
                                array_push($sub_investor,$investor_head);
                                $isReturned = $rowList["isReturned"];
                                    
                    ?>
                    <tr bgcolor="#D3F0B7">

                        <td class="tbl_row" colspan="2"><?=$count?>.<div id="div_<?=$rowList["InvestmentID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                        <td class="tbl_row" align="left"><?=$rowList["InvestorName"]?></td>
                        <td class="tbl_row" align="left" colspan="9">&nbsp;</td>
                        
                        
                  </tr>
				  <?
                            $investor_str = implode(",",$sub_investor);
                            $sqlChk="select inmt.*,inv.* from tblInvestmentMaster ";
                            $sqlChk= $sqlChk." as inmt INNER JOIN tblInvestorMaster as inv ON inmt.InvestorID=inv.InvestorID";
                            $sqlChk= $sqlChk." where inmt.InvestorID in(".$investor_str.") and inmt.InvestmentDate like '".$rowList["InvestmentDate"]."%'  ";
                            $resultChk=mysql_query($sqlChk) or die ("Query Failed ".mysql_error());
                            if (mysql_num_rows($resultChk)>0)
                            {
                                while($rowChk = mysql_fetch_array($resultChk))
                                {
                                    $bank_name = getBankName($rowChk["BankID"]);
                  ?>
                <tr>
                    <td class="tbl_row" width="3%"></td>
                    <td align="center" valign="middle" width="3%"><img src="images/arrow_right.png" /><div id="div_<?=$rowChk["InvestmentID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                    <td class="tbl_row"><?=$rowChk["InvestorName"]?></td>
                    <td class="tbl_row"><?=$bank_name?></td>
                    <td class="tbl_row"><?=$rowChk["ChequeNo"]?></td>
                    <td class="tbl_row"><?=$rowChk["Percent"]?></td>
                    <td class="tbl_row" <? if($flagChk =='1'  && $rowChk["ReturnDate"]=='0'){ ?>  style="font-weight:bold;" <? } ?>><?=$rowChk["InvestmentDate"]?></td>
                    <td class="tbl_row"><?=$rowChk["ReturnDate"]?></td>
                    <td class="tbl_row"><? echo $rowChk["Amount"]; $amt_arr[] = $rowChk["Amount"]; ?></td>
                    <td class="tbl_row"><?=$rowChk["ReturnOnDate"]?></td>
                    <td class="tbl_row">
                        <input type="button" onclick="document.getElementById('div_<?=$rowChk["InvestmentID"]?>').style.visibility = 'visible'; get_frm('ajxIsReturnInvestment.php','<?=$rowChk["InvestmentID"]?>','div_<?=$rowChk["InvestmentID"]?>')" class="btnReturn" value="" <? if($rowChk["isReturned"]=='1'){ ?> disabled="disabled"<? } ?>  />
                   </td>
                   
                    <td align="center">
                        <a href="javascript:;" onClick="document.getElementById('div_<?=$rowChk["InvestmentID"]?>').style.visibility = 'visible'; get_frm('edit_take_investment.php','<?=$rowChk["InvestmentID"]?>','div_<?=$rowChk["InvestmentID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Investment Details" title="Edit Investment Details"/></a>&nbsp;&nbsp;
                        <a href="javascript:;" onClick="document.getElementById('div_<?=$rowChk["InvestmentID"]?>').style.visibility = 'visible'; get_frm('delete_take_investment.php','<?=$rowChk["InvestmentID"]?>','div_<?=$rowChk["InvestmentID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Investment Details" title="Delete Investment Details"/></a>
                  </td>
                </tr>
				 <?	
                                }
                            }
                        
                        $count++;
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
 </form>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?><? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<script src="inc/jquery.js" type="text/javascript"></script>
<script src="inc/img_preview.js" type="text/javascript"></script>
<script src="inc/jquery.min.js" type="text/javascript"></script>
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
function validateTakeInvestmentForm() {
   
	var p = document.forms["frmtakeInvestment"]["txtInvestorName"].value;
	var q = document.forms["frmtakeInvestment"]["txtIsCheque"].value;
	var r = document.forms["frmtakeInvestment"]["txtChequeNo"].value;
	var s = document.forms["frmtakeInvestment"]["txtBankName"].value;
	var t = document.forms["frmtakeInvestment"]["investmentdate"].value;
	var u = document.forms["frmtakeInvestment"]["txtPercent"].value; 
	var v = document.forms["frmtakeInvestment"]["txtInvestmentAmount"].value;
	var w = document.forms["frmtakeInvestment"]["returndate"].value; 
	var objErrSpan = document.getElementById('alertMsg');
	if (p == null || p == "" || t == null || t == "" || u == null || u == "" || v == null || v == "" || w == null || w == "" )
	{
		var objErrSpan = document.getElementById('alertMsg');
        objErrSpan.innerHTML= 'Please fill out all the fields';
        objErrSpan.style.color='red';
        objErrSpan.style.visibility='visible';
        return false;
	}
	if(q == null || q == "")
	{
		if(r == null || r == "" || s == null || s == "")
		{
			var objErrSpan = document.getElementById('alertMsg');
        	objErrSpan.innerHTML= 'Please fill out all the fields';
        	objErrSpan.style.color='red';
        	objErrSpan.style.visibility='visible';
        	return false;
		}
	}
}
</script>
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
</script>
<?
$message="";
$flagChk = 0;
$chq_no ="";
$bank_name="";

if(isset($_POST["btnReturnOnDate"]))
{
	$rec_id = $_POST["InvestmentId"];
	$return_on_date = $_POST["txtReturnOnDate"];
	
	$sqlUpdate = "update tblInvestmentMaster set ReturnOnDate = '".$return_on_date."', isReturned = '1' where InvestmentID='".$rec_id."' ";
	$resultUpdate = mysql_query ($sqlUpdate) or die ("Error in  query : ".$sqlUpdate."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["InvestorName"]."</b> successfully updated!!";
}

if(isset($_POST["btnTakeInvestment"]))
{
	if(isset($_POST["txtChequeNo"])){$chq_no = addslashes($_POST["txtChequeNo"]);}
	if(isset($_POST["txtBankName"])){$bank_name = addslashes($_POST["txtBankName"]); }
	$sqlAdd="insert into tblInvestmentMaster (InvestorID, Amount, InvestmentDate, Percent, ChequeNo, BankID, ReturnDate) values ('".addslashes($_POST["txtInvestorName"])."', '".addslashes($_POST["txtInvestmentAmount"])."', ";
	$sqlAdd=$sqlAdd . " '".addslashes($_POST["investmentdate"])."', '".addslashes($_POST["txtPercent"])."', '".$chq_no."', '".$bank_name."', '".addslashes($_POST["returndate"])."') ";
	$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
	$rec_id = mysql_insert_id();
	$message="Investment added Successfully!!";
}
if(isset($_POST["btnEditInvestment"]))
{
	$rec_id = $_POST["investmentId"];
	$sqlEdit="update tblInvestmentMaster set InvestorID='".addslashes($_POST["txtInvestorName1"])."', Amount='".addslashes($_POST["txtAmount1"])."', InvestmentDate='".addslashes($_POST["InvestmentDate1"])."', ";
	$sqlEdit= $sqlEdit . " Percent='".addslashes($_POST["txtPercent1"])."', ChequeNo='".addslashes($_POST["txtChequeNo1"])."', BankID='".addslashes($_POST["txtBankName1"])."',  ReturnDate='".addslashes($_POST["ReturnDate1"])."' where InvestmentID = ".$rec_id;
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="Record Successfully Edited!!";
}
if(isset($_POST["btnDeleteYes"]))
{
	$rec_id = $_POST["InvestmentId"];
	$sqlDel = "delete from tblInvestmentMaster where InvestmentID = ".$rec_id;
	$resultDel = mysql_query ($sqlDel) or die ("Error in  query : ".$sqlDel."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["InvestmentName"]."</b> successfully Deleted!!";
}
?>
<form id="frmtakeInvestment" name="frmtakeInvestment" method="post" enctype="multipart/form-data">
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
                                        	<tr><td class="header_shadow" colspan="8" style="font-weight:600">Investment Info</td></tr>
                                            <tr>
                                                <td class="loginTxt">Duration</td>
                                                <td align="left" valign="top" colspan="7">From : &nbsp; &nbsp;<input type="text" name="Fromdate" id="Fromdate" style="width:150px;"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmtakeInvestment.Fromdate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;&nbsp;To : &nbsp;<input type="text" name="Todate" id="Todate" style="width:150px;"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmtakeInvestment.Todate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="loginTxt">Investor</td>
                                                <td align="left">
                                                <?
													$sqlInves ="select * from tblInvestorMaster where isActive='0'";
													$resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
													if(mysql_num_rows($resultInves)>0)
													{
												?>
                                                	<select name="txtInvestorName" id="txtInvestorName" style="width:150px;" > 
                                    					 <option value="">-- Select Investor --</option>
                                                         	<?
                                                            while($rowInves = mysql_fetch_array($resultInves))
                                                            {
															?>
                                                            	<? if($rowInves["InvestorHead"]=='0'){ $inves_id = $rowInves["InvestorID"] ;?>
                                                        		<option value="<?=$rowInves["InvestorID"]?>" ><?=$rowInves["InvestorName"]?></option>
                                                                 <? }if($rowInves["InvestorHead"]!='0' && $rowInves["InvestorHead"]==$inves_id){?>
                                                                <option value="<?=$rowInves["InvestorID"]?>" style="padding-left:15px;">&nbsp;<?=$rowInves["InvestorName"]?></option><? } } ?>
                                                      </select>
												  <?
                                                    }
                                                  ?>
                                               </td>
                                             	<td class="loginTxt">Payment Mode</td>
                                                <td align="left" valign="top">
                                                <input type="radio" name="txtIsCheque" id="txtIsCheque" value="1" onchange="get_frm('ajxBank.php',this.value,'BankDiv');" />Cheque 
                                                <input type="radio" name="txtIsCheque" id="txtIsCheque" value="0" onchange="get_frm('ajxBank.php',this.value,'BankDiv');"  />Cash
                                                <input type="radio" name="txtIsCheque" id="txtIsCheque" value="0" onchange="get_frm('ajxBank.php',this.value,'BankDiv');"  />RTGS/NEFT
                                                </td>
                                               <td class="loginTxt">Bank</td>
                                               <td align="left" valign="top"><div id="BankDiv"><input name="txtBankName" id="txtBankName" type="text" disabled="disabled" /></div></td>
                                               <td class="loginTxt">Cheque No.</td>
                                               <td align="left" valign="top"><div id="chqDiv"><input name="txtChequeNo" id="txtChequeNo" type="text" disabled="disabled" /></div></td>
                                            </tr>
                                             <tr>
                                             	<td class="loginTxt">Percentage Of Investment</td>
                                                <td align="left" valign="top"><input type="text" name="txtPercent" id="txtPercent" /></td>
                                                <td class="loginTxt">Investment Amount</td>
                                                <td align="left" valign="top"><input name="txtInvestmentAmount" id="txtInvestmentAmount" type="text" value="" />
                                          </tr>
                                            <tr><td class="header_shadow" colspan="8"><b>Finance Info</b></td></tr>
                                            <tr>
                                              <td class="loginTxt">Investor</td>
                                              <td align="left" valign="top">
                                              <?
                                                $invesId= getInvestorFromInvestment();
                                                $sqlInves ="select investor.*,investment.* from  tblInvestmentMaster as investment INNER JOIN tblInvestorMaster as investor  ";
                                                $sqlInves = $sqlInves."ON investment.InvestorID=investor.InvestorID where investor.InvestorHead='0' ";
                                                $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
                                                if(mysql_num_rows($resultInves)>0)
                                                {
                                                
                                              ?>
                                                <select name="txtInvestment" id="txtInvestment" style="width:150px;" onchange="get_frm('ajxInvestorInvestedAmount.php',this.value,'invDiv');">
                                                  <option value="">Select</option>
                                                  <? 
                                                    while($rowInves = mysql_fetch_array($resultInves)){
                                                  ?>
                                                  <option value="<?=$rowInves["InvestmentID"]?>"><?=getInvestorName($rowInves["InvestorID"])?></option>
                                                  <?
                                                    }
                                                  ?>
                                                </select>
                                                <?
                                                }
                                                ?>
                                              </td>
                                          <td class="loginTxt">Investor Amount</td>
                                          <td align="left" valign="top"><div id="invDiv">
                                              <input name="txtInvestorAmount" id="txtInvestorAmount" type="text" disabled="disabled" />
                                            </div></td>
                                          <td class="loginTxt">Client Name</td>
                                          <td align="left" valign="top">
                                            <?
                                                $sqlCl ="select * from tblClientMaster where isActive='0' order by ClientName ";
                                                $resultCl = mysql_query ($sqlCl) or die ("Error in  query : ".$sqlCl."<br>".mysql_errno()." : ".mysql_error());
                                                if(mysql_num_rows($resultCl)>0){
                                            ?>
                                            <select name="txtClientName" id="txtClientName" style="width:150px;" >
                                              <option value="">Select</option>
                                              <?
                                                    while($rowCl = mysql_fetch_array($resultCl))
                                                    {
                                              ?>
                                              <option value="<?=$rowCl["ClientID"]?>"><?=$rowCl["ClientName"]?></option>
                                              <?
                                                    }
                                              ?>
                                            </select>
                                            <? } ?>
                                          </td>
                        		</tr>
                                <tr>
                                  <td class="loginTxt">Finance Amount</td>
                                  <td align="left" valign="top"><input name="txtFAmoount" id="txtFAmoount" type="text" autocomplete="off" /></td>
                                  <td class="loginTxt">Finance Date</td>
                                  <td align="left" valign="top"><input type="text" name="Financedate" id="Financedate" style="width:150px;" autocomplete="off" />
                                    &nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.Financedate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                  <td class="loginTxt">Finance Percentage</td>
                                  <td align="left" valign="top"><input type="text" name="txtFPercent" id="txtFPercent" autocomplete="off" /></td>
                                </tr>
                                <tr>
                                  <td class="loginTxt">Due Date</td>
                                  <td align="left" valign="top"><input type="text" name="FReturndate" id="FReturndate" style="width:150px;"/>
                                    &nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.FReturndate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="8">
                                        <input type="submit" id="btnTakeInvestment" name="btnTakeInvestment" value="Submit" class="button" onClick="return validateTakeInvestmentForm()"/>
                                        <input type="submit" name="btnCanel" id="btnCanel" value="Cancel" class="show_hide button" />
                                    </td>
                                </tr>
                            </table>
                           </div>
                        </td>
                    </tr>
                </table>
             </td>
         </tr>
        <tr><td height="10px">&nbsp;</td></tr>
         <?
            $sqlList="select inmt.*,inv.* from tblInvestmentMaster ";
            $sqlList= $sqlList." as inmt INNER JOIN tblInvestorMaster as inv ON inmt.InvestorID=inv.InvestorID";
            $sqlList= $sqlList." where inv.InvestorHead='0' group by inmt.InvestorID,inmt.InvestmentDate ";
            $resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
            if (mysql_num_rows($resultList)>0)
            {
        ?>
      <tr>
            <td align="center" valign="top" style="border:1px solid #CCCCCC;">
                <table width="100%" cellpadding="1" cellspacing="1" align="center" border="0" class="myTable">
                    <tr bgcolor="#404040">
                        <td class="tbl_head" width="6%" colspan="2"><b>S. No.</b></td>
                        <td class="tbl_head" width="15%"><b>Investor Name</b></td>
                        <td class="tbl_head" width="10%"><b>Bank Name</b></td>
                        <td class="tbl_head" width="10%"><b>ChequeNo</b></td>
                        <td class="tbl_head" width="10%"><b>Percent</b></td>
                        <td class="tbl_head" width="10%"><b>Investment Date</b></td>
                        <td class="tbl_head" width="10%"><b>Return Date</b></td>
                        <td class="tbl_head" width="10%"><b>Amount</b></td>
                         <td class="tbl_head" width="10%"><b>Return On Date</b></td>
                        <td class="tbl_head" width="5%"><b>Is Return</b></td>
                        <td class="tbl_head" width="5%"><b>Edit/Delete</b></td>
                        
                   </tr>
                    <?
                        
                            $count=1;
                            while($rowList = mysql_fetch_array($resultList))
                            {
                                $investor_head = $rowList["InvestorID"];
                                $sub_investor = getSubInvestor($investor_head);
                                array_push($sub_investor,$investor_head);
                                $isReturned = $rowList["isReturned"];
                                    
                    ?>
                    <tr bgcolor="#D3F0B7">

                        <td class="tbl_row" colspan="2"><?=$count?>.<div id="div_<?=$rowList["InvestmentID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                        <td class="tbl_row" align="left"><?=$rowList["InvestorName"]?></td>
                        <td class="tbl_row" align="left" colspan="9">&nbsp;</td>
                        
                        
                  </tr>
				  <?
                            $investor_str = implode(",",$sub_investor);
                            $sqlChk="select inmt.*,inv.* from tblInvestmentMaster ";
                            $sqlChk= $sqlChk." as inmt INNER JOIN tblInvestorMaster as inv ON inmt.InvestorID=inv.InvestorID";
                            $sqlChk= $sqlChk." where inmt.InvestorID in(".$investor_str.") and inmt.InvestmentDate like '".$rowList["InvestmentDate"]."%'  ";
                            $resultChk=mysql_query($sqlChk) or die ("Query Failed ".mysql_error());
                            if (mysql_num_rows($resultChk)>0)
                            {
                                while($rowChk = mysql_fetch_array($resultChk))
                                {
                                    $bank_name = getBankName($rowChk["BankID"]);
                  ?>
                <tr>
                    <td class="tbl_row" width="3%"></td>
                    <td align="center" valign="middle" width="3%"><img src="images/arrow_right.png" /><div id="div_<?=$rowChk["InvestmentID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                    <td class="tbl_row"><?=$rowChk["InvestorName"]?></td>
                    <td class="tbl_row"><?=$bank_name?></td>
                    <td class="tbl_row"><?=$rowChk["ChequeNo"]?></td>
                    <td class="tbl_row"><?=$rowChk["Percent"]?></td>
                    <td class="tbl_row" <? if($flagChk =='1'  && $rowChk["ReturnDate"]=='0'){ ?>  style="font-weight:bold;" <? } ?>><?=$rowChk["InvestmentDate"]?></td>
                    <td class="tbl_row"><?=$rowChk["ReturnDate"]?></td>
                    <td class="tbl_row"><? echo $rowChk["Amount"]; $amt_arr[] = $rowChk["Amount"]; ?></td>
                    <td class="tbl_row"><?=$rowChk["ReturnOnDate"]?></td>
                    <td class="tbl_row">
                        <input type="button" onclick="document.getElementById('div_<?=$rowChk["InvestmentID"]?>').style.visibility = 'visible'; get_frm('ajxIsReturnInvestment.php','<?=$rowChk["InvestmentID"]?>','div_<?=$rowChk["InvestmentID"]?>')" class="btnReturn" value="" <? if($rowChk["isReturned"]=='1'){ ?> disabled="disabled"<? } ?>  />
                   </td>
                   
                    <td align="center">
                        <a href="javascript:;" onClick="document.getElementById('div_<?=$rowChk["InvestmentID"]?>').style.visibility = 'visible'; get_frm('edit_take_investment.php','<?=$rowChk["InvestmentID"]?>','div_<?=$rowChk["InvestmentID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Investment Details" title="Edit Investment Details"/></a>&nbsp;&nbsp;
                        <a href="javascript:;" onClick="document.getElementById('div_<?=$rowChk["InvestmentID"]?>').style.visibility = 'visible'; get_frm('delete_take_investment.php','<?=$rowChk["InvestmentID"]?>','div_<?=$rowChk["InvestmentID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Investment Details" title="Delete Investment Details"/></a>
                  </td>
                </tr>
				 <?	
                                }
                            }
                        
                        $count++;
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
 </form>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
<? include ("inc/footer.php"); ?>