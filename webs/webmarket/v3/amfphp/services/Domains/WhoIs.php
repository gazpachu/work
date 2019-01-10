<?php
class WhoIs
{
	function WhoIs()
	{
		$this->methodTable = array(
			"find" => array(
			"description" => "Searches a domain name",
			"access" => "remote", // Possible values private, public, remote
			"arguments" => array("domain name, NIC")
			)
		);
	}
	
	function find($domainName, $NIC)
	{
		$serverWhoIs = fsockopen($NIC,43); 
		fputs($serverWhoIs, $domainName . "\r\n");
		$answer = '';
		while(!feof($serverWhoIs)) 
		$answer .= fgets($serverWhoIs,128); 
		fclose($serverWhoIs);
		$answer = str_replace("\r\n", "\n", $answer);
		return $answer;
	}
}
?>
