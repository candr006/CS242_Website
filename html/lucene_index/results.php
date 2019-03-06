<html>
 <head>
  <title>Exec Test</title>
 </head>
 <body>
 <?php 
 	//execute shell command that runs indexer using user input
 	//Need to add '2>&1' at the end of your shell command so that the results of the command get output
 	 //exec('echo "Test test test" > test_file.txt',$results);
 	exec('sh indexer.sh "'.$_POST['search_text'].'" 2>&1',$results);
 	print_r($results);
 ?> 
 </body>
</html>