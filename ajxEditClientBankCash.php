<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$subClientId = $_GET["id"];
	$clientType = 'SubClient';	
	if($subClientId=='')
	{
		echo $subClientId = $_GET['id2'];
		$clientType = 'Head';	
	}	
?>
	 <select name="txtRepaymentBankE" id="txtRepaymentBankE" style="width:170px;" required>
            <option value="">Select</option>
            <?
                $sqlBank ="select * from tblClientBankMaster where ClientID= '".$subClientId."' and ClientType like '".$clientType."' ";
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
<?
}
?>