<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<!-- Scroll Up Start-->
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
<script type="text/javascript">validateEditForm
function validatefrmLocation() {
   
	var x = document.forms["frmLocation"]["txtLocationName"].value;
	var y = document.forms["frmLocation"]["txtCity"].value;
	var z = document.forms["frmLocation"]["txtLocationAdd"].value;
	var a = document.forms["frmLocation"]["txtNCompany"].value;
	var b = document.forms["frmLocation"]["txtContactNum"].value;
	var objErrSpan = document.getElementById('alertMsg');
	if (x == null || x == "" || y == null || y == "" || z == null || z == "" || a == null || a == "" || b == null || b == "" ) {
		var objErrSpan = document.getElementById('alertMsg');
        objErrSpan.innerHTML= 'Please enter Location Name, City, Address or Contact No.';
        objErrSpan.style.color='red';
        objErrSpan.style.visibility='visible';
        return false;
		}
}
function validateEditForm() {
   
	var x = document.forms["frmEditLocation"]["txtLocationName1"].value;
	var y = document.forms["frmEditLocation"]["txtCity1"].value;
	var z = document.forms["frmEditLocation"]["txtLocationAdd1"].value;
	var a = document.forms["frmEditLocation"]["txtNCompany1"].value;
	var b = document.forms["frmEditLocation"]["txtContactNum1"].value;
	var objErrSpan = document.getElementById('alertMsg');
	if (x == null || x == "" || y == null || y == "" || z == null || z == "" || a == null || a == "" || b == null || b == "" ) {
		var objErrSpan = document.getElementById('alertEdit');
        objErrSpan.innerHTML= 'Please enter Location Name, City, Address or Contact No.';
        objErrSpan.style.color='red';
        objErrSpan.style.visibility='visible';
        return false;
		}
	//if (a == null || a == "") {
//		var objErrSpan = document.getElementById('alertEdit');
//        objErrSpan.innerHTML= 'Please select company';
//        objErrSpan.style.color='red';
//        objErrSpan.style.visibility='visible';
//        return false;
//		}
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
<!-- Scroll Up End-->
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

if(isset($_POST["btnAddBank"]))
{   
	$sqlAdd="insert into tblBankMaster (BankName) values ('".addslashes($_POST["txtBankName"])."') ";
	$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".$_POST["txtBankName"]."</b> Successfully Added!!";
}
if(isset($_POST["btnEditBank"]))
{ 
 	$sqlEdit="update tblBankMaster set BankName='".addslashes($_POST["txtBankName1"])."'  where BankID = ".$_POST["BankId"];
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".$_POST["txtBankName1"]."</b> Successfully Edited!!";  
}
if(isset($_POST["btnDeleteYes"]))
{
	$sqlL="select Count(RecID) as tCount from tblBankTransactionDetails where InvestorBankID = '".$_POST["BankId"]."' or ";
	$sqlL = $sqlL." RepaymentBankID = '".$_POST["BankId"]."' or InterestBankID = '".$_POST["BankId"]."' ";
	$resultL=mysql_query($sqlL) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultL)>0)
	{
		$rowL = mysql_fetch_array($resultL);
		if($rowL["tCount"]=='0')
		{
			$sql = "delete from tblBankMaster where BankID = ".$_POST["BankId"];
			$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
			$message="<b>".$_POST["txtBankName"]."</b> Successfully Deleted!!";
			
		}else{ $message="<b>".$_POST["txtBankName"]."</b> could not be deleted, used in transaction !!"; }
	}
}
?>
<form id="frmBank" name="frmBank" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Bank Master</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Administration &nbsp;&raquo;&nbsp; <b>Bank Master</b></td>
                </tr>
                <tr><td class="message" align="center"><div id="alertMsg"><?=$message?></div></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                                <td valign="top" class="login_head_bg">
                                	<div class="blue_bg" style="float:left;">Add Bank</div>
                                	<div style="text-align:right;"><input type="submit" name="addNewQue" id="addNewQue" value="Add Bank" class="show_hide button_big" /></div>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top">
                                    <div class="productDescription">
                                        
                                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                            <tr align="center">
                                                <td class="loginTxt" width="50%">Bank Name</td>
                                                <td class="trow" width="50%"><input type="text" id="txtBankName" name="txtBankName" /></td>
                                            </tr>
                                            <tr align="center">
                                            	<td colspan="2">
                                                    <input type="submit" id="btnAddBank" name="btnAddBank" value="Add Bank" class="button" onClick="return validatefrmLocation()"/>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td height="5px;">&nbsp;</td></tr>
                <tr>
                	<td align="center" valign="top" style="border:1px solid #CCCCCC;">
                        <?
							$sqlList="select * from tblBankMaster order by BankName";
							$resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
							if (mysql_num_rows($resultList)>0)
							{
						?>
                        <table width="100%" cellpadding="5" cellspacing="1" align="center" border="0" class="myTableR">
                            <tr bgcolor="#EFEFEF">
                                <td class="tableHead" width="5%"><b>S. No.</b></td>
                                <td class="tableHead" width="85%"><b>Bank Name</b></td>
                                 <td class="tableHead" width="10%"><b>Edit/Delete</b></td>
                             </tr>
                            <? 
                                $count=1;
                                while($rowList = mysql_fetch_array($resultList))
                                {
                            ?>
                          	<tr>
                                <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowList["BankID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                                <td class="tbl_row"><?=$rowList["BankName"]?></td>
                               	<td align="center" bgcolor="#EFEFEF">
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["BankID"]?>').style.visibility = 'visible'; get_frm('edit_bank.php','<?=$rowList["BankID"]?>','div_<?=$rowList["BankID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Bank Details" title="Edit Bank Name"/></a>&nbsp;&nbsp;
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["BankID"]?>').style.visibility = 'visible'; get_frm('delete_bank.php','<?=$rowList["BankID"]?>','div_<?=$rowList["BankID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Bank Details" title="Delete Bank Name"/></a>
                           	  	</td>
                            </tr>
                            <?
								$count++;
								}
							?>
                    	</table>
                        <?
							}
						?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
   
</table>
</form>
<div><a href="#" class="scrollup">Scroll</a></div>
<? include ("inc/footer.php"); ?>