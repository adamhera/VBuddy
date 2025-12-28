<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>JQuery Live Search</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 </head>
 <body>
   <h2 align="center">JQuery Live Search</h2><br />
     <span>Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by Course Details" />
   <br />
   <div id="result"></div>
<script>
$(document).ready(function(){
load_data();

function load_data(query){
     $.ajax({
	url:"fetch.php",
	method:"POST",
	data:{query:query},
	success:function(data){
	$('#result').html(data);	}
	});
	}
     $('#search_text').keyup(function(){
	var search = $(this).val();
	if(search != ''){
		load_data(search);
	}else{
		load_data();
	}
	});
});
</script>
 </body>
</html>
