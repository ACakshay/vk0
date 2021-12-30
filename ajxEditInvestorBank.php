<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
    $recID = $_GET["id"];
	$sql= "select * from tblInvestorsBankMaster where RecID=".$recID." ";
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
?>
<form id="frmEditBank" name="frmEditBank" method="post">
<table width="100%" cellpadding="0" cellspacing="0" align="left" border="0" class="myTableR">
   <tr>
        <td class="txtLeft" width="30%">Bank :</td>
        <td class="txtLeft">
        	<?
				$sqlB ="select * from tblBankMaster order by BankName";
				$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
				if(mysql_num_rows($resultB)>0)
				{
			?>
			<select name="txtBank" id="txtBank" style="width:230px;" class="form-control">
				<option value="">Select</option>
			 	<?
					while($rowB = mysql_fetch_array($resultB))
					{
				?>
                    
             <option value="<?=$rowB["BankID"]?>" <? if($rowB["BankID"]==$row["BankID"]){ ?> selected="selected"<? } ?>><?=$rowB["BankName"]?></option>
				<?
					}
				?>
		  </select>
		  <?
			}
	   	  ?>
        </td>
    </tr>
    <tr>
        <td class="txtLeft">Name :</td>
        <td class="txtLeft"><input name="txtAccHolderName" id="txtAccHolderName" type="text" value="<?=$row["AccountHolderName"]?>" autocomplete="off" class="form-control" /></td>
    </tr>
    <tr>
        <td class="txtLeft">Account No. :</td>
        <td class="txtLeft"><input name="txtAccountNumber" type="text" id="txtAccountNumber" autocomplete="off" class="form-control" value="<?=$row["AccountNo"]?>"/></td>
    </tr>
    <tr>
        <td class="txtLeft">Branch :</td>
        <td class="txtLeft"><textarea name="txtBankBranch" id="txtBankBranch" style="width:100%; height:30px;"  class="form-control"><?=$row["BankBranch"]?></textarea></td>
    </tr>
    <tr>
        <td class="txtLeft">IFSC Code :</td>
        <td class="txtLeft"><input type="text" name="txtIFSCCode" id="txtIFSCCode" autocomplete="off" class="form-control" value="<?=$row["IFSCCode"]?>" /></td>
    </tr>
    <tr>
        <td class="txtLeft">Account Type :</td>
        <td class="txtLeft">
        	<input name="txtTypeAccount"  type="radio" id="txtTypeAccount" value="Saving" onclick="document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');" <? if($row["TypeOfAccount"]=='Saving'){ ?> checked <? } ?> /> Saving
            &nbsp;&nbsp;&nbsp;<input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="Current" onclick="
           document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');" <? if($row["TypeOfAccount"]=='Current'){ ?> checked <? } ?> />Current&nbsp;&nbsp;&nbsp;
            <input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="CC" onclick="
           document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');" <? if($row["TypeOfAccount"]=='CC'){ ?> checked <? } ?> />CC
            &nbsp;&nbsp;&nbsp;
            <input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="OD" onclick="
           document.getElementById('txtOtherAccount').setAttribute('disabled', 'disabled');" <? if($row["TypeOfAccount"]=='OD'){ ?> checked <? } ?> />OD

            &nbsp;&nbsp;&nbsp;
            <input name="txtTypeAccount" type="radio" id="txtTypeAccount" value="Other" onchange="
            document.getElementById('txtOtherAccount').removeAttribute('disabled');" />Other &nbsp;&nbsp;&nbsp;
            <input type="text" name="txtOtherAccount" id="txtOtherAccount" disabled="disabled"  />
        </td>
    </tr>
    <tr bgcolor="#f2f2f2">
        <td align="center" colspan="6" height="40px">
            <input type="hidden" name="rec_id" id="rec_id" value="<?=$recID?>" >
            <input name="btnEditBankDetails" type="submit" class="button" id="btnEditBankDetails" value="Submit"/> &nbsp;&nbsp;&nbsp;
            <input name="btnCancel" type="submit" class="button" id="btnCancel" value="Cancel" />
        </td>
    </tr>
</table></form>
<?
}
}
?>