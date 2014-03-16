<?php

abstract class TimelineElement {
	
	// child classes should fill these variables
	protected $title = '', $numReblogs = 0, $numLikes = 0, 
		$timestamp = 0, $author = '', $icon_name = '', $tags = array();



	// override this to render timeline-body content
	abstract protected function renderContentBody();

	// override this to get more granular data loading, but call via parent::
	public function loadData(array &$data) {
		$this->title = $data['title'];
		$this->author = $data['author'];
		$this->timestamp = $data['timestamp'];
		$this->num_reblogs = $data['num_notes'];
		$this->num_likes = $data['num_likes'];
		$this->tags = $data['tags'];
	}

	// the main workhorse
	public function renderHTML() {
		$html = '';
		$html .= $this->renderBadge();
		$html .= '<div class="timeline-panel">';
		$html .= $this->renderTitle();
		$html .= '<div class="timeline-body">';
		$html .= $this->renderContentBody();
		$html .= $this->renderNotes();
		$html .= '</div></div><!-- /.timeline-panel -->';

		return $html;
	}

	private function renderBadge() {
		return 
			'<div class="timeline-badge warning">
				<i class="glyphicon glyphicon-'.$this->icon_name.'"></i>
			</div>';
	}

	private function renderTitle() {
		if ($this->title) {
			return 
				'<div class="timeline-heading">
					<h4 class="timeline-title">'.$this->title.'</h4>
				</div>';
		}
		return '';
	}

	private function renderNotes() {
		$likes_noun = " likes";
		if($this->likes == 1){
			$likes_noun = " like";
		}

		$reblogs_noun = " reblogs";
		if($this->reblogs == 1){
			$reblogs_noun = " reblog";
		}

		return '
		<p class="notes">
          <small class="text-muted">
           <i class="glyphicon glyphicon-thumbs-up"></i> '.$this->likes.$likes_noun.'
          </small>
          <small class="text-muted">
           <i class="glyphicon glyphicon-fullscreen"></i> '.$this->reblogs.$reblogs_noun.'
          </small>
          <small class="text-muted">
           <i class="glyphicon glyphicon-time"></i> 11 hours ago 
           by <a href="#">'.$this->author.'</a>
          </small>
        </p>';
	}

}