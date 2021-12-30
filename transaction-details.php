<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<?
	$flagPost = 0;
	$investorId = $_GET["iid"];
	$sql= "select * from tblInvestorMaster where InvestorID=".$investorId;
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
?>
<div class="container">
  <div class="page-header">
  	<img src="images/logo1.png" alt="" width="150px;" class="img-thumbnail center-block">
  	</div>
   <table class="table table-bordered table-sm">
      <thead class="thead-inverse">
        <tr>
          <th colspan="6" class="text-center">Investor Details</th>
       </tr>
      </thead>
      <tbody>
        <tr>
          <td width="10%">Name</td>
          <td width="25%"><?=$row["InvestorName"]?></td>
          <td width="10%">Code</td>
          <td width="25%"><?=$row["InvestorCode"]?></td>
          <td width="10%">Company</td>
          <td width="25%"><?=$row["InvestorCompany"]?></td>
        </tr>
        <tr>
          <td>Contact No.</td>
          <td><?=$row["Phone"]?></td>
          <td>Email</td>
          <td><?=$row["Email"]?></td>
          <td>City</td>
          <td><?=$row["City"]?></td>
        </tr>
        <tr>
          <td>Address</td>
          <td colspan="5"><?=$row["Address1"]?></td>
        </tr>
        <?
			$sqlB = "select * from tblInvestorsBankDetailsMaster where InvestorID=".$investorId;
			$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
			if(mysql_num_rows($resultB)>0)
			{
				
		?>
        <tr>
          <td colspan="6"><b>Bank Details</b></td>
        </tr>
        <tr>
        	<?
				$count = 1;
				while($rowB = mysql_fetch_array($resultB))
				{
			?>
                  <td colspan="2">
				  Bank : <? echo $bankName= getBankName($rowB["BankID"]); ?><br/>
                  Name : <?=$rowB["AccountHolderName"]?><br/>
                  Account No :  <?=$rowB["AccountNo"]?><br/>
                  Branch :  <?=$rowB["BankBranch"]?><br/>
                  IFSC Code :  <?=$rowB["IFSCCode"]?><br/>
                  Account Type : <?=$rowB["TypeOfAccount"]?><br/>
                 </td>
           <?
			 		$count++;
					if($count=='4')
					{
						$count=1;
				?>
                	<tr></tr>
                    
                <?
					}
				}
			?>
        </tr>
        <?
			}
		?>
      </tbody>
</table>
</div>
<?
	}
?>
