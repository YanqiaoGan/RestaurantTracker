<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">
	<link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
	<style type="text/css">
        *{
            box-sizing: content-box;
        }
        body { 
          font-family: "Chivo", sans-serif; 
          background: url(images/search.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }

	    .title{
	    	text-align: center;
	    	color: white;
	    	font-size: 30px;
	    	margin-top:220px;

	    }

	    .container{
	    	font-family: "Chivo", sans-serif; 
	        color: #eee;
	        text-align: center;
			display: flex;
			justify-content: center;
	    }

    
    .cf:before, .cfff:after{
      content:"";
      display:table;
    }
    
    .cf:after{
      clear:both;
    }

    .cf{
      zoom:1;
    }
    
    .wrapper {
        width: 450px;
        padding: 15px;
        margin-top: 20px;
        background: #444;
        background: rgba(0,0,0,.2);
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -moz-box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
        box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
    }
    
    .wrapper input {
        width: 330px;
        height: 20px;
        padding: 10px 5px;
        float: left;    
        font-family: "Chivo", sans-serif;
        border: 0;
        background: #eee;
        -moz-border-radius: 3px 0 0 3px;
        -webkit-border-radius: 3px 0 0 3px;
        border-radius: 3px 0 0 3px;      
    }
    
    .wrapper input:focus {
        outline: 0;
        background: #fff;
        -moz-box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
        -webkit-box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
        box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
    }
    
    .wrapper input::-webkit-input-placeholder {
       color: #999;
       font-weight: normal;
       font-style: italic;
    }
    
    .wrapper input:-moz-placeholder {
        color: #999;
        font-weight: normal;
        font-style: italic;
    }
    
    .wrapper input:-ms-input-placeholder {
        color: #999;
        font-weight: normal;
        font-style: italic;
    }    
    
    .wrapper button {
		overflow: visible;
        position: relative;
        float: right;
        border: 0;
        padding: 0;
        cursor: pointer;
        height: 40px;
        width: 110px;
        font-family: "Chivo", sans-serif;
        color: #fff;
        text-transform: uppercase;
        /*background: #d83c3c;*/
        /*background: #ba5225;*/
        background:#cc4910;
        -moz-border-radius: 0 3px 3px 0;
        -webkit-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;      
        text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);
    }   
      
    .wrapper button:hover{		
        background: #e54040;
    }	
      
    .wrapper button:active,
    .wrapper button:focus{   
        background: #c42f2f;    
    }
    
    .wrapper button:before {
        content: '';
        position: absolute;
        border-width: 8px 8px 8px 0;
        border-style: solid solid solid none;
        border-color: transparent #cc4910 transparent;
        top: 12px;
        left: -6px;
    }
    
    .wrapper button:hover:before{
        border-right-color: #e54040;
    }
    
    .wrapper button:focus:before{
        border-right-color: #c42f2f;
    }    
    
    .wrapper button::-moz-focus-inner {
        border: 0;
        padding: 0;
    }
	</style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="search-box">
    	<div class="title">
    		<h2>Search for the restaurant you visited</h2>
    	</div>
    	<div class="container">
    		<form id="search-form" class="wrapper cf" action="search_results.php" method="GET">
    		  	<input id="search-id" type="text" placeholder="Search here..." name="title" required>
    			<button type="submit">Search</button>
    		</form>
    	</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- <script type="text/javascript" src="search.js"></script> -->
</body>
</html>