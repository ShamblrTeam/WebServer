<?php

class LinkTimelineElement extends TimelineElement {

    // individualzied content
	private $link = '';
	private $image = '';
	private $description = '';

	public function __construct(array $data = null) {
		$this->icon_name = 'link';

		// if we initialize with data, let's go ahead loadData
		if ($data) {
			$this->loadData($data);
		}
	}

	// generate content unique to this element
	protected function renderContentBody() {


		$html = '';
		if ($this->image) {
			$html .= '<a href="'.$this->link.'"><img src="'.$this->image.'" style="width:100%;" alt="photo" /></a>';
		}

		if ($this->description) {
			$html .= '<p>'.htmlentities($this->description).'</p><br/><a href="'.$this->link.'">'.$this->link.'</a>';
		}

        return $html;
	}

	// load general data through parent, and perform logic on `content`
	public function loadData(array $data) {
		parent::loadData($data);
		$this->link = $data['content'];
		$this->getAndStoreDataFromURL($this->link);
	}

	private function getAndStoreDataFromURL($url) {
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
	    $html_doc = curl_exec($ch);
	    curl_close($ch);

	    $html = new DOMDocument();
		@$html->loadHTML($html_doc);

		//Get all meta tags and loop through them.
		foreach($html->getElementsByTagName('meta') as $meta) {
		    //If the property attribute of the meta tag is og:image
		    $property = $meta->getAttribute('property');
		    if($property == 'og:image'){ 
		        $this->image = $meta->getAttribute('content');
		    } else if ($property == 'og:description' || $meta->getAttribute('name') == 'description') {
		    	$this->description = $meta->getAttribute('content');
		    }
		}
		return true;
	}
}

TimelineElementFactory::registerClass('link', 'LinkTimelineElement');