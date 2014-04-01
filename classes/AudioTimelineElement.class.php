<?php

class AudioTimelineElement extends TimelineElement {

    // individualzied content
	private $audio_urls = array();
	private $caption = '';


	public function __construct(array $data = null) {
		$this->icon_name = 'music';
		// if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {
		$html = '';
		foreach ($this->image_urls as $image_url) {
			$html .= '<audio src="'.$image_url.'">';
		}
		if ($this->caption) {
			$html .= '<p>'.htmlentities($this->caption).'</p>';
		}
        return $html;
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->audio_urls = explode(',', $data['content']);
		$this->caption = '';
	}
}

TimelineElementFactory::registerClass('audio', AudioTimelineElement);