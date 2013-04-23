<? 

//$handle = fopen("http://www.msn.com/", "rt");
//http://finance.yahoo.com/q?s=IBM
$handle = fopen("http://phpdev.ist.unomaha.edu/~groyce/", 'rt');

// loop reading data from the FIFO
while (TRUE) {
   $data = fread($handle, 8192);
   if (strpos($data, "George")!=false){
     echo strpos($data, "George");
	}

   // eliminate the initially sent data from our read input
   //  NOTE: this is done only in a very simplyfied way in this example, 
   //  that will break if that data-string might also be part of your regular input!!
  // if (!(strpos($inp, $uniqueData) === FALSE))    $data = str_replace($uniqueData, '', $data);
  //echo $data."br />";

// here comes your processing of the read data...
}
fclose($handle);

 ?>
