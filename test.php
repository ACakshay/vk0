<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','width=920, height=700, scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<?
$message="";
$flagPost=0;
$sql ="select * from tblBankMaster";
$result = mysql_query ($sql) or die ("Error in  query : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if($no1 = mysql_num_rows($result)>0)
{
	while($rowList = mysql_fetch_row($result))
	{
		echo "<pre/>"; print_r($rowList);
		//echo $rowList->BankID;
		//echo $rowList->BankName;
		//exit;
		
	}
	//////
	define("GREETING", "Welcome to W3Schools.com!",true);
	echo GREETING;
	define("GREETING", "Welcome to my world",true);
	echo greeting;
	//////
	echo "<br/>";
	$input ="1,2,3,4,5,6,7";
	echo $input = array_sum(explode(",",$input));
}
class Dragonball{
	public $ballcount = 0;
	function iFoundaBall()
	{
		while($ballcount!=8)
		{
			echo "<br/>".$ballcount++."<br/>";
		}
		if($ballcount==8)
		{
			$ballcount=0;
			echo "You can ask your wish";
		}
	}
}
$obj = new Dragonball();
print $obj->iFoundaBall();
//////////////
echo "<br/>";
$i=016;
echo $i/2;
echo "<br/>";
$a = '1';
$b=&$a;
echo $a;
echo $b="2$b";
echo "<br/>";

print_r(gd_info());


?>

<? include ("inc/footer.php"); ?>