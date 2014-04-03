<?php

class VideoTimelineElement extends TimelineElement {

    // individualzied content
	private $url = '';
	private $caption = '';

	private $domain = '';
	private $code = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'film';
	    // if we initialized with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {
		$html = '';
		switch ($this->domain) {
			case 'youtube':
				$html = '<iframe width="100%" style="min-height:300px;" src="http://www.youtube.com/embed/'.$this->code.'?wmode=transparent&amp;autohide=1&amp;egm=0&amp;hd=1&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;showsearch=0" frameborder="0" allowfullscreen="">Video Loading...</iframe>';
				break;
			
			default:
				throw Exception('Domain not found in url :'. $this->url);
				break;
		}

		if ($this->caption) {
			$html .= '<p>'.htmlentities($this->caption).'</p>';
		}
		return $html;
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->url = $data['content'];
		$this->caption = $data['caption'];

		if (strpos($this->url, 'youtube') !== false) {
			$this->domain = 'youtube';
			$vars = array();
			parse_str( parse_url( $this->url, PHP_URL_QUERY ), $vars );
			$this->code = $vars['v'];
		}
	}

}

TimelineElementFactory::registerClass('video', 'VideoTimelineElement');
