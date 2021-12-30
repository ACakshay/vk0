<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
$id=$_GET["id"];
$sql ="select * from tblClientMaster where ClientID=".$id;
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	$row = mysql_fetch_array($result);
?>
<form id="frmDeleteClient" name="frmDeleteClient" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Delete Client</div>
        	<div style="float:right;"><input type="button" value="" onClick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;">
        	<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0" class="myTableR">
            	<?
					if($row["ClientHead"]!=0)
					{
				?>
                <tr>
                    <td class="loginTxt" width="15%">Head</td>
                    <td class="trow" width="15%" colspan="6"><?=getClientName($row["ClientName"])?></td>
                 </tr>
                <?
					}
				?>
                <tr>
                    <td class="loginTxt" width="15%">Name</td>
                    <td class="trow" width="15%"><?=$row["ClientName"]?></td>
                    <td class="loginTxt" width="15%">Code</td>
                    <td class="trow" width="20%"><?=$row["ClientCode"]?></td>
                    <td class="loginTxt" width="15%">Company</td>
                    <td class="trow" width="20%"><?=$row["ClientCompany"]?></td>
                </tr>
                <tr>
                    <td class="loginTxt">Email</td>
                    <td class="trow"><?=$row["Email"]?></td>
                    <td class="loginTxt">Contact No.</td>
                    <td class="trow"><?=$row["Phone"]?> &nbsp;&nbsp;<?=$row["MobileNo"]?></td>
                     <td class="loginTxt">Address</td>
                    <td class="trow"><?=$row["Address"]?>&nbsp;&nbsp;<?=$row["City"]?></td>
               
                </tr>
                <tr>
                    <td align="center" style="padding:5px;" colspan="6">
                        <input type="hidden" name="txtClientId" id="txtClientId" value="<?=$id?>">
                        <input type="hidden" name="txtClientName" id="txtClientName" value="<?=$row["ClientName"]?>">
                        <input type="submit" value="Yes" name="btnDeleteClient" class="button" id="btnDeleteClient"  >
                        <input type="button" value="No" onclick="document.getElementById('div_<?=$id?>').style.visibility='hidden';" name="btnDeleteNo" class="button" id="btnDeleteNo">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<? }  ?>