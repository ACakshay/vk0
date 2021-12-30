<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
	$id=$_GET["id"];
	$sql= "select * from tblFinanceMaster where FinanceID=".$id;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
    	<td valign="top" class="heading">
        	<div style="float:left;">Edit Finance</div>
        	<div style="float:right;"><input type="submit" value="" onClick="window.close()" class="btnClose"/></div>
        </td>
    </tr>
    <tr><td class="message" align="center"><div id="alertEdit"></div></td></tr>
    <tr>
    	<td align="center" style="padding:7px;" class="red">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" style="border:2px solid #f4f4f4;">
                <tr>
                    <td class="loginTxt">Investment</td>
                    <td align="left"class="trow">
					<?
						$invesId1= getInvestorFromInvestment();
						$sqlI ="select investor.*,investment.* from  tblInvestmentMaster as investment INNER JOIN tblInvestorMaster as investor  ";
						$sqlI = $sqlI."ON investment.InvestorID=investor.InvestorID where investor.InvestorHead='0' ";
						$resultI = mysql_query ($sqlI) or die ("Error in  query : ".$sqlI."<br>".mysql_errno()." : ".mysql_error());
						if(mysql_num_rows($resultI)>0)
						{
					?>
					 <select name="txtInvestment1" id="txtInvestment1" style="width:150px;" >
					 <option value="">Select</option>
					<?
					
			
								while($rowI = mysql_fetch_array($resultI))
								{
						?>
							<option value="<?=$rowI["InvestmentID"]?>"<? if($rowI["InvestmentID"]==$row["InvestmentID"]) { ?> selected="selected"<? } ?>><?=getInvestorName($rowI["InvestorID"])?></option>
						<?
								}
							
						
						?>
					</select>
					<?
						}
					?>
                    </td>
                    <td class="loginTxt">Client Name</td>
                    <td align="left" class="trow">
                     <?
						
						$sqlC ="select * from tblClientMaster ";
						$resultC = mysql_query ($sqlC) or die ("Error in  query : ".$sqlC."<br>".mysql_errno()." : ".mysql_error());
								if(mysql_num_rows($resultC)>0)
								{
						?>
						  <select name="txtClientName1" id="txtClientName1" style="width:150px;" >
						 <option value="">Select</option>
						<?
						
				
									while($rowC = mysql_fetch_array($resultC))
									{
							?>
								<option value="<?=$rowC["ClientID"]?>" <? if($rowC["ClientID"]==$row["ClientID"]){?> selected="selected" <? } ?>><?=$rowC["ClientName"]?></option>
							<?
									}
								
							
							?>
						</select>
						<?
							}
						?>
                    
                    </td>
                    <td class="loginTxt">Finance Amount</td>
                    <td align="left" class="trow"><input type="text" id="txtFinacneAmt1" name="txtFinacneAmt1" value="<?=$row["Amount"]?>" /></td>
                </tr>
                <tr>
                    <td class="loginTxt">Finance Date</td>
                    <td align="left"><input type="text" name="txtFinanceDate1" id="txtFinanceDate1" style="width:150px;" value="<?=$row["FinanceDate"]?>"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.txtFinanceDate1); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a></td>
                    <td class="loginTxt" valign="top">Finance Percent</td>
                    <td align="left" valign="top"><input type="text" id="txtFinacnePercent1" name="txtFinacnePercent1" value="<?=$row["Percent"]?>" /></td>
                    <td class="loginTxt" valign="top">Due Date</td>
                    <td align="left" valign="top"><input type="text" name="txtFReturnDate1" id="txtFReturnDate1" style="width:150px;" value="<?=$row["ReturnDate"]?>"/>&nbsp;<a href="javascript:void(0)" onClick="gfPop.fPopCalendar(document.frmGiveFinance.txtFReturnDate1); return false;" HIDEFOCUS><img name="popcal" align="absbottom" src="calendar/calbtn.gif" height="22" width="20" border="0" alt=""></a></td>
                </tr>
                <tr bgcolor="#f2f2f2">
                    <td align="center" colspan="6" height="40px">
                        <input type="hidden" name="financeID" id="financeID" value="<?=$id?>">
                        <input name="btnEditFinance" type="submit" class="button" id="btnEditFinance" value="Submit" onClick="return validateEditForm()" />&nbsp;&nbsp;&nbsp;
                        <input name="btnCancel" type="submit" class="button" id="btnCancel" value="Cancel" />
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