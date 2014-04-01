<?php

class LinkTimelineElement extends TimelineElement {

    // individualzied content
	private $link = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'link';

		// if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {

        return '<p>'.htmlentities($this->link).'</p>';
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->link = $data['content'];
	}
}

TimelineElementFactory::registerClass('link', LinkTimelineElement);