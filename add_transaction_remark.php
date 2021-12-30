<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$trnsStatus = $_GET["id2"];
	$where ="";
	if($trnsStatus==0)
	{
		$tbl = 'tblTransactionMaster';
		$divID = $id; 
	}else{
		 $tbl = 'tblExtendedTransaction'; $divID = $trnsStatus; 
		 $where = "and RecID='".$trnsStatus."' ";
	}
	
	$sqlTrans ="select Remark from ".$tbl." where TransactionID=".$id." ".$where." ";
	$resultTrans = mysql_query ($sqlTrans) or die ("Error in  query : ".$sqlTrans."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultTrans)>0)
	{
		$rowTrans = mysql_fetch_array($resultTrans);			
?>
<form id="frmAddRemark" name="frmAddRemark" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Add Remark</div>
        	<div style="float:right;"><input type="button" onClick="document.getElementById('div_<?=$divID?>').style.visibility='hidden';" class="btnClose" /></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
                 <tr>
                    <td align="right" width="30%">Remark</td>
                    <td align="left" width="70%"><textarea id="txtRemark" name="txtRemark" style="width:60%" rows="1"><?=$rowTrans["Remark"]?></textarea></td>
                </tr>
                <tr>
                    <td align="center" style="padding:5px;" colspan="3">
                        <input type="hidden" name="txtTransactionID" id="txtTransactionID" value="<?=$id?>">
                        <input type="hidden" name="txtTransactionStatus" id="txtTransactionStatus" value="<?=$trnsStatus?>">
                        <input type="submit" value="Submit" name="btnAddRemark" class="button" id="btnAddRemark">
                        <input type="button" value="Cancel" name="btnCancel" class="button" onClick="document.getElementById('div_<?=$divID?>').style.visibility='hidden';" id="btnCancel">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? } } ?>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>