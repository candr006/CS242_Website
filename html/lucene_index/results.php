<html>
 <head>
 	  <title>Lucene Query Results</title>
 	  <link href="../css/main.css" rel="stylesheet" />
  </head>
 <body>
	<div class="hero-image">
	  <a href="//localhost">
		  <div class="hero-text">
		    <h1 style="font-size:20px">Hangry Recipe Search</h1>
		  </div>
	  </a>
	</div>
 	<table id="result_table" class="results_table">
 		<thead><tr><th><b><?php echo "Top Results for Query: ".$_POST['search_text'];?></b></th></tr></thead>
 		 <tbody>
		 <?php
	 	//execute shell command that runs indexer using user input
	 	//Need to add '2>&1' at the end of your shell command so that the results of the command get output
		 if(is_array($_POST['search_text'])){
		 	$search_text=implode(" ",$_POST['search_text']);
		 }else{
		 	$search_text=str_replace(',',' ',$_POST["search_text"]);
		 }

	 	exec('sh indexer.sh "'.$search_text.'"',$results);
		//$results=file("/var/www/html/lucene_index/lucene_output.txt");

	 	$i=0;
	 	//change this val if you want to output more top results
	 	$num_top_results=5;

	 	//start at index 10 because that's where the actual results are
	 	$last_row=9+$num_top_results+1;
	 	foreach ($results as $line) {
	 		if($i>9 && $i<$last_row){

	 				//split up the output in order the format the results table
	 				$larr=explode("-->",$line);
	 				$title_url=explode("--",$larr[1]);
	 				$title=$title_url[0];
	 				$url=$title_url[1];

		 		?>
		 		<tr>
		 			<td><a href=<?php echo '"'.$url.'"'; ?> target="_blank"><span class="result_name"><?php echo $title ?></span>
		 				<br>
		 				<span class="result_url"><?php echo $url ?></span>
		 				</a>
		 			</td>
		 		</tr>
		 		<?php
	 		}

	 		$i++;
	 	}
	 	 print_r(error_get_last());
	 ?> 
 	</tbody>
 </table>
</body>
</html>