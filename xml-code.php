<? include ("inc/header.php"); ?>
<? include ("inc/functions.php"); ?>
<?
	$sqlC ="select * from tblClientMaster order by ClientID";
	$resultC = mysql_query ($sqlC) or die ("Error in  query : ".$sqlC."<br>".mysql_errno()." : ".mysql_error());
	if(mysql_num_rows($resultC)>0)
	{
		$xml = new DOMDocument("1.0");
		$xml->formatOutput=true;
		$clients = $xml->createElement("clients");
		$xml ->appendChild($clients);
		while($rowC = mysql_fetch_array($resultC))
		{
			$client = $xml->createElement("client");
			$clients ->appendChild($client);
			
			$clientName = $xml->createElement("clientName",$rowC["ClientName"]);
			$client ->appendChild($clientName);
			$ClientCode = $xml->createElement("ClientCode",$rowC["ClientCode"]);
			$client ->appendChild($ClientCode);
			
		}
		echo "<xmp>".$xml->saveXML()."</xml>";
		$xml->save("clientReport.xml"); 
	}
?>