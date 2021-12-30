<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$trnsStatus=$_GET["id2"];
	
	$where ="";
	if($trnsStatus==0)
	{
		$divID = $id; 
	}else{
		 $divID = $trnsStatus; 
	}
				
?>
<form id="frmCloseTransaction" name="frmCloseTransaction" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Close Transaction</div>
        	<div style="float:right;"><input type="button" onClick="document.getElementById('div_<?=$divID?>').style.visibility='hidden';" class="btnClose" /></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
                 <tr>
                    <td align="right" width="50%">Close</td>
                    <td align="left" width="50%"><input type="checkbox" name="txtIsClose" id="txtIsClose" value="1"  /></td>
                </tr>
                <tr>
                    <td align="center" style="padding:5px;" colspan="3">
                        <input type="hidden" name="txtTransactionID" id="txtTransactionID" value="<?=$id?>">
                        <input type="hidden" name="txtTransactionStatus" id="txtTransactionStatus" value="<?=$trnsStatus?>">
                        <input type="submit" value="Submit" name="btnCloseTrans" class="button" id="btnCloseTrans">
                        <input type="button" value="Cancel" name="btnCancel" class="button" onClick="document.getElementById('div_<?=$divID?>').style.visibility='hidden';" id="btnCancel">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? } ?>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>