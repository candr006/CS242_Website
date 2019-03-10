<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
  </head>
  <body>
    <div class="s004">
  
      <form id="searchForm" action="lucene_index/results.php" method="POST">
        <fieldset>
          <legend>Hangry Recipe Search</legend>
          <div class="inner-form">
            <div class="input-field">
              <input class="form-control" id="choices-text-preset-values" name="search_text" type="text" placeholder="Type to search..." />
              <button class="btn-search" type="button" onclick="submitForm()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </button>
            </div>
		    <div class="onoffswitch">
		        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
		        <label class="onoffswitch-label" for="myonoffswitch">
		            <span class="onoffswitch-inner"></span>
		            <span class="onoffswitch-switch"></span>
		        </label>
		    </div>

          </div>
          <div class="suggestion-wrap">
            <! -- add spans here -->
          </div>
        </fieldset>

      </form>
    </div>
    <script src="js/extention/choices.js"></script>
    <script>
      var textPresetVal = new Choices('#choices-text-preset-values',
      {
        removeItemButton: true,
      });

  function submitForm(){
    document.getElementById("searchForm").submit(); 
     /*var submitted = document.getElementById("choices-text-preset-values").value;
     var results= "Results...";
     
     var htmlresults="<thead><th><b>Top Results for Query: "+submitted+" </b></th></thead><tbody><tr><td><span class='result_name'>Result Title</span><br>";
     htmlresults=htmlresults+"<span class='result_url'>https://resulturl.com</span><br><span class='result_snippet'>Snippet goes here...</span></td></tr>";
     htmlresults=htmlresults+"<tr><td><span class='result_name'>Result Title</span><br>";
     htmlresults=htmlresults+"<span class='result_url'>https://resulturl.com</span><br><span class='result_snippet'>Snippet goes here...</span></td></tr>";
     htmlresults+="</tbody>"
      document.getElementById("result_table").innerHTML=htmlresults;*/
    
  }

    </script>
  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
