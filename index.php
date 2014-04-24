<?php
require_once('classes/init.php');

$query = $_GET['query'];

if (empty($query)) {
    header('Location: /search.php');
    die();
}

// build query object
$query = new Query($query);
$element_datas = $query->execute();

// build the TimelineElement objects from the data
$element_objects = array();
foreach ($element_datas as $element_data) {
  $element_objects[] = TimelineElementFactory::buildFromData($element_data);
}

?>
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
    </style>
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1 id="timeline">Timeline</h1>
    </div> <!-- .page-header -->
    <ul class="timeline">

      <?php
        $index = 1;
        foreach ($element_objects as $element_object) {

          // switch each side
          if ($index % 2 == 0) {
            echo '<li class="timeline-inverted">';
          } else {
            echo '<li>';
          }
          $index += 1;

          echo $element_object->renderHTML();
          echo '</li>';
        }
      ?>
    </ul>
</div> <!-- .container -->
</body>
</html>
