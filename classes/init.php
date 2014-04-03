<?php

// base class and factory. Needed before all other files.
require_once('TimelineElement.class.php');
require_once('TimelineElementFactory.class.php');

require_once('Query.class.php');

$elements = array('Answer','Audio','Chat','Link','Photo','Quote','Text','Video');
foreach ($elements as $element) {
	require_once($element.'TimelineElement.class.php');
}