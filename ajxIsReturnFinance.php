<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
	$message="" ;
$finance_id=$_GET["id"];
if(isset($_GET["id"]))
{
	$sql= "select * from tblFinanceMaster where FinanceID=".$finance_id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Client Details</title>
<link href="inc/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading"> 
        	<div style="float:left;">Return On Date</div>
        	<div style="float:right;"><input type="button" onClick="document.getElementById('div_<?=$finance_id?>').style.visibility='hidden';" class="btnClose"/></div>
        </td>
    </tr>
    <tr>
    	<td align="center"><div id="alertMessage"><?=$message?></div></td>
    </tr>
    <tr>
    	<td align="center" style="padding:7px;" class="red">
        	
            <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
              	<tr>
                	<td class="loginTxt">Client Name</td>
                    <td class="trow"><input name="txtClientName2" id="txtClientName2" type="text" value="<?=getClientName($row["ClientID"])?>" /></td>
                    <td class="loginTxt">Return On Date</td>
                    <td class="trow"><input type="text" name="txtReturnOnDate" id="txtReturnOnDate" style="width:150px;" value="<?=$row["ReturnOnDate"]?>" <? if($row["ReturnOnDate"]!='0000-00-00') { ?> disabled="disabled" <? } ?>/> &nbsp;<? if($row["ReturnOnDate"]=='0000-00-00') { ?><a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.txtReturnOnDate); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a><? } ?>&nbsp;</td>
                </tr>
                <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="FinanceId" id="FinanceId" value="<?=$finance_id?>" >
						<input type="hidden" name="ClientName" id="ClientName" value="<?=getClientName($row["ClientID"])?>" >
                        <input name="btnReturnOnDate" type="submit" class="button" id="btnReturnOnDate" value="Submit" />&nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="button" onClick="document.getElementById('div_<?=$finance_id?>').style.visibility='hidden';" class="button" id="btnCancel" value="Cancel" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?
	}
?>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;">
</iframe>
</body>
</html>
