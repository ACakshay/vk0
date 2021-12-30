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
if(isset($_POST["btnAddUser"]))
{
	if($_POST["no_refresh"]==$_SESSION["no_refresh"])
	{
		$message = "<b>WARRNING : </b>Please do not Refresh the Page!!";
	
	}else{
		$_SESSION["no_refresh"]=$_POST["no_refresh"];  
		$sqlAdd="insert into tblLoginMaster (UserName,UserEmail,LoginId,Password,LoginType) values ('".addslashes($_POST["txtUserName"])."', ";
		$sqlAdd=$sqlAdd." '".addslashes($_POST["txtEmail"])."','".addslashes($_POST["txtLoginId"])."','".addslashes($_POST["txtPassword"])."', ";
		$sqlAdd=$sqlAdd." '".addslashes($_POST["txtLoginType"])."') ";
		$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
		$message="<b>".$_POST["txtUserName"]."</b> Successfully Added!!";
	}
}
if(isset($_POST["btnEditUser"]))
{ 
 	$sqlEdit="update tblLoginMaster set UserName='".addslashes($_POST["txtUserName"])."',UserEmail='".addslashes($_POST["txtEmail"])."', ";
	$sqlEdit=$sqlEdit." LoginId='".addslashes($_POST["txtLoginId"])."',Password='".addslashes($_POST["txtPassword"])."',LoginType= ";
	$sqlEdit=$sqlEdit." '".addslashes($_POST["txtLoginType"])."'  where rec_id = ".$_POST["txtRecId"];
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".$_POST["txtUserName"]."</b> Successfully Edited!!";  
}
if(isset($_POST["btnDeleteYes"]))
{
	$sql = "delete from tblLoginMaster where rec_id = ".$_POST["txtRecId"];
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	$message="<b>".$_POST["txtUserName"]."</b> Successfully Deleted!!";

}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">User Master</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Administration &nbsp;&raquo;&nbsp; <b>User Master</b></td>
                </tr>
                <tr><td class="message" align="center"><div id="alertMsg"><?=$message?></div></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <form id="frmUser" name="frmUser" method="post">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                                <td valign="top" class="login_head_bg">
                                	<div class="blue_bg" style="float:left;">Add User</div>
                                	<div style="text-align:right;"><input type="submit" name="addNewQue" id="addNewQue" value="Add User" class="show_hide button_big" /></div>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top">
                                    <div class="productDescription">
                                        
                                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                            <tr align="center">
                                                <td class="loginTxt" width="15%">User Name</td>
                                                <td class="trow" width="20%"><input type="text" id="txtUserName" name="txtUserName" /></td>
                                                <td class="loginTxt" width="15%">Email</td>
                                                <td class="trow" width="20%"><input type="text" id="txtEmail" name="txtEmail" /></td>
                                                <td class="loginTxt" width="15%">Login Id</td>
                                                <td class="trow" width="15%"><input type="text" id="txtLoginId" name="txtLoginId" /></td>
                                            </tr>
                                            <tr align="center">
                                                <td class="loginTxt">Password</td>
                                                <td class="trow"><input type="text" id="txtPassword" name="txtPassword" /></td>
                                                <td class="loginTxt">Login Type</td>
                                                <td class="trow" colspan="3"><input type="radio" id="txtLoginType" name="txtLoginType" value="1" />Admin &nbsp;<input type="radio" id="txtLoginType" name="txtLoginType" checked="checked" value="0" />User</td>
                                            </tr>
                                            <tr align="center">
                                            	<td colspan="6">
                                                	<input type="hidden" name="no_refresh" id="no_refresh" value="<?php echo uniqid(rand()); ?>"  />
                                                    <input type="submit" id="btnAddUser" name="btnAddUser" value="Add User" class="button"/>
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
                <tr><td height="5px;">&nbsp;</td></tr>
                <tr>
                	<td align="center" valign="top" style="border:1px solid #CCCCCC;">
                        <?
							$sqlList="select * from tblLoginMaster order by UserName";
							$resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
							if (mysql_num_rows($resultList)>0)
							{
						?>
                        <table width="100%" cellpadding="5" cellspacing="1" align="center" border="0" class="myTableR">
                            <tr bgcolor="#EFEFEF">
                                <td class="tableHead" width="10%"><b>S. No.</b></td>
                                <td class="tableHead" width="15%"><b>User</b></td>
                                <td class="tableHead" width="15%"><b>Email</b></td>
                                <td class="tableHead" width="15%"><b>Login</b></td>
                                <td class="tableHead" width="15%"><b>Password</b></td>
                                 <td class="tableHead" width="15%"><b>Login Type</b></td>
                                <td class="tableHead" width="15%"><b>Edit/Delete</b></td>
                             </tr>
                            <? 
                                $count=1;
                                while($rowList = mysql_fetch_array($resultList))
                                {
                            ?>
                          	<tr>
                                <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowList["rec_id"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:800px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                                <td class="tbl_row"><?=$rowList["UserName"]?></td>
                                <td class="tbl_row"><?=$rowList["UserEmail"]?></td>
                                <td class="tbl_row"><?=$rowList["LoginId"]?></td>
                                <td class="tbl_row"><?=$rowList["Password"]?></td>
                                <td class="tbl_row"><? if($rowList["LoginType"]==0) { ?>User<? }else{ ?>Admin<? }?></td>
                               	<td align="center" bgcolor="#EFEFEF">
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["rec_id"]?>').style.visibility = 'visible'; get_frm('edit_user.php','<?=$rowList["rec_id"]?>','div_<?=$rowList["rec_id"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Bank Details" title="Edit Bank Name"/></a>&nbsp;&nbsp;
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["rec_id"]?>').style.visibility = 'visible'; get_frm('delete_user.php','<?=$rowList["rec_id"]?>','div_<?=$rowList["rec_id"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Bank Details" title="Delete Bank Name"/></a>
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
<div><a href="#" class="scrollup">Scroll</a></div>
<? include ("inc/footer.php"); ?>