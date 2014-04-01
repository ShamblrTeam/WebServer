<?php

class AnswerTimelineElement extends TimelineElement {

    // individualzied content
	private $answer = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'send';
		// if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {

        	return '<p>'.htmlentities($this->answer).'</p>';
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->answer = $data['content'];
	}
}

TimelineElementFactory::registerClass('answer', AnswerTimelineElement);