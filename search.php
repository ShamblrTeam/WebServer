<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Timeline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/timeline.css" rel="stylesheet" />
    <style>
    	p.notes > small {
    		padding-right:5px;
    	}

     	p.notes > small > i {
     		padding-left:2px;
    		padding-right:2px;
        }   

        input.big {
            width:600px;
            height:100px;
            font-size:40px;
        }

        input.big_submit {
            height:100px;
            width:200px;
            font-size:40px;
        }    
    </style>
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1 id="timeline">Search Tumblr</h1>
    </div> <!-- .page-header -->

    <div>
        <form method="GET" action="index.php">
            <input class="big" type="text" name="query" value="" placeholder="Barack Obama" />
            <input type="submit" value="Shamble" class="big_submit"/>
        </form>
    </div>
</div> <!-- .container -->
</body>
</html>
