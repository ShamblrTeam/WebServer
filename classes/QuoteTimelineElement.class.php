<?php

class QuoteTimelineElement extends TimelineElement {

    // individualzied content
	private $quote = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'pencil';

		// if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {

        return '<p>'.htmlentities($this->quote).'</p>';
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->quote = $data['content'];
	}
}

TimelineElementFactory::registerClass('quote', QuoteTimelineElement);