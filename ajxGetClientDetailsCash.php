<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
    <tr>
        <td width="15%" class="loginTxt1">Sub Client</td>
        <td width="35%" colspan="3">
        	<select name="txtSubClient" id="txtSubClient" style="width:130px;" onchange="get_frm4('ajxClientBankForCash.php',this.value,'divClientBank','<?=$id?>');">
             <option value="">Select</option>
                 <?
                    $sqlSC ="select * from tblSubClientMaster where ClientID='".$id."' order by ClientName";
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
    <tr>
        <td class="loginTxt1" width="15%">Re-payment Bank</td>
        <td align="left" width="35%">
        <div id="divClientBank">
        <select name="txtClientBank" id="txtClientBank" style="width:130px;">
			 <?
                    $sqlBank ="select * from tblClientBankMaster where ClientID= '".$id."' and ClientType like 'Head' ";
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
        <td class="loginTxt1" width="15%">Re-payment Cheque No.</td>
        <td align="left" width="35%">
        <input name="txtRepaymentChequeNo" id="txtRepaymentChequeNo" style="width:130px;" type="text" autocomplete="off" required />
        </td>
    </tr>
</table>

    
<?
}
?>