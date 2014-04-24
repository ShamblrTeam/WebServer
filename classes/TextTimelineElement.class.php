<?php

class TextTimelineElement extends TimelineElement {

    // individualzied content
	private $text = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'comment';

	    // if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {
        // nothing special in this element.
        return '<p>'.$this->text.'</p>';
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->text = $data['content'];
	}
}

TimelineElementFactory::registerClass('text', TextTimelineElement);
