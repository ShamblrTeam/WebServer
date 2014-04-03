<?php

class AudioTimelineElement extends TimelineElement {

    // individualzied content
	private $audio_url = '';
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
		
		$html = '<audio controls><source src="'.$this->audio_url.'" type="audio/mpeg"></audio>';

		if ($this->caption) {
			$html .= '<p>'.htmlentities($this->caption).'</p>';
		}
        return $html;
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->audio_url = $data['content'];
		$this->caption = '';
	}
}

TimelineElementFactory::registerClass('audio', AudioTimelineElement);