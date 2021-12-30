<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	if($id!='')
	{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>".$id."</b>&nbsp;&nbsp;&nbsp;&nbsp;";
	if($id=='Client')
	{
?>
	<select name="txtDetails" id="txtDetails" style="width:150px;" required > 
         <option value="">Select</option>
             <?
				$sqlC ="select * from tblClientMaster ";
				$resultC = mysql_query ($sqlC) or die ("Error in  query : ".$sqlC."<br>".mysql_errno()." : ".mysql_error());
				if(mysql_num_rows($resultC)>0)
				{
					while($rowC = mysql_fetch_array($resultC))
					{
			?>
                <option value="<?=$rowC["ClientID"]?>" ><?=$rowC["ClientName"]?></option>
           <? } } ?>
    </select>
<?
	}elseif($id=='Investor'){
?>
	<select name="txtDetails" id="txtDetails" style="width:150px;" required> 
        <option value="">Select</option>
         <?
            $sqlInves ="select * from tblInvestorMaster";
            $resultInves = mysql_query ($sqlInves) or die ("Error in  query : ".$sqlInves."<br>".mysql_errno()." : ".mysql_error());
            if(mysql_num_rows($resultInves)>0)
            {
                while($rowInves = mysql_fetch_array($resultInves))
                {
          ?>
                <option value="<?=$rowInves["InvestorID"]?>" ><?=$rowInves["InvestorName"]?></option>
    	<? } } ?>
  </select>
<?
	}elseif($id=='Negotiator'){
?>
	<select name="txtDetails" id="txtDetails" style="width:150px;" required> 
        <option value="">Select</option>
         <?
            $sqNeg ="select * from tblNegotiatorMaster";
            $resultNeg = mysql_query ($sqNeg) or die ("Error in  query : ".$sqNeg."<br>".mysql_errno()." : ".mysql_error());
            if(mysql_num_rows($resultNeg)>0)
            {
                while($rowNeg = mysql_fetch_array($resultNeg))
                {
          ?>
                <option value="<?=$rowNeg["NegotiatorID"]?>" ><?=$rowNeg["NegotiatorName"]?></option>
    	<? } } ?>
  </select>
<?
	}
	}
?>
&nbsp;&nbsp;<input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" class="button"/>
<?
}
?>