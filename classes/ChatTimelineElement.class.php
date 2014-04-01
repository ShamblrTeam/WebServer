<?php

class ChatTimelineElement extends TimelineElement {

    // individualzied content
	private $chat = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'user';

		// if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {

        return '<p>'.htmlentities($this->chat).'</p>';
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->chat = explode('+', $data['content']);
	}
}

TimelineElementFactory::registerClass('chat', ChatTimelineElement);