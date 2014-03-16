<?php

class PhotoTimelineElement extends TimelineElement {

	private $image_urls = array();
	private $caption = '';

	// if we initialize with data, let's go ahead loadData
	public function __construct(array $data = null) {
		$this->icon_name = 'picture';

		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {
		$html = '';
		foreach ($this->image_urls as $image_url) {
			$html .= '<img src="'.$image_url.'" style="width:100%;" alt="photo" />';
		}

		if ($caption) {
			$html .= '<p>'.htmlentities($caption).'</p>';
		}
		return $html;
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->image_urls = explode(',', $data['content']);
		$this->caption = '';
	}

}

TimelineElementFactory::registerClass('photo', PhotoTimelineElement);