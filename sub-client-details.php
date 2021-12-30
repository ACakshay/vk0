<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body { margin:0px; padding:0px; }
.slipHead { background:#333333; font-family:Arial, Helvetica, sans-serif; font-size:20px; text-align:center; color:#fff; font-weight:bold; line-height:40px; text-transform:uppercase; }
.txtRight { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#333333; font-weight:normal; padding-right:10px; line-height:25px; }
.txtRight span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#333333; font-weight:bold; padding-right:10px; line-height:25px; }
.txtLeft { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#333333; font-weight:normal; padding-left:10px; line-height:25px; }
.txtLeft span { font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#333333; font-weight:bold; padding-left:10px; line-height:25px; }
.myTableR { border-collapse:collapse; }
.myTableR td, table.myTableR tr { border:1px solid #cccccc; padding:5px;}
.myTable td, table.myTable tr { border:0px!important; padding:2px;}
</style>
<?
if(isset($_POST["btnEditBank"]))
{	
	$sqlEdit="update tblClientBankMaster set BankID='".addslashes($_POST["txtBank"])."', AccountHolderName='".addslashes($_POST["txtAccHolderName"])."', ";
	$sqlEdit=$sqlEdit." AccountNo='".addslashes($_POST["txtAccountNumber"])."' , IFSCCode='".addslashes($_POST["txtIFSCCode"])."', ";
	$sqlEdit=$sqlEdit." TypeOfAccount='".addslashes($_POST["txtTypeAccount"])."' , BankBranch='".addslashes($_POST["txtBankBranch"])."' ";
	$sqlEdit=$sqlEdit." where RecID = ".$_POST["client_bank_id"];
	$resultEdit = mysql_query ($sqlEdit) or die ("Error in  query : ".$sqlEdit."<br>".mysql_errno()." : ".mysql_error());
 	$message="<b>".$_POST["txtAccHolderName"]."</b> Successfully Edited!!"; 
}
if(isset($_POST["btnDeleteSubClient"]))
{
	$rec_id = $_POST["txtSubClientId"];
	$sqlC="select ClientID from tblTransactionMaster where ClientID = '".$rec_id."' ";
	$resultC=mysql_query($sqlC) or die ("Query Failed ".mysql_error());
	if (mysql_num_rows($resultC)==0)
	{
		$sqlLoc= "delete from tblSubClientMaster where SubClientID=".$rec_id;
		$resultLoc = mysql_query ($sqlLoc) or die ("Error in  query : ".$sqlLoc."<br>".mysql_errno()." : ".mysql_error());
	
		$sqlB= "delete from tblClientBankMaster where ClientID=".$rec_id." and ClientType like 'SubClient' ";
		$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
		
		$message="<b>".$_POST["txtClientName"]."</b> Successfully Deleted!!";
	}else{ $message="<b>".$_POST["txtClientName"]."</b> can't be deleted, transaction exist!!"; }
}


	$sub_clientid = $_GET["scid"];
	$sql= "select * from tblSubClientMaster where SubClientID='".$sub_clientid."' ";
	$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result);
?>
<table width="100%" cellpadding="5" cellspacing="0" align="center">
	<tr><td align="center" style="padding:10px;"><img src="images/logo1.png" alt="" width="100px"></td></tr>
    <tr>
    	<td class="slipHead">Sub Client Details</td>
    </tr>
    <tr>
    	<td align="center" valign="top">
        	<table width="100%" cellpadding="10" cellspacing="0" align="center" border="0" class="myTableR">
            	 <tr bgcolor="#DDEBF9">
                    <td class="txtLeft" style="font-size:16px; text-align:center; font-weight:bold;" width="15%" colspan="4"><b><?=getClientName($row["ClientID"])?></b></td>
                </tr>
                <tr>
                	<td class="txtLeft" width="15%">Name</td>
                    <td class="txtLeft" width="35%"><b><?=$row["ClientName"]?></b></td>
                    <td class="txtLeft" width="15%">Email</td>
                    <td class="txtLeft" width="35%"><?=$row["EmailID"]?></td>
                </tr>
                <tr>
                	<td class="txtLeft">Contact No.</td>
                    <td class="txtLeft"><?=$row["PhoneNo"]?><? if($row["MobileNo"]!=''){echo ",&nbsp;".$row["MobileNo"];} ?></td>
                	<td class="txtLeft">PAN No.</td>
                    <td class="txtLeft"><?=$row["PANNo"]?></td>
                </tr>
                <tr>
                    <td class="txtLeft">Address</td>
                    <td class="txtLeft" colspan="3"><?=$row["Address"]?><? if($row["City"]!=''){echo ",&nbsp;".$row["City"];} ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td align="center" valign="top">
        	<table width="100%" cellpadding="10" cellspacing="0" align="center" border="0">
                <?
					$sqlB = "select * from tblClientBankMaster where ClientID=".$sub_clientid." and ClientType like 'SubClient' ";
					$resultB = mysql_query ($sqlB) or die ("Error in  query : ".$sqlB."<br>".mysql_errno()." : ".mysql_error());
					if(mysql_num_rows($resultB)>0)
					{
				?>
                <tr bgcolor="#e2e2e2">
                    <td class="txtLeft" colspan="4"><span>Bank Details</span></td>
                </tr>
                <tr>
					<?
                    $count = 1;
                    while($rowB = mysql_fetch_array($resultB))
                    {
                   ?>
                    	<td align="left" width="50%" valign="top">
                        <div id="divBank<?=$rowB["RecID"]?>">
                        <table width="100%" cellpadding="0" cellspacing="0" align="left" border="0" class="myTableR">
                           <tr>
                                <td width="30%" class="txtLeft">Bank :</td>
                                <td class="txtLeft">
                                <div style="float:left; font-weight:bold;"><? echo $bankName= getBankName($rowB["BankID"]); ?></div>
                                <div style="text-align:right;">
                                <a href="javascript:;" onClick="document.getElementById('divBank<?=$rowB["RecID"]?>').style.visibility = 'visible'; get_frm('ajxEditSubClientBank.php','<?=$rowB["RecID"]?>','divBank<?=$rowB["RecID"]?>')">
                                
                                
                                <a href="javascript:;" onclick="get_frm('ajxEditClientBank.php','<?=$rowB["RecID"]?>','divBank<?=$rowB["RecID"]?>')"><img src="images/iconEdit.gif"/></a> &nbsp; 
                               	<a href="javascript:;" onclick="get_frm('ajxDeleteClientBank.php','<?=$rowB["RecID"]?>','divBank<?=$rowB["RecID"]?>')"><img src="images/iconDelete.gif"/></a>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txtLeft">Name :</td>
                                <td class="txtLeft"><?=$rowB["AccountHolderName"]?></td>
                            </tr>
                            <tr>
                                <td class="txtLeft">Account No. :</td>
                                <td class="txtLeft"><?=$rowB["AccountNo"]?></td>
                            </tr>
                            <tr>
                                <td class="txtLeft">Branch :</td>
                                <td class="txtLeft"><?=$rowB["BankBranch"]?></td>
                            </tr>
                            <tr>
                                <td class="txtLeft">IFSC Code :</td>
                                <td class="txtLeft"><?=$rowB["IFSCCode"]?></td>
                            </tr>
                            <tr>
                                <td class="txtLeft">Account Type :</td>
                                <td class="txtLeft"><?=$rowB["TypeOfAccount"]?></td>
                            </tr>
                        </table>
                        </div>
                    </td>
               		<?
					if($count>=2)
					{
						$count=1;
						echo "<tr></tr>";
					}
					$count++;
					}
                	?>
                </tr>
                <?
					}
				?>
            </table>
        </td>
    </tr>
     <tr>
        <td align="center" style="padding-top:15px;">
             <input type="image" src="images/icon_print.png" value="" onClick="window.print();">
        </td>
    </tr>
</table>
<?
	}
?>
