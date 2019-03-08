<html>
 <head>
 	  <title>Exec Test</title>
 	  <link href="css/main.css" rel="stylesheet" />
  </head>
 <body>

 	<table id="result_table" class="results_table">
 		<thead><tr><th><b><?php echo "Top Results for Query: ".$_POST['search_text'];?></b></th></tr></thead>
 		 <tbody>
		 <?php
	 	//execute shell command that runs indexer using user input
	 	//Need to add '2>&1' at the end of your shell command so that the results of the command get output
	 	//exec('ls 2>&1',$results);
	 	//exec('sh indexer.sh "'.$_POST['search_text'].'"',$results);
		// echo 'here1';
	 	$file = file("/var/www/html/lucene_index/lucene_output.txt");
	 	//echo 'here';

	 	$i=0;
	 	foreach ($file as $line) {
	 		//if(i>8 && i<15){
		 		?>
		 		<tr>
		 			<td><span class="result_name"><?php echo $line; ?></span></td>
		 		</tr>
		 		<?php
	 		//}

	 		$i++;
	 	}
	 	//fclose($file);
	 	 print_r(error_get_last());
	 ?> 
 	</tbody>
 </table>
</body>
</html>