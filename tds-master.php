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

if(isset($_POST["btnAddTDS"]))
{
	$format = 'Y-m-d';
	$datevalidTill = date ( $format, strtotime ( '-1 day' . addslashes($_POST["txtDateValidFrom"]) ) );
	$sqlUpdateFreeCoupon = "update tblTDSMaster set ValidTill = '".$datevalidTill."' where ValidTill='0000-00-00'  ";
	$result = mysql_query ($sqlUpdateFreeCoupon) or die ("Error in  query : ".$sqlUpdateFreeCoupon."<br>".mysql_errno()." : ".mysql_error());

	$sqlAdd="insert into tblTDSMaster (TDSPercentage, ValidFrom, ValidTill) values ('".addslashes($_POST["txtTDSPer"])."','".addslashes($_POST["txtDateValidFrom"])."', '0000-00-00') ";
	$resultAdd = mysql_query ($sqlAdd) or die ("Error in  query : ".$sqlAdd."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>TDS </b> Successfully Added!!";
	
}
?>
<form id="frmTDS" name="frmTDS" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">TDS Master</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                    <td class="breadcrumb"><a href="home.php">Dashboard</a>&raquo; &nbsp;Administration &nbsp;&raquo;&nbsp; <b>TDS Master</b></td>
                </tr>
                <tr><td class="message" align="center"><div id="alertMsg"><?=$message?></div></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                                <td valign="top" class="login_head_bg">
                                	<div class="blue_bg" style="float:left;">Add TDS</div>
                                	<div style="text-align:right;"><input type="submit" name="addNewQue" id="addNewQue" value="Add TDS" class="show_hide button_big" /></div>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top">
                                    <div class="productDescription">
                                        
                                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                            <tr align="center">
                                                <td class="loginTxt" width="35%">TDS Percentage</td>
                                                <td align="left" width="15%"><input type="text" id="txtTDSPer" name="txtTDSPer" /></td>
                                                <td class="loginTxt" width="15%">Valid From</td>
                                                <td align="left" width="35%"><input required type="text" name="txtDateValidFrom" id="txtDateValidFrom" style="width:150px;"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmTDS.txtDateValidFrom); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a></td>                                           
                                            </tr>
                                            <tr align="center">
                                            	<td colspan="4">
                                                    <input type="submit" id="btnAddTDS" name="btnAddTDS" value="Add" class="button" onClick="return validatefrmLocation()"/>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
              <tr>
                	<td align="center" valign="top" style="border:1px solid #CCCCCC;">
                        <?
							$sqlList="select * from tblTDSMaster where ValidTill='0000-00-00' ";
							$resultList=mysql_query($sqlList) or die ("Query Failed ".mysql_error());
							if (mysql_num_rows($resultList)>0)
							{
						?>
                        <table width="100%" cellpadding="1" cellspacing="1" align="center" border="0" class="myTable">
                            <tr bgcolor="#EFEFEF">
                                <td class="tbl_head" width="5%"><b>S. No.</b></td>
                                <td class="tbl_head" width="85%"><b>TDS Percentage</b></td>
                                 <td class="tbl_head" width="10%"><b>Edit/Delete</b></td>
                             </tr>
                            <? 
                               $count=1;
                               while($rowList = mysql_fetch_array($resultList))
                               {
                            ?>
                          	<tr>
                                <td class="tbl_row"><?=$count?>.<div id="div_<?=$rowList["BankID"]?>" style="visibility:hidden; background-color: white; border: solid 4px #999999; width:1000px; height:600x; position: fixed; top:20px; left:125px; z-index:1000; padding: 0px;"></div></td>
                                <td class="tbl_row"><?=$rowList["TDSPercentage"]?></td>
                               	<td align="center" bgcolor="#EFEFEF">
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TDSID"]?>').style.visibility = 'visible'; get_frm('edit_bank.php','<?=$rowList["TDSID"]?>','div_<?=$rowList["TDSID"]?>')"><img src="images/iconEdit.gif" border="0" alt="Edit Bank Details" title="Edit Bank Name"/></a>&nbsp;&nbsp;
                                    <a href="javascript:;" onClick="document.getElementById('div_<?=$rowList["TDSID"]?>').style.visibility = 'visible'; get_frm('delete_bank.php','<?=$rowList["TDSID"]?>','div_<?=$rowList["TDSID"]?>')"><img src="images/iconDelete.gif" border="0" alt="Delete Bank Details" title="Delete Bank Name"/></a>
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
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible;z-index:5000; position:absolute; left:-500px; top:0px;"> </iframe>
<? include ("inc/footer.php"); ?>