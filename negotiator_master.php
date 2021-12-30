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
if(isset($_POST["btnAddNegotiator"]))
{
	if($_POST["no_refresh"]==$_SESSION["no_refresh"])
	{
		$message = "<b>WARRNING : </b>Please do not Refresh the Page";
	
	}else{
		$_SESSION["no_refresh"]=$_POST["no_refresh"];	
		$sqlAdd="insert into tblNegotiatorMaster (NegotiatorName, PANNo, City, Address) values ('".ucwords(addslashes($_POST["txtNegotiatorName"]))."', ";
		$sqlAdd =$sqlAdd. "  '".strtoupper(addslashes($_POST["txtPANNo"]))."', '".addslashes($_POST["txtCity"])."', '".addslashes($_POST["txtAddress"])."')";
		$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
		$rec_id= mysql_insert_id();
		$message="<b>".ucwords(addslashes($_POST["txtNegotiatorName"]))."</b> Successfully Added!!";
	}
}
if(isset($_POST["btnEditNegotiator"]))
{	
	$sqlEdit="update tblNegotiatorMaster set NegotiatorName='".addslashes($_POST["txtName1"])."' , PANNo='".addslashes($_POST["txtPAN1"])."' , City='".addslashes($_POST["txtCity1"])."' , Address='".addslashes($_POST["txtAdd1"])."'  where NegotiatorID = ".$_POST["NegotiatorID"];
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".$_POST["txtName1"]."</b> Successfully Edited!!"; 
}
if(isset($_POST["btnDeleteYes"]))
{
	$sql = "delete from tblNegotiatorMaster where NegotiatorID = ".$_POST["NegotiatorID"];
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["txtNegotiatorName"]."</b> Successfully Deleted!!";
}


?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Negotiator Master</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Administration &nbsp;&raquo;&nbsp; <b>Negotiator Master</b></td>
                </tr>
                <tr><td class="message" align="center"><div id="alertMsg"><?=$message?></div></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                                <td valign="top" class="login_head_bg">
                                	<div class="blue_bg" style="float:left;">Add Negotiator</div>
                                	<div style="text-align:right;"><input type="submit" name="addNewQue" id="addNewQue" value="Add Negotiator" class="show_hide button_big" /></div>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top">
                                	<div class="productDescription">
                                    <form id="frmNegotiator" name="frmNegotiator" method="post">
										<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                             <tr>
                                                <td class="loginTxt">Name</td>
                                                <td align="left"><input name="txtNegotiatorName" id="txtNegotiatorName" type="text" autocomplete="off" required /></td>
                                                <td class="loginTxt">PAN No.</td>
                                                <td align="left"><input name="txtPANNo" id="txtPANNo" type="text" autocomplete="off" /></td>
                                                <td class="loginTxt">City</td>
                                                <td align="left"><input name="txtCity" id="txtCity" type="text" autocomplete="off" required /></td>
                                            </tr>
                                            <tr>
                                                <td class="loginTxt">Address</td>
                                                <td align="left" colspan="5"><textarea name="txtAddress" id="txtAddress" style="width:60%;" rows="1" ></textarea></td>
                                            </tr>
                                            <tr>
                                                <td align="center" colspan="6">
                                                	<input type="hidden" name="no_refresh" id="no_refresh" value="<?php echo uniqid(rand()); ?>"  />
                                                    <input type="submit" id="btnAddNegotiator" name="btnAddNegotiator" value="Add" class="button" />
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
									$sqlS="select * from tblNegotiatorMaster order by NegotiatorName";
                    				$resultS=mysql_query($sqlS) or die ("Query Failed ".mysql_error());
									if (mysql_num_rows($resultS)>0)
									{
										while($rowS = mysql_fetch_array($resultS))
										{
								?>
                                     <option value="<?=$rowS["NegotiatorID"]?>"><?=$rowS["NegotiatorName"]?></option>
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
						$where ="where NegotiatorID ='".$_POST["txtSearch"]."' ";
					}
					$sqlList="select * from tblNegotiatorMaster $where order by NegotiatorName";
					$resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
					if (mysql_num_rows($resultList)>0)
					{
				?>
                <tr>
                	<td align="center" valign="top" style="border:1px solid #CCCCCC;">
                        <table width="100%" cellpadding="1" cellspacing="1" align="center" border="0" class="myTableR">
                            <tr bgcolor="#EFEFEF">
                                <td class="tableHead" width="5%"><b>S. No.</b></td>
                                <td class="tableHead" width="14%"><b>Name</b></td>
                                <td class="tableHead" width="8%"><b>PANNo</b></td>
                                <td class="tableHead" width="13%"><b>Address</b></td>
                                <td class="tableHead" width="10%"><b>Edit/Delete</b></td>
                          </tr>
                            <?
                            		$count=1;
                                	while($rowList = mysql_fetch_array($resultList))
                                	{
							 ?>
                            <tr  bgcolor="#EFEFEF">
                                <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowList["NegotiatorID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                                <td class="tbl_row"><?=$rowList["NegotiatorName"]?></td>
                                <td class="tbl_row"><?=$rowList["PANNo"]?></td>
                                <td class="tbl_row"><?=$rowList["Address"]?><? if($rowList["City"]!='' && $rowList["Address"]!='') { ?> , <? } ?><?=$rowList["City"]?></td>
                                <td align="center" bgcolor="#EFEFEF">
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["NegotiatorID"]?>').style.visibility = 'visible'; get_frm('edit_negotiator.php','<?=$rowList["NegotiatorID"]?>','div_<?=$rowList["NegotiatorID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Client Details" title="Edit Client Details"/></a>&nbsp;&nbsp;
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["NegotiatorID"]?>').style.visibility = 'visible'; get_frm('delete_negotiator.php','<?=$rowList["NegotiatorID"]?>','div_<?=$rowList["NegotiatorID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Client Details" title="Delete Client Details"/></a>
                           	  </td>
                            </tr>
                            <?
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