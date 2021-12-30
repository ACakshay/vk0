<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
    $id=$_GET["id"];
	$sql ="select * from tblNegotiatorMaster where NegotiatorID=".$id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);

?>

<form id="frmDeleteNegotiator" name="frmDeleteNegotiator" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="popupHeading"> 
        	<div style="float:left;">Delete Negotiator</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden'; " class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" valign="top">
        	<table width="100%" cellpadding="3" cellspacing="10" align="center" border="0" class="myTableR">
            	<tr>
                    <td class="loginTxt" width="15%">Name</td>
                     <td class="trow" width="20%"><?=$row["NegotiatorName"]?></td>
                     <td class="loginTxt" width="15%">PAN No.</td>
					  <td class="trow" width="20%"> <?=$row["PANNo"]?></td>
                      <td class="loginTxt" width="15%">City</td>
					   <td class="trow" width="20%"> <?=$row["City"]?></td>
                </tr>
                <tr>
                    <td class="loginTxt" valign="top" width="15%">Address</td>
					  <td class="trow" width="20%"> <?=$row["Address"]?></td>
                </tr>

                <tr bgcolor="#F4F4F4">
                    <td align="center" colspan="6">
                           <input type="hidden" name="NegotiatorID" id="NegotiatorID" value="<?=$id?>">
                        <input type="hidden" name="txtNegotiatorName" id="txtNegotiatorName" value="<?=$row["NegotiatorName"]?>">
                        <input type="submit" value="Yes" name="btnDeleteYes" class="button" id="btnDeleteYes"  >
                        <input type="button" value="No" onclick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" name="btnDeleteNo" class="button" id="btnDeleteNo">

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<?
	}
}
?>
