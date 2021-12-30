<? include ("inc/check_session.php"); ?>
<? include ("inc/dbconnection.php"); ?>
<? include ("inc/functions.php"); ?>
<?
	echo $fDate = $_GET["id"];
	echo $tDate = $_GET["id2"];
	$sqlBank ="select a.*,b.* from tblTransactionMaster a ,tblTransactionDetails b where a.TransactionID=b.TransactionID ";
$sqlBank = $sqlBank." and a.TenureFrom >= '".$fDate."' and a.TenureTo <= '".$tDate."'";
$resultBank = mysql_query ($sqlBank) or die ("Error in  query : ".$sqlBank."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($resultBank)>0)
{
?>

    <td align="center" valign="top">
    <div id="showResult">
        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
            <tr>
                <td class="tbl_head">S. No.</td>
                <td class="tbl_head">Date</td>
                <td class="tbl_head">Investor</td>
                <td class="tbl_head">Amount</td>
            </tr>
            <tr>
                <td class="tbl_row">1.</td>
                <td class="tbl_row">27/08/2016</td>
                <td class="tbl_row"><a href="javascript:;">Mr. Ankit Mehta</a></td>
                <td class="tbl_row">2,00000</td>
            </tr>
            <tr>
                <td class="tbl_row">2.</td>
                <td class="tbl_row">02/10/2016</td>
                <td class="tbl_row"><a href="javascript:;">Mr. Aseem Gupta</a></td>
                <td class="tbl_row">1,50,000</td>
            </tr>
        </table>
       </div>
    </td>

<?
	}

?>