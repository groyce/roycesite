<?php
$user = 'GEORGEROYCE@credighton.edu';
$pass = 'Kendrew1a';
$text = substr($HTTP_POST_VARS['This is a test of an SMS message sent from a PHP program using REST POX'], 0, 160);
$mobnum = $HTTP_POST_VARS['4023127929'];
$result = '';
$myOutMsg = '<?xml version="1.0" encoding="UTF-8" ?>';
$myOutMsg .= '<Request xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
$myOutMsg .=
'xsi:noNamespaceSchemaLocation="http://schema.2sms.com/1.0/0410_RequestSendMessage.xsd" ';
$myOutMsg .= 'Version="1.0">';
$myOutMsg .= '<Identification>';
$myOutMsg .= '<UserID>' . $user .'</UserID>';
$myOutMsg .= '<Password>'.$pass .'</Password>';
$myOutMsg .= '</Identification>';
$myOutMsg .= '<Service>';
$myOutMsg .= '<ServiceName>SendMessage</ServiceName>';
$myOutMsg .= '<ServiceDetail>';
$myOutMsg .= '<SingleMessage>';
$myOutMsg .= '<Destination>'.$mobnum.'</Destination>';
$myOutMsg .= '<Text>'.$text.'</Text>';
$myOutMsg .= '</SingleMessage>';
$myOutMsg .= '</ServiceDetail>';
$myOutMsg .= '</Service>';
$myOutMsg .= '</Request>';
if (function_exists('curl_init')) 
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.2sms.com/xml/xml.jsp');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $myOutMsg);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
} else {
echo "Curl Not Found. Using sockets...\r\n\r\n";
$postdata = "POST /xml/xml.jsp HTTP/1.0\r\n";
$postdata .="Host: www.2sms.com\r\n";
$postdata .="Content-length: " . strlen($myOutMsg) . "\r\n" ;
$postdata .="Content-Type: text/xml\r\n";
$postdata .="Connection: Close\r\n\r\n";
$postdata .="$myOutMsg\r\n";
echo $postdata;
$fp = fsockopen('www.2sms.com', 80, $errno, $errstr, 30);
if (!$fp){
echo "ERROR:" . $errno . "-" . $errstr . "<br>";
}else{
socket_set_timeout($fp, 30);
fputs ($fp,$postdata);
while (!feof($fp)) {
$result .= fgets($fp, 1024);
}
fclose($fp);
}
}
if ($result == 1 or strcmp('<ErrorCode>00</ErrorCode>', $result)) {
echo "Server Response:\r\n" .$result;
} else {
echo 'we <b>failed</b> to send your code';
}

?>
