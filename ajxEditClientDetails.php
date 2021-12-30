<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$chq_chk = $_GET["id"];
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
    <tr>
        <td class="loginTxt1" width="12%">Sub Client</td>
        <td align="left" width="88%" colspan="5">
            <select name="txtSubClientE" id="txtSubClientE" style="width:170px;" onchange="get_frm4('ajxEditClientBankDetails.php',this.value,'EditClientBankDetails','<?=$chq_chk?>');">
                <option value="">Select</option>
                 <?
					$sqlSC ="select * from tblSubClientMaster where ClientID='".$chq_chk."' order by ClientName";
					$resultSC = mysql_query ($sqlSC) or die ("Error in  query : ".$sqlSC."<br>".mysql_errno()." : ".mysql_error());
					if(mysql_num_rows($resultSC)>0)
					{
					 	while($rowSC = mysql_fetch_array($resultSC))
						{
				?>
                        <option value="<?=$rowSC["SubClientID"]?>" ><?=$rowSC["ClientName"]?></option>
                <? } } ?>
				
        </select>
        </td>
    </tr>
    <tr id="EditClientBankDetails">
        <td class="loginTxt1" width="12%">Re-payment Bank</td>
        <td align="left" width="25%">
            <div id="divClientBank">
                <select name="txtRepaymentBankE" id="txtRepaymentBankE" style="width:170px;" required>
                    <option value="">Select</option>
                    <?
						$sqlBank ="select * from tblClientBankMaster where ClientID= '".$chq_chk."' and ClientType like 'Head' ";
						$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
						if(mysql_num_rows($resultBank)>0)
						{
							while($rowBank = mysql_fetch_array($resultBank))
							{
					?>
							<option value="<?=$rowBank["RecID"]?>"><?=getBankName($rowBank["BankID"])?></option>
					<?
							}
						}
					?>
            </select>
            </div>
        </td>	
        <td class="loginTxt1" width="12%">Interest Bank</td>
        <td align="left" width="20%">
          <div id="divClientBank1">
          <select name="txtInterestBankE" id="txtInterestBankE" style="width:170px;" required>
                    <option value="">Select</option>
                    <?
						$sqlBank1 ="select * from tblClientBankMaster where ClientID= '".$chq_chk."' and ClientType like 'Head' ";
						$resultBank1 = mysql_query ($sqlBank1) or die ("Error in  query : ".$sqlBank1."<br>".mysql_errno()." : ".mysql_error());
						if(mysql_num_rows($resultBank1)>0)
						{
							while($rowBank1 = mysql_fetch_array($resultBank1))
							{
					?>
							<option value="<?=$rowBank1["RecID"]?>"><?=getBankName($rowBank1["BankID"])?></option>
					<?
							}
						}
					?>
            </select>
            </div>
        </td>
        <td class="loginTxt1" width="11%">Commission Bank</td>
        <td align="left" width="20%">
            <div id="divClientBank2">
                <select name="txtCommissionBankE" id="txtCommissionBankE" style="width:170px;" required>
                    <option value="">Select</option>
                    <?
						$sqlBank2 ="select * from tblClientBankMaster where ClientID= '".$chq_chk."' and ClientType like 'Head' ";
						$resultBank2 = mysql_query ($sqlBank2) or die ("Error in  query : ".$sqlBank2."<br>".mysql_errno()." : ".mysql_error());
						if(mysql_num_rows($resultBank2)>0)
						{
							while($rowBank2 = mysql_fetch_array($resultBank2))
							{
					?>
							<option value="<?=$rowBank2["RecID"]?>"><?=getBankName($rowBank2["BankID"])?></option>
					<?
							}
						}
					?>
            </select>
            </div>
        </td>	
    </tr>
</table>
<?
	}
?>	
