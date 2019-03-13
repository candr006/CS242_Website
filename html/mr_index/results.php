<html>
 <head>
 	  <title>Lucene Query Results</title>
 	  <link href="../css/main.css" rel="stylesheet" />
  </head>
 <body>
	<div class="hero-image">
	  <a href="//localhost">
		  <div class="hero-text">
		    <h1 style="font-size:20px; font-family: 'Poppins', sans-serif;">Hangry Recipe Search</h1>
		  </div>
	  </a>
	</div>
 	<table id="result_table" class="results_table">
 		<thead><tr><th><b><?php echo "Top Results for Query: ".$_POST['search_text']?></b></th></tr></thead>
 		 <tbody>
		 <?php
	 	//execute shell command that runs indexer using user input
	 	//Need to add '2>&1' at the end of your shell command so that the results of the command get output

	 	//exec('python irs.py "'.$_POST['search_text'].'"',$results);
		$results=file("/var/www/html/mr_index/mr_output.txt");
		$results=json_encode($results);
		$results=json_decode($results);

	 	$i=0;
	 	//change this val if you want to output more top results
	 	$num_top_results=5;

	 	//start at index 10 because that's where the actual results are
	 	$last_row=9+$num_top_results+1;
	 	foreach ($results as $line) {
	 		//if($i>9 && $i<$last_row){
	 				//var_dump($line);
	 				//echo "\n-----------------------------------------------------------------\n\n";
	 				//split up the output in order the format the results table
	 				$larr=explode("', 'Title': '",$line);
	 				$url=str_replace("{'_id': {'URL': '","",$larr[0]);

	 				$title_snippet=explode("', 'Description': '",$larr[1]);
	 				$title=$title_snippet[0];
	 				$snip_arr=explode("'},",$title_snippet[1]);
	 				$snippet=$snip_arr[0];

		 		?>
		 		<tr>
		 			<td><a href=<?php echo '"'.$url.'"'; ?> target="_blank"><span class="result_name"><?php echo $title ?></span>
		 				<br>
		 				<span class="result_url"><?php echo $url ?></span>
		 				<br>
		 				<span class="result_snippet"><?php echo $snippet ?></span>
		 				</a>
		 			</td>
		 		</tr>
		 		<?php
	 		//}

	 		$i++;
	 	}
	 	 print_r(error_get_last());
	 ?> 
 	</tbody>
 </table>
</body>
</html>