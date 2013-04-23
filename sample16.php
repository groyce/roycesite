
<HTML>
<HEAD>
<TITLE>Sample 16</TITLE>
</HEAD>
<BODY>
<H2><B><p align="center"><font color="blue" face="arial"> Customer Information Access</font></p></B></H2>
<br><br>
<?php
// open the connection
global $customer;
$conn = mysql_connect("roycesit.ipowermysql.com", "root", "");

// pick the database to use
mysql_select_db("testdata",$conn);


// set the customer you are looking for
$customer = $_POST[cust_number];
// create the SQL statement
$sql = "SELECT * from customer where cust_id = $customer";

// execute the SQL statement
$result = mysql_query($sql, $conn) or die(mysql_error());

//go through each row in the result set and display data
while ($newArray = mysql_fetch_array($result)) {

  	// give a name to the fields
    $cust_id  = $newArray['cust_id'];
    $cust_ssn = $newArray['cust_ssn'];
    $cust_fname  = $newArray['cust_fname'];
    $cust_lname = $newArray['cust_lname'];
    
	
    //echo the results on screen
print ("<table border=2>\n");
 print ("<TR>");
 print ("<TH>Customer Number: </TH>");
 print ("<TH>$cust_id</TH>");
 print ("</TR>");

 print ("<TR>");
 print ("<TH>Name: </TH>");
 print ("<TH>$cust_fname $cust_lname</TH>");
 print ("</TR>");

 print ("<TR>");
 print ("<TH>Social Security Number: </TH>");
 print ("<TH>$cust_ssn</TH>");
 print ("</TR>");

 
print ("</table>\n");
}
?>
</BODY>
</HTML>