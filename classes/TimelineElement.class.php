<?php

abstract class TimelineElement {
	
	// child classes should fill these variables
	protected $title = '', $numNotes = 0, 
		$timestamp = 0, $author = '', $icon_name = '', $tags = array(), $postID = 0;

	// override this to render timeline-body content
	abstract protected function renderContentBody();

	protected function url(){
		return $this->blog_link.strval($this->postID);
	}

	// override this to get more granular data loading, but call via parent::
	public function loadData(array $data) {
		$this->postID = $data['post_id'];
		$this->title = $data['title'];
		$this->author = $data['author'];
		$this->blog_link = $data['blog_link'];
		$this->timestamp = $data['timestamp'];
		$this->numNotes = intval($data['num_notes']);
		$this->timestamp = $data['timestamp'];
		$this->tags = $data['tags'];
	}

	// the main workhorse
	public function renderHTML() {
		$html = '<!-- new element -->';
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
		$notes_noun = " notes";
		if($this->numNotes == 1){
			$likes_noun = " notes";
		}

		$notes = number_format($this->numNotes);

		$date = date("F jS @ g:i a", strtotime($this->timestamp));
		// $this->timestamp contains 'YYYY-MM-DD HH:MM:SS'
		// format this into a readable date.
		return '
		<p class="notes">
          <small class="text-muted">
           <i class="glyphicon glyphicon-thumbs-up"></i> '.$notes.' '.$likes_noun.'
          </small>
          <small class="text-muted">
           <i class="glyphicon glyphicon-time"></i> '.$date.' 
           by <a href="'.$this->blog_link.'">'.$this->author.'</a>
          </small>
        </p>';
	}

}
