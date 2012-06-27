<?php

class Paging {

	public $total = 0;
	public $offset = 0;
	public $limit = 10;
	public $results = array();
	public $uri = '/';

	public function __construct($sql, $bindings, $uri, $offset, $limit) {
		$this->limit = $limit;
		$this->offset = $offset;
		$this->uri = $uri;

		// get total for paging
		$parts = explode('from', $sql);
		$parts = explode('limit', end($parts));

		$this->total = Db::col('select count(*) from ' . current($parts), $bindings);
		$this->results = Db::get($sql . ' limit ' . $limit . ' offset ' . $offset, $bindings);
	}

	public function links() {
		$pages = ceil($this->total / $this->limit);
		$page = ceil($this->offset / $this->limit) + 1;
		$html = '';

		if($pages == 1) {
			return $html;
		}

		// previous
		if($page > 1) {
			$prev = $this->offset < $this->limit ? 0 : $this->offset - $this->limit;
			$html .= '<a href="' . $this->uri . $prev . '">&laquo; Previous</a> ';
		}

		// show the first page links
		for($i = 0; $i < min(array(3, $pages)); $i++) {
			$p = $i + 1;
			$offset = $i * $this->limit;

			if($p == $page) {
				$html .= ' <span>' . $p . '</span> ';
			} else {
				$html .= ' <a href="' . $this->uri . $offset . '">' . $p . '</a> ';
			}
		}

		if($pages > 3) {
			$html .= ' ... ';
		}

		// show surrounding pages
		if($pages > 3 and $page > 3 and $page <= ($pages - 3)) {
			for($i = 3; $i < ($pages - 3); $i++) {
				$p = $i + 1;

				if(($p > ($page - 3)) and ($p < ($page + 3))) {
					$offset = $i * $this->limit;

					if($p == $page) {
						$html .= ' <span>' . $p . '</span> ';
					} else {
						$html .= ' <a href="' . $this->uri . $offset . '">' . $p . '</a> ';
					}
				}
			}

			$html .= ' ... ';
		}

		// show last page links
		if($pages > 3) {
			for($i = ($pages - 3); $i < $pages; $i++) {
				$p = $i + 1;
				$offset = $i * $this->limit;

				if($p == $page) {
					$html .= ' <span>' . $p . '</span> ';
				} else {
					$html .= ' <a href="' . $this->uri . $offset . '">' . $p . '</a> ';
				}
			}
		}

		// next
		if($page < $pages) {
			$next = $this->offset + $this->limit;
			$html .= '<a href="' . $this->uri . $next . '">Next &raquo;</a> ';
		}

		return $html;
	}

}