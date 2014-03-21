<?php

class VideoTimelineElement extends TimelineElement {

    // individualzied content
	private $embed_code = '';
	private $caption = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'film';
	    // if we initialized with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {
		$html = 'Video embed code will go here';
		if ($this->caption) {
			$html .= '<p>'.htmlentities($this->caption).'</p>';
		}
		return $html;
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->embed_code = $data['content']; // @todo: Update with correct logic
		$this->caption = $data['caption'];
	}

}

TimelineElementFactory::registerClass('video', PhotoTimelineElement);
