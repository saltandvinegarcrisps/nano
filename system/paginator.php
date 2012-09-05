<?php namespace System;

class Paginator {

	public $results = array();

	public $count = 0;

	public $page = 1;

	public $per_page = 10;

	public function __construct($results, $count, $page, $perpage, $url) {
		$this->results = $results;
		$this->count = $count;
		$this->page = $page;
		$this->perpage = $perpage;
		$this->url = $url;
	}

	public function links() {
		$html = '';

		$pages = ceil($this->count / $this->perpage);

		if($pages > 1) {

			if($this->page > 1) {
				$page = $this->page - 1;

				$html = '<a href="' . $this->url . '/' . $page . '">Previous</a>';
			}

			for($i = 0; $i < $pages; $i++) {
				$page = $i + 1;

				$html .= ' <a href="' . $this->url . '/' . $page . '">' . $page . '</a> ';
			}

			if($this->page < $pages) {
				$page = $this->page + 1;

				$html .= '<a href="' . $this->url . '/' . $page . '">Next</a>';
			}

		}

		return $html;
	}

}