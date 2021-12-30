<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<!-- Scroll Up Start-->
<link rel="stylesheet" href="css/bootstrap.min.css"> 
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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
<script language="javascript" type="text/javascript">
function popitup(url) {
	newwindow=window.open(url,'name','width=920, height=700, scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
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
if(!isset($_POST["no_refresh"]))
{
	$_SESSION["no_refresh"] = "";
}
if(isset($_POST["btnAddClient"]))
{
	if($_POST["no_refresh"]==$_SESSION["no_refresh"])
	{
		$message = "<b>WARRNING : </b>Please do not Refresh the Page";
	
	}else{
		$_SESSION["no_refresh"]=$_POST["no_refresh"];	
	$sqlAdd="insert into tblClientMaster (ClientName, FatherName, ClientCode, Email, Phone, MobileNo, PANNo, City, Address) ";
	$sqlAdd = $sqlAdd." values ('".ucwords(addslashes($_POST["txtClientName"]))."','".ucwords(addslashes($_POST["txtFatherName"]))."',  ";
	$sqlAdd =$sqlAdd. " '".ucwords(addslashes($_POST["txtClientCode"]))."','".addslashes($_POST["txtClientEmail"])."', '".addslashes($_POST["txtPhonneNo"])."' ";
	$sqlAdd = $sqlAdd." , '".addslashes($_POST["txtMobileNo"])."', '".strtoupper(addslashes($_POST["txtPANNo"]))."', '".ucwords(addslashes($_POST["txtCity"]))."', ";
	$sqlAdd = $sqlAdd." '".ucwords(addslashes($_POST["txtRegAdd"]))."' )";
	$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
	$rec_id= mysql_insert_id();
	if($_POST["txtBank"]!="")
	{
		$accountType = $_POST["txtTypeAccount"]; 
		if($accountType=='Other')
		{
			$accountType= $_POST["txtOtherAccount"];
		}
		$sqlBank="insert into tblClientBankMaster (ClientID, BankID, AccountHolderName, AccountNo, IFSCCode, TypeOfAccount, BankBranch,ClientType) ";
		$sqlBank =$sqlBank." values ('".$rec_id."','".addslashes($_POST["txtBank"])."', '".ucwords(addslashes($_POST["txtAccHolderName"]))."', ";
		$sqlBank =$sqlBank." '".addslashes($_POST["txtAccountNumber"])."', '".strtoupper(addslashes($_POST["txtIFSCCode"]))."' ,'".addslashes($accountType)."' ";
		$sqlBank= $sqlBank." , '".ucwords(addslashes($_POST["txtBankBranch"]))."', 'Head')";
		$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
	}
	$message="<b>".ucwords(addslashes($_POST["txtClientName"]))."</b> Successfully Added!!";
	}
}
if(isset($_POST["btnAddSubClient"]))
{
	$clientId = $_POST["ClientID"]; 
	$sqlSAdd="insert into tblSubClientMaster (ClientID, ClientName, EmailID, PhoneNo, MobileNo, PANNo, City, Address) values ";
	$sqlSAdd = $sqlSAdd." ('".$clientId."', '".ucwords(addslashes($_POST["txtClientName".$clientId]))."', '".addslashes($_POST["txtEmail".$clientId])."', ";
	$sqlSAdd =$sqlSAdd. " '".addslashes($_POST["txtPhoneoNo".$clientId])."', '".addslashes($_POST["txtMobileNo".$clientId])."', ";
	$sqlSAdd = $sqlSAdd." '".strtoupper(addslashes($_POST["txtPANNo".$clientId]))."', '".ucwords(addslashes($_POST["txtCity".$clientId]))."', ";
	$sqlSAdd = $sqlSAdd." '".ucwords(addslashes($_POST["txtAddress".$clientId]))."' )";
	$resultSAdd = mysql_query ($sqlSAdd) or die ("Error in  query : ".$sqlSAdd."<br>".mysql_errno()." : ".mysql_error());
	$rec_id= mysql_insert_id();
	if($_POST["txtBank".$clientId]!="")
	{
		$accountType = $_POST["txtTypeAccount".$clientId]; 
		if($accountType=='Other')
		{
			$accountType= $_POST["txtOtherAccount".$clientId];
		}
		$sqlSBank="insert into tblClientBankMaster (ClientID, BankID, AccountHolderName, AccountNo, IFSCCode, TypeOfAccount, BankBranch,ClientType) ";
		$sqlSBank =$sqlSBank." values ('".addslashes($rec_id)."','".addslashes($_POST["txtBank".$clientId])."', '".ucwords(addslashes($_POST["txtAccHolderName".$clientId]))."', ";
		$sqlSBank =$sqlSBank." '".addslashes($_POST["txtAccountNumber".$clientId])."', '".strtoupper(addslashes($_POST["txtIFSCCode".$clientId]))."'  ";
		$sqlSBank= $sqlSBank." ,'".addslashes($accountType)."', '".ucwords(addslashes($_POST["txtBankBranch".$clientId]))."', 'SubClient')";
		$resultSBank = mysql_query ($sqlSBank) or die ("Error in  query : ".$sqlSBank."<br>".mysql_errno()." : ".mysql_error());
	}
	$message="<b>".ucwords(addslashes($_POST["txtClientName".$clientId]))."</b> Successfully Added!!";
}
if(isset($_POST["btnAddBankDetails"]))
{
	if($_POST["no_refresh"]==$_SESSION["no_refresh"])
	{
		$message = "<b>WARRNING : </b>Please do not Refresh the Page";
	
	}else{
		$_SESSION["no_refresh"]=$_POST["no_refresh"];	
		$clientID = $_POST["txtCleintID"];
		$clientType = $_POST["ClientType"];
		$clientChk = $_POST["ClientCheck"];
		
		$accountType = $_POST["txtAccountType".$clientChk.$clientID]; 
		if($accountType=='Other')
		{
			$accountType= $_POST["txtOtherAcc".$clientChk.$clientID];
		}
	
		/*foreach ($_POST as $key => $value)
		{
			if(strpos(htmlspecialchars($key),"txtCleintID")!== false)
			{
				$clientID = htmlspecialchars($value);
				$ClientName = getClientName($clientID);
			}
		}*/
		$sqlBank="insert into tblClientBankMaster (ClientID, BankID, AccountHolderName, AccountNo, IFSCCode, TypeOfAccount, BankBranch, ClientType) ";
		$sqlBank=$sqlBank." values ('".addslashes($clientID)."','".addslashes($_POST["txtBank".$clientChk.$clientID])."', '".addslashes($_POST["txtAccHolderName".$clientChk.$clientID])."', ";
		$sqlBank=$sqlBank." '".addslashes($_POST["txtAccountNo".$clientChk.$clientID])."', '".addslashes($_POST["txtIFSCCode".$clientChk.$clientID])."', ";
		$sqlBank=$sqlBank." '".addslashes($accountType)."', '".addslashes($_POST["txtBankBranch".$clientChk.$clientID])."','".$clientType."')";
		$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
		$message="<b>".addslashes($_POST["txtAccHolderName".$clientChk.$clientID])."'s</b> Bank Details Added Successfully!!";
	}
	
}
if(isset($_POST["btnEditClient"]))
{	
	$sqlEdit = "update tblClientMaster set ClientName='".ucwords(addslashes($_POST["txtClientNameH"]))."', ClientCode='".addslashes($_POST["txtCodeH"])."', ";
	$sqlEdit = $sqlEdit."  Email='".addslashes($_POST["txtEmailH"])."', Phone='".addslashes($_POST["txtPhoneH"])."', MobileNo= ";
	$sqlEdit = $sqlEdit." '".addslashes($_POST["txtMobileNoH"])."', PANNo='".strtoupper(addslashes($_POST["txtPANNoH"]))."', City='".ucwords(addslashes($_POST["txtCityH"]))."' ";
	$sqlEdit = $sqlEdit." , Address='".ucwords(addslashes($_POST["txtRegAddH"]))."' , FatherName='".addslashes($_POST["txtFather1"])."' where ClientID = ".$_POST["txtClientId"];
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".ucwords(addslashes($_POST["txtClientNameH"]))."</b> Successfully Edited!!";
}
if(isset($_POST["btnEditSubClient"]))
{	
	$sqlEdit ="update tblSubClientMaster set ClientName='".addslashes($_POST["txtClientName1"])."', 	EmailID='".addslashes($_POST["txtEmail1"])."', ";
	$sqlEdit =$sqlEdit."  PhoneNo='".addslashes($_POST["txtPhone1"])."', MobileNo='".addslashes($_POST["txtMobileNo1"])."', PANNo=  ";
	$sqlEdit = $sqlEdit." '".strtoupper(addslashes($_POST["txtPANNo1"]))."' , City='".ucwords(addslashes($_POST["txtCity1"]))."', ";
	$sqlEdit =$sqlEdit." Address='".ucwords(addslashes($_POST["txtRegAdd1"]))."' where SubClientID = ".$_POST["txtSubClientId"];
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".$_POST["txtClientName1"]."</b> Successfully Edited!!";
}


 //if(isset($_POST["btnEditBank"]))
//{	
	//$sqlEdit ="update tblClientBankMaster set BankID='".addslashes($_POST["txtBank"])."', 	AccountHolderName='".addslashes($_POST["txtAccHolderName"])."', ";
    //$sqlEdit =$sqlEdit." AccountNo='".addslashes($_POST["txtAccountNumber"]))."' , IFSCCode='".addslashes($_POST["txtIFSCCode"]))."' , TypeOfAccount='".addslashes($_POST["txtTypeAccount"]))."' , BankBranch='".addslashes($_POST["txtBankBranch"]))."'  where RecID = ".$_POST["RecID"];
	//resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	//$message="<b>".$_POST["txtClientName1"]."</b> Successfully Edited!!";
//}


if(isset($_POST["btnDeleteClient"]))
{
	$rec_id = $_POST["txtClientId"];
	$sqlL="select ClientID from tblSubClientMaster where ClientID = '".$rec_id."' ";
	$resultL=mysql_query($sqlL) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultL)==0)
	{
		$sqlC="select ClientID from tblTransactionMaster where ClientID = '".$rec_id."' ";
		$resultC=mysql_query($sqlC) or die ("Query Failed ".mysql_error());
		if (mysql_num_rows($resultC)==0)
		{
			$sqlLoc= "delete from tblClientMaster where ClientID=".$rec_id;
			$resultLoc = mysql_query ($sqlLoc) or die ("Error in  query : ".$sqlLoc."<br>".mysql_errno()." : ".mysql_error());
		
			$sqlB= "delete from tblClientBankMaster where ClientID=".$rec_id." and ClientType like 'Head' ";
			$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
			
			$message="<b>".$_POST["txtClientName"]."</b> Successfully Deleted!!";
		}else{ $message="<b>".$_POST["txtClientName"]."</b> can't be deleted, transaction exist!!"; }
	}else{ $message="<b>".$_POST["txtClientName"]."</b> can't be deleted, sub client exist!!"; }
}

