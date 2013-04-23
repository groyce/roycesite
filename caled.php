<?php
$caldata ="$this_month$the_day$this_year.php";	
	if($pwd==user) {	
		if(file_exists($caldata)) {  //getting right to it if the file is already there
		$fh = fopen($caldata, "w");
		fputs($fh, '<?php');
		fputs($fh, "\n");
		fputs($fh, "echo '");
		fputs($fh, '<br><font face="tahoma, arial, verdana" size=2><b>');
		fputs($fh, "$caption");
		
		fputs($fh, '</b></font>');
		fputs($fh, "';\n");
		fputs($fh, '?>');
		fclose($fh);
} else {

	$burp2 = tmpfile(); {  //creating a temp file in case this is the first time.
	fopen("$burp2", "w+");
	chmod ("$burp2", 0777);
		rename("$burp2","$caldata");
	fclose($burp2);

		$fh = fopen($caldata, "w");
		fputs($fh, '<?php');
		fputs($fh, "\n");
		fputs($fh, "echo '");
		fputs($fh, '<br><font face="tahoma, arial, verdana" size=2><b>');
		fputs($fh, "$caption");
		
		fputs($fh, '</b></font>');
		fputs($fh, "';\n");
		fputs($fh, '?>');
		fclose($fh); 
}
	}
header("Location: http://www.roycesite.com/george/calendar/calendar.php");
} else {
	echo '<html><center><h2>Sorry, wrong password<br>click <a href="http://www.roycesite.com/george/calendar/calendar.php">here</a> to go back.';
}
?>