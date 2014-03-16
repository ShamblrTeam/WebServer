<?php

class TimelineElementFactory {
	// slug => class
	public static $registrations = array();

	// assistant function. just b/c this is heavily repeated logic
	public static function buildFromData(array $data) {
		$element = self::build($data['type']);
		$element->loadData($data);
		return $element;
	}

	// builds a TimelineElement child class
	public static function build($slug){

		if (array_key_exists($slug, self::$registrations)) {
			$class_name = self::$registrations[$slug];
			if (class_exists($class_name)) {
				return new $class_name();
			} else {
				throw new Exception("Invalid classname: ".$class_name);
			}
		} else {
			throw new Exception("Slug not registered: ".$slug);
		}
	}

	// should be called after class declaration
	public static function registerClass($slug, $class_name) {
		self::$registrations[$slug] = $class_name;
	}
}