if(isset($_POST["btnDeleteSubClient"]))
{
	$rec_id = $_POST["txtSubClientId"];
	$sqlC="select SubClientID from tblTransactionMaster where SubClientID = '".$rec_id."' ";
	$resultC=mysql_query($sqlC) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultC)==0)
	{
		$sqlLoc= "delete from tblSubClientMaster where SubClientID=".$rec_id;
		$resultLoc = mysql_query ($sqlLoc) or die ("Error in  query : ".$sqlLoc."<br>".mysql_errno()." : ".mysql_error());
	
		$sqlB= "delete from tblClientBankMaster where ClientID=".$rec_id." and ClientType like 'SubClient' ";
		$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
		
		$message="<b>".$_POST["txtClientName"]."</b> Successfully Deleted!!";
	}else{ $message="<b>".$_POST["txtClientName"]."</b> can't be deleted, transaction exist!!"; }
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Client Master</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Administration &nbsp;&raquo;&nbsp; <b>Client Master</b></td>
                </tr>
                <tr><td class="message" align="center"><div id="alertMsg"><?=$message?></div></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                                <td valign="top" class="login_head_bg">
                                	<div class="blue_bg" style="float:left;">Add Client</div>
                                	<div style="text-align:right;"><input type="submit" name="addNewQue" id="addNewQue" value="Add Client" class="show_hide button_big" /></div>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top">
                                	<div class="productDescription">
                                    <form id="frmClient" name="frmClient" method="post">
										<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                             <tr>
                                                <td class="loginTxt">Client Name</td>
                                                <td align="left"><input name="txtClientName" id="txtClientName" type="text" autocomplete="off"
                                                 oninput="document.getElementById('txtAccHolderName').value = this.value; "
                                                 required /></td>
                                                <td class="loginTxt">Client Code</td>
                                                <td align="left"><input name="txtClientCode" id="txtClientCode" type="text" autocomplete="off" /></td>
                                                <td class="loginTxt">Email</td>
                                                <td align="left"><input name="txtClientEmail" type="text" id="txtClientEmail" autocomplete="off" />                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td class="loginTxt">Phone No.</td>
                                                <td align="left"><input type="text" name="txtPhonneNo" id="txtPhonneNo" autocomplete="off" /></td>
                                               
                                                <td class="loginTxt">Mobile No.</td>
                                                <td align="left"><input type="text" name="txtMobileNo" id="txtMobileNo" autocomplete="off" /></td>
                                                 <td class="loginTxt">PAN No.</td>
                                                <td align="left"><input name="txtPANNo" type="text" id="txtPANNo" autocomplete="off" />                                                </td>
                                            </tr>
                                            <tr>
                                               <td class="loginTxt">Father's Name</td>
                                                <td align="left"><input name="txtFatherName" type="text" id="txtFatherName" autocomplete="off" /></td>
                                              <td class="loginTxt">City</td>
                                             <td align="left"><input name="txtCity" type="text" id="txtCity" autocomplete="off"/></td>
                                             <td class="loginTxt">Address</td>
                                                <td align="left"><textarea name="txtRegAdd" id="txtRegAdd" style="width:90%;" rows="1"></textarea></td>
                                            <tr>
                                            	<td class="header_shadow" colspan="6"><b>Bank Details</b></td>
                                            </tr>
                                             <tr>
                                                <td class="loginTxt">Name Of Bank</td>
                                                <td align="left">
                                                <?
														$sqlBank ="select * from tblBankMaster order by BankName";
														$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
														if(mysql_num_rows($resultBank)>0)
														{
													?>
                                                	<select name="txtBank" id="txtBank" style="width:160px;">
                                                		<option value="">Select</option>
                                                     <?
														while($rowBank = mysql_fetch_array($resultBank))
														{
													?>
															 <option value="<?=$rowBank["BankID"]?>"><?=$rowBank["BankName"]?></option>
													<?
														}
													?>
												  </select>
												  <?
													 }
												   ?>
                                                <td class="loginTxt">Account Holder Name</td>
                                                <td align="left"><input name="txtAccHolderName" id="txtAccHolderName" type="text" autocomplete="off" /></td>
                                                <td class="loginTxt">Account No.</td>
                                                <td align="left"><input name="txtAccountNumber" type="text" id="txtAccountNumber" autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                
                                                <td class="loginTxt">IFSC Code</td>
                                                <td align="left"><input type="text" name="txtIFSCCode" id="txtIFSCCode" autocomplete="off" style="width:160px;" /></td>
                                                <td class="loginTxt">Type of Account</td>
                                                <td align="left" colspan="3"><input name="txtTypeAccount" checked="checked" type="radio" id="txtTypeAccount" value="Saving" onclick="
                                               document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');
                                                " /> Saving
                                                &nbsp;&nbsp;&nbsp;<input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="Current" onclick="
                                               document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');
                                                " />Current&nbsp;&nbsp;&nbsp;
                                                <input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="CC" onclick="
                                               document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');
                                                " />CC
                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="OD" onclick="
                                               document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');
                                                " />OD
                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="Other" onchange="
                                                document.getElementById('txtOtherAccount').removeAttribute('disabled'); 
                                                " />Other &nbsp;&nbsp;&nbsp;
                                                <input type="text" name="txtOtherAccount" id="txtOtherAccount" disabled="disabled"  />                                                </td>
                                            </tr>
                                            <tr>
                                              <td class="loginTxt">Branch</td>
                                              <td align="left" colspan="5"><textarea name="txtBankBranch" id="txtBankBranch" style="width:60%;" rows="1" ></textarea></td>
                                           </tr>
                                            <tr>
                                                <td align="center" colspan="6">
                                                	<input type="hidden" name="no_refresh" id="no_refresh" value="<?php echo uniqid(rand()); ?>"  />
                                                    <input type="submit" id="btnAddClient" name="btnAddClient" value="Add" class="button" />
                                                     <input type="submit" name="btnCanel" id="btnCanel" value="Cancel" class="show_hide button" />                                                </td>
                                            </tr>
                                        </table>
                                      </form>
                                    </div>
                                   </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td height="5px;">&nbsp;</td></tr>
                <tr>
                	<td align="center">
                    	<form id="frmSearch" name="frmSearch" method="post">
                           Search : <select name="txtSearch" id="txtSearch" style="width:160px;" onchange="form.submit()">
                             <option value="">Select</option>
                             <option value="All">All</option>
								<?
									$sqlS="select * from tblClientMaster order by ClientName";
                    				$resultS=mysql_query($sqlS) or die ("Query Failed ".mysql_error());
									if (mysql_num_rows($resultS)>0)
									{
										while($rowS = mysql_fetch_array($resultS))
										{
								?>
                                     <option value="<?=$rowS["ClientID"]?>"><?=$rowS["ClientName"]?></option>
                                <?	
										}
									}
								?>
                                </select>
                         </form>
                    </td>
                </tr>
                <tr><td height="5px;">&nbsp;</td></tr>
               	<?
					$where ="";
					if(isset($_POST["txtSearch"]) && $_POST["txtSearch"]!='All')
					{
						$where ="where ClientID ='".$_POST["txtSearch"]."' ";
					}
					$sqlList="select * from tblClientMaster $where order by ClientName";
					$resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
					if (mysql_num_rows($resultList)>0)
					{
				?>
                <tr>
                	<td align="center" valign="top" style="border:1px solid #CCCCCC;">
                        <table width="100%" cellpadding="1" cellspacing="1" align="center" border="0" class="myTableR">
                            <tr bgcolor="#EFEFEF">
                                <td class="tableHead" width="5%"><b>S. No.</b></td>
                                <td class="tableHead" width="14%"><b>Client Name</b></td>
                                <td class="tableHead" width="8%"><b>Code</b></td>
                                <td class="tableHead" width="13%"><b>Email</b></td>
                                <td class="tableHead" width="14.5%"><b>Contact No.</b></td>
                                <td class="tableHead" width="13%"><b>Address</b></td>
                                <td class="tableHead" width="12.5%"><b>Add Sub-Clients</b></td>
                                <td class="tableHead" width="10%"><b>Add Bank Details</b></td>
                                <td class="tableHead" width="10%"><b>Edit/Delete</b></td>
                          </tr>
                            <?
                            		$count=1;
                                	while($rowList = mysql_fetch_array($resultList))
                                	{
							 ?>
                            <tr  bgcolor="#EFEFEF">
                                <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowList["ClientID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                                <td class="tbl_row"><a href="#" onClick="return popitup('client-details.php?cid=<?=$rowList["ClientID"]?>')"><?=$rowList["ClientName"]?></a></td>
                                <td class="tbl_row"><?=$rowList["ClientCode"]?></td>
                                <td class="tbl_row"><?=$rowList["Email"]?></td>
                                <td class="tbl_row"><?=$rowList["Phone"]?><? if($rowList["MobileNo"]!=''){echo ",&nbsp;<br>".$rowList["MobileNo"];} ?></td>
                                <td class="tbl_row"><?=$rowList["Address"]?><? if($rowList["City"]!=''){echo ",&nbsp;".$rowList["City"];} ?></td>
                                <td class="tbl_row">
                                	<button type="button" data-toggle="modal" data-target="#Client<?=$rowList["ClientID"]?>" onclick="
                                    var getValue = $(this).attr('data-target');
                                    var getValue = getValue.substr(1);
                                    document.getElementById('txtCleintID'+getValue).setAttribute('value', getValue); 
                                    " class="button">Add</button>
									<div class="modal fade" id="Client<?=$rowList["ClientID"]?>" role="dialog">
                                        <div class="modal-dialog">
                                        <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h5 class="modal-title" style="color:#FFFFFF;">Add Sub Investor</h5>
                                            </div>
                                            <div style="background:#F2F2F2; line-height:30px;" class="modal-title"><b><?=$rowList["ClientName"]?></b></div>
                                            <div class="modal-body">
                                            <form id="frmAddSubClient" name="frmAddSubClient" method="post">
                                                    <div class="row" style="padding-bottom:10px;">
                                                          <div class="col-md-4">
                                                                <div align="left">Client Name</div>
                                                                <input type="text" class="form-control" id="txtClientName<?=$rowList["ClientID"]?>" name="txtClientName<?=$rowList["ClientID"]?>" required >
                                                          </div>
                                                          <div class="col-md-4"><div align="left">Email</div><input type="text" class="form-control" id="txtEmail<?=$rowList["ClientID"]?>" name="txtEmail<?=$rowList["ClientID"]?>" ></div>
                                                          <div class="col-md-4"><div align="left">Phone No.</div><input type="text" class="form-control" id="txtPhoneoNo<?=$rowList["ClientID"]?>" name="txtPhoneoNo<?=$rowList["ClientID"]?>" ></div>
                                           	  </div>
                                                    <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-4"><div align="left">Mobile No.</div><input type="text" class="form-control" id="txtMobileNo<?=$rowList["ClientID"]?>" name="txtMobileNo<?=$rowList["ClientID"]?>"></div>
                                                      <div class="col-md-4"><div align="left">PAN No.</div><input type="text" class="form-control" id="txtPANNo<?=$rowList["ClientID"]?>" name="txtPANNo<?=$rowList["ClientID"]?>"/></div>
                                                      <div class="col-md-4"><div align="left">City</div><input type="text" class="form-control" id="txtCity<?=$rowList["ClientID"]?>" name="txtCity<?=$rowList["ClientID"]?>"></div>
                                                    </div>
                                                    <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-12"><div align="left">Address</div><textarea name="txtAddress<?=$rowList["ClientID"]?>" id="txtAddress<?=$rowList["ClientID"]?>" class="form-control" style="width:100%; height:30px;"></textarea></div>
                                                      
                                                    </div>
                                                    <div class="row" style="padding-bottom:10px; text-align:left;">
                                                      <div style="background:#F2F2F2; line-height:30px;"><span style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; text-align:left; margin-left:5px;">Bank Details</span></div>
                                                      
                                                    </div>
                                                    <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-4"><div align="left">Name Of Bank</div>	
													 <?
														$sqlBank ="select * from tblBankMaster order by BankName";
														$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
														if(mysql_num_rows($resultBank)>0)
														{
													?>
                                                	<select name="txtBank<?=$rowList["ClientID"]?>" id="txtBank<?=$rowList["ClientID"]?>" style="width:230px;" class="form-control">
                                                		<option value="">Select</option>
                                                     <?
														while($rowBank = mysql_fetch_array($resultBank))
														{
													?>
															 <option value="<?=$rowBank["BankID"]?>"><?=$rowBank["BankName"]?></option>
													<?
														}
													?>
												  </select>
												  <?
													 }
												   ?></div>
                                                      <div class="col-md-4"><div align="left">Account Holder Name</div><input name="txtAccHolderName<?=$rowList["ClientID"]?>" id="txtAccHolderName<?=$rowList["ClientID"]?>" type="text" value="<?=$rowList["ClientName"]?>" autocomplete="off" class="form-control" /></div>
                                                      <div class="col-md-4"><div align="left">Account No.</div><input name="txtAccountNumber<?=$rowList["ClientID"]?>" type="text" id="txtAccountNumber<?=$rowList["ClientID"]?>" autocomplete="off" class="form-control"/></div>
                                                    </div>
                                                    
                                                    <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-4"><div align="left">IFSC Code</div><input type="text" name="txtIFSCCode<?=$rowList["ClientID"]?>" id="txtIFSCCode<?=$rowList["ClientID"]?>" autocomplete="off" class="form-control" /></div>
                                                      <div class="col-md-8"><div align="left">Branch</div> <textarea name="txtBankBranch<?=$rowList["ClientID"]?>" id="txtBankBranch<?=$rowList["ClientID"]?>" style="width:100%; height:30px;"  class="form-control"></textarea></div>
                                                    
                                                    </div>
                                                    
                                                    
                                                       <div class="row" style="padding-bottom:10px;">
                                                       <div class="col-md-8"><div align="left">Type of Account</div>
                                                       <input name="txtTypeAccount<?=$rowList["ClientID"]?>" checked="checked" type="radio" id="txtTypeAccount<?=$rowList["ClientID"]?>" value="Saving" onclick="document.getElementById('txtOtherAccount<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');"   /> Saving
                                                &nbsp;&nbsp;&nbsp;<input name="txtTypeAccount<?=$rowList["ClientID"]?>" type="radio" id="txtTypeAccount<?=$rowList["ClientID"]?>" value="Current" onclick="
                                               document.getElementById('txtOtherAccount<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');" />Current&nbsp;&nbsp;&nbsp;
                                                <input name="txtTypeAccount<?=$rowList["ClientID"]?>" type="radio" id="txtTypeAccount<?=$rowList["ClientID"]?>" value="CC" onclick="
                                               document.getElementById('txtOtherAccount<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');" />CC
                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtTypeAccount<?=$rowList["ClientID"]?>" type="radio" id="txtTypeAccount<?=$rowList["ClientID"]?>" value="OD" onclick="
                                               document.getElementById('txtOtherAccount<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');" />OD

                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtTypeAccount<?=$rowList["ClientID"]?>" type="radio" id="txtTypeAccount<?=$rowList["ClientID"]?>" value="Other" onchange="
                                                document.getElementById('txtOtherAccount<?=$rowList["ClientID"]?>').removeAttribute('disabled');" />Other &nbsp;&nbsp;&nbsp;
                                                <input type="text" name="txtOtherAccount<?=$rowList["ClientID"]?>" id="txtOtherAccount<?=$rowList["ClientID"]?>" disabled="disabled"  />
                                                </div>
                                                      
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                      	<input type="hidden" name="ClientID" id="ClientID" value="<?=$rowList["ClientID"]?>" />
                                                        <input type="submit" name="btnAddSubClient" id="btnAddSubClient" class="btn btn-default" value="Submit" />&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </td>
                                <td class="tbl_row">
                                	<button type="button" data-toggle="modal" data-target="#ClientBank<?=$rowList["ClientID"]?>" onclick="
                                    var getValue = $(this).attr('data-target');
                                    var getValue = getValue.substr(1);
                                    document.getElementById('txtCleintID'+getValue).setAttribute('value', getValue); 
                                    " class="button">Add</button>
									<div class="modal fade" id="ClientBank<?=$rowList["ClientID"]?>" role="dialog">
                                      	<div class="modal-dialog">
                                        	<div class="modal-content">
                                          	<div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Add New Bank Details</h4>
                                              <h5 class="modal-title"><?=$rowList["ClientName"]?></h5>
                                            </div>
                                            <div class="modal-body">
                                                 <form id="frmBankDetails1" name="frmBankDetails1" method="post">
                                                    <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-4">
                                                            <div align="left">Name Of Bank</div>
                                                            <?
                                                                $sqlBank ="select * from tblBankMaster order by BankName";
                                                                $resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
                                                                if(mysql_num_rows($resultBank)>0)
                                                                {
                                                            ?>
                                                            <select name="txtBankH<?=$rowList["ClientID"]?>" id="txtBankH<?=$rowList["ClientID"]?>" class="form-control" required>
                                                                <option value="">Select</option>
                                                             <?
                                                                while($rowBank = mysql_fetch_array($resultBank))
                                                                {
                                                            ?>
                                                                     <option value="<?=$rowBank["BankID"]?>"><?=$rowBank["BankName"]?></option>
                                                            <?
                                                                }
                                                            ?>
                                                          </select>
                                                          <?
                                                             }
                                                           ?>
                                                      </div>
                                                      <div class="col-md-4"><div align="left">Account Holder Name</div><input type="text" class="form-control" id="txtAccHolderNameH<?=$rowList["ClientID"]?>" name="txtAccHolderNameH<?=$rowList["ClientID"]?>" value="<?=$rowList["ClientName"]?>" required></div>
                                                      <div class="col-md-4"><div align="left">Branch</div><input type="text" class="form-control" id="txtBankBranchH<?=$rowList["ClientID"]?>" name="txtBankBranchH<?=$rowList["ClientID"]?>" required ></div>
                                                     </div>
                                                    <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-4"><div align="left">Account No.</div><input type="text" class="form-control" id="txtAccountNoH<?=$rowList["ClientID"]?>" name="txtAccountNoH<?=$rowList["ClientID"]?>" required></div>
                                                      <div class="col-md-4"><div align="left">IFSC Code</div><input type="text" class="form-control" id="txtIFSCCodeH<?=$rowList["ClientID"]?>" name="txtIFSCCodeH<?=$rowList["ClientID"]?>" required></div>
                                                      </div>
                                                      <div class="row" style="padding-bottom:10px;">
                                                      <div class="col-md-12" align="left">Type Of Account<br/>
                                                      <input name="txtAccountTypeH<?=$rowList["ClientID"]?>" checked="checked" type="radio" id="txtAccountTypeH<?=$rowList["ClientID"]?>" value="Saving" onclick="document.getElementById('txtOtherAccH<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');"   /> Saving
                                                &nbsp;&nbsp;&nbsp;<input name="txtAccountTypeH<?=$rowList["ClientID"]?>" type="radio" id="txtAccountTypeH<?=$rowList["ClientID"]?>" value="Current" onclick="
                                               document.getElementById('txtOtherAccH<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');" /> Current&nbsp;&nbsp;&nbsp;
                                                <input name="txtAccountTypeH<?=$rowList["ClientID"]?>" type="radio" id="txtAccountTypeH<?=$rowList["ClientID"]?>" value="CC" onclick="
                                               document.getElementById('txtOtherAccH<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');" /> CC
                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtAccountTypeH<?=$rowList["ClientID"]?>" type="radio" id="txtAccountTypeH<?=$rowList["ClientID"]?>" value="OD" onclick="
                                               document.getElementById('txtOtherAccH<?=$rowList["ClientID"]?>').setAttribute('disabled', 'disabled');" /> OD

                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtAccountTypeH<?=$rowList["ClientID"]?>" type="radio" id="txtAccountTypeH<?=$rowList["ClientID"]?>" value="Other" onchange="
                                                document.getElementById('txtOtherAccH<?=$rowList["ClientID"]?>').removeAttribute('disabled');" /> Other &nbsp;&nbsp;&nbsp;
                                                <input type="text" name="txtOtherAccH<?=$rowList["ClientID"]?>" id="txtOtherAccH<?=$rowList["ClientID"]?>" disabled="disabled"  />
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                        <input type="hidden" name="txtCleintID" id="txtCleintID" value="<?=$rowList["ClientID"]?>" />
                                                        <input type="hidden" name="ClientType" id="ClientType" value="Head" />
                                                        <input type="hidden" name="no_refresh" id="no_refresh" value="<?php echo uniqid(rand()); ?>"  />
                                                        <input type="hidden" name="ClientCheck" id="ClientCheck" value="H" />
                                                        <input type="submit" name="btnAddBankDetails" id="btnAddBankDetails" class="btn btn-default" value="Submit" />&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                </form>
                                          	</div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                                <td align="center" bgcolor="#EFEFEF">
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["ClientID"]?>').style.visibility = 'visible'; get_frm('edit_client.php','<?=$rowList["ClientID"]?>','div_<?=$rowList["ClientID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Client Details" title="Edit Client Details"/></a>&nbsp;&nbsp;
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["ClientID"]?>').style.visibility = 'visible'; get_frm('delete_client.php','<?=$rowList["ClientID"]?>','div_<?=$rowList["ClientID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Client Details" title="Delete Client Details"/></a>
                           	  </td>
                            </tr>
                             <?
							 	$sqlChk="select * from tblSubClientMaster where ClientID='".$rowList["ClientID"]."' order by ClientName ";
								$resultChk=mysql_query($sqlChk) or die ("Query Failed ".mysql_error());
								if (mysql_num_rows($resultChk)>0)
								{
									while($rowChk = mysql_fetch_array($resultChk))
									{
							?>
                            <tr>
                             	<td align="right" width="3%" style="padding-right:15px;"><img src="images/arrow_right.png" /><div id="div_<?=$rowChk["SubClientID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                                <td class="tbl_row" align="center" valign="middle" width="3%">
								<a href="#" onClick="return popitup('sub-client-details.php?scid=<?=$rowChk["SubClientID"]?>')"><?=$rowChk["ClientName"]?></a>
								</td>
                              	<td class="tbl_row"></td>
                                <td class="tbl_row"><?=$rowChk["EmailID"]?></td>
                                <td class="tbl_row"><?=$rowChk["PhoneNo"]?><? if($rowChk["MobileNo"]!='' && $rowChk["PhoneNo"]!='') { ?>,<? } ?> <?=$rowChk["MobileNo"]?> </td>
                                <td class="tbl_row"><?=$rowChk["Address"]?> <? if($rowChk["City"]!='' && $rowChk["Address"]!='') { ?>, <? } ?><?=$rowChk["City"]?> </td>
                                <td class="tbl_row"></td>
                                <td class="tbl_row">
                                	<button type="button" data-toggle="modal" data-target="#SubClientBank<?=$rowChk["ClientID"]?>" onclick="
                                var getValue = $(this).attr('data-target');
                                var getValue = getValue.substr(1);
                                document.getElementById('txtCleintID'+getValue).setAttribute('value', getValue); 
                                " class="button">Add</button>
                               		<div class="modal fade" id="SubClientBank<?=$rowChk["ClientID"]?>" role="dialog">
                                    <div class="modal-dialog"><!-- Modal content-->
                                         <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Add New Bank Details</h4>
                                           <h5 class="modal-title"><?=$rowChk["ClientName"]?></h5>
                                        </div>
                                        <div class="modal-body">
                                         <form id="frmBankDetails2" name="frmBankDetails2" method="post">
                                            <div class="row" style="padding-bottom:10px;">
                                              <div class="col-md-4">
                                                    <div align="left">Name Of Bank</div>
                                                    <?
                                                        $sqlBank ="select * from tblBankMaster order by BankName";
                                                        $resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
                                                        if(mysql_num_rows($resultBank)>0)
                                                        {
                                                    ?>
                                                    <select name="txtBankS<?=$rowChk["ClientID"]?>" id="txtBankS<?=$rowChk["ClientID"]?>" class="form-control" required>
                                                        <option value="">Select</option>
                                                     <?
                                                        while($rowBank = mysql_fetch_array($resultBank))
                                                        {
                                                    ?>
                                                             <option value="<?=$rowBank["BankID"]?>"><?=$rowBank["BankName"]?></option>
                                                    <?
                                                        }
                                                    ?>
                                                  </select>
                                                  <?
                                                     }
                                                   ?>
                                              </div>
                                              <div class="col-md-4"><div align="left">Account Holder Name</div><input type="text" class="form-control" id="txtAccHolderNameS<?=$rowChk["ClientID"]?>" name="txtAccHolderNameS<?=$rowChk["ClientID"]?>" required></div>
                                              <div class="col-md-4"><div align="left">Branch</div><input type="text" class="form-control" id="txtBankBranchS<?=$rowChk["ClientID"]?>" name="txtBankBranchS<?=$rowChk["ClientID"]?>" required ></div>
                                             </div>
                                            <div class="row" style="padding-bottom:10px;">
                                              <div class="col-md-4"><div align="left">Account No.</div><input type="text" class="form-control" id="txtAccountNoS<?=$rowChk["ClientID"]?>" name="txtAccountNoS<?=$rowChk["ClientID"]?>" required></div>
                                              <div class="col-md-4"><div align="left">IFSC Code</div><input type="text" class="form-control" id="txtIFSCCodeS<?=$rowChk["ClientID"]?>" name="txtIFSCCodeS<?=$rowChk["ClientID"]?>" required></div>
                                              </div>
                                              <div class="row" style="padding-bottom:10px;">
                                              <div class="col-md-12" align="left">Type Of Account<br/>
                                              <input name="txtAccountTypeS<?=$rowChk["ClientID"]?>" checked="checked" type="radio" id="txtAccountTypeS<?=$rowChk["ClientID"]?>" value="Saving" onclick="document.getElementById('txtOtherAccS<?=$rowChk["ClientID"]?>').setAttribute('disabled', 'disabled');"   /> Saving
                                                &nbsp;&nbsp;&nbsp;<input name="txtAccountTypeS<?=$rowChk["ClientID"]?>" type="radio" id="txtAccountTypeS<?=$rowChk["ClientID"]?>" value="Current" onclick="
                                               document.getElementById('txtOtherAccS<?=$rowChk["ClientID"]?>').setAttribute('disabled', 'disabled');" /> Current&nbsp;&nbsp;&nbsp;
                                                <input name="txtAccountTypeS" type="radio" id="txtAccountTypeS" value="CC" onclick="
                                               document.getElementById('txtOtherAccS<?=$rowChk["ClientID"]?>').setAttribute('disabled', 'disabled');" /> CC
                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtAccountTypeS<?=$rowChk["ClientID"]?>" type="radio" id="txtAccountTypeS<?=$rowChk["ClientID"]?>" value="OD" onclick="
                                               document.getElementById('txtOtherAccS<?=$rowChk["ClientID"]?>').setAttribute('disabled', 'disabled');" /> OD

                                                &nbsp;&nbsp;&nbsp;
                                                <input name="txtAccountTypeS<?=$rowChk["ClientID"]?>" type="radio" id="txtAccountTypeS<?=$rowChk["ClientID"]?>" value="Other" onchange="
                                                document.getElementById('txtOtherAccS<?=$rowChk["ClientID"]?>').removeAttribute('disabled');" /> Other &nbsp;&nbsp;&nbsp;
                                                <input type="text" name="txtOtherAccS<?=$rowChk["ClientID"]?>" id="txtOtherAccS<?=$rowChk["ClientID"]?>" disabled="disabled"  />
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <input type="hidden" name="txtCleintID" id="txtCleintID" value="<?=$rowChk["ClientID"]?>" />
                                                <input type="hidden" name="no_refresh" id="no_refresh" value="<?php echo uniqid(rand()); ?>"  />
                                                <input type="hidden" name="ClientType" id="ClientType" value="SubClient" />
                                                <input type="hidden" name="ClientCheck" id="ClientCheck" value="S" />
                                                <input type="submit" name="btnAddBankDetails" id="btnAddBankDetails" class="btn btn-default" value="Submit" />&nbsp;&nbsp;
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                         </form>
                                         </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td align="center" bgcolor="#EFEFEF">
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowChk["SubClientID"]?>').style.visibility = 'visible'; get_frm('edit_sub_client.php','<?=$rowChk["SubClientID"]?>','div_<?=$rowChk["SubClientID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Client Details" title="Edit Client Details"/></a>&nbsp;&nbsp;
                                  
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowChk["SubClientID"]?>').style.visibility = 'visible'; get_frm('delete-sub-client.php','<?=$rowChk["SubClientID"]?>','div_<?=$rowChk["SubClientID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Client Details" title="Delete Client Details"/></a>
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
<div><a href="#" class="scrollup">Scroll</a></div>
<? include ("inc/footer.php"); ?